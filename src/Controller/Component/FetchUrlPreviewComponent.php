<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class FetchUrlPreviewComponent extends Component {
    
    
    var $headers;
    
    var $user_agent;
    
    var $compression;
    
    var $cookie_file;
    
    var $proxy;
    
    
    public function fetch($url) {
        
        $response = [];
        
        $url = $this->filterUrl(urldecode($url));
        
        $response['url'] = $url;
        
        $urlArray = parse_url($url);
        
        $response['host'] = $urlArray['host'];
        
        
        // Get Data
        $this->cURL();
        $context = $this->curlGet($url);
        
        $context = str_replace(array("\n", "\r", "\t", '</span>', '</div>'), '', $context);
        
        $context = preg_replace('/(<(div|span)\s[^>]+\s?>)/', '', $context);
        
        
        if (mb_detect_encoding($context, "UTF-8") != "UTF-8")
            $context = utf8_encode($context);
        
        // Parse Title
        $nodes = $this->extractTags($context, 'title');
        $response['title'] = isset($nodes[0]) ? trim($nodes[0]['contents']) : "";
        
        // Parse Description
        $response['description'] = '';
        $nodes = $this->extractTags($context, 'meta');
        foreach ($nodes as $node) {
            if (isset($node['attributes']['name'])) {
                if (strtolower($node['attributes']['name']) == 'description') {
                    $description = trim($node['attributes']['content']);
                    if (strlen($description) > 200) {
                        $response['description'] = substr($description, 0, strpos($description, ' ', 200)) . "...";
                    } else {
                        $response['description'] = $description;
                    }
                }
            }
        }
        
        // Parse Images
        $imageTags = $this->extractTags($context, 'img');
        
        $response['alternate_image'] = SITE_URL . "/img/preview.png";
        
        foreach ($imageTags as $img) {
            $requiredWidth = true;
            if (isset($img['attributes']['width'])) {
                $requiredWidth = ($img['attributes']['width'] >= 200) ? true : false;
            }
            
            if (isset($img['attributes']['src']) && $requiredWidth) {
                
                $imgUrl = $img['attributes']['src'];
                $ext = trim(pathinfo($imgUrl, PATHINFO_EXTENSION));
                
                $imgUrlArray = parse_url($imgUrl);
                
                if ($imgUrl && in_array(strtolower($ext), ['png', 'jpg', 'jpeg'])) {
                    $finalImageUrl = (isset($imgUrlArray['scheme']) ? $imgUrlArray['scheme'] : $urlArray['scheme']) . "://";
                    $finalImageUrl .= isset($imgUrlArray['host']) ? $imgUrlArray['host'] : $urlArray['host'];
                    $finalImageUrl .= $imgUrlArray['path'];
                    
                    
                    list($width, $height) = getimagesize($finalImageUrl);
                    if ($width >= 200 && $height >= 200) {
                        $response['image'] = $finalImageUrl;
                        break;
                    }
                    
                    if ($response['alternate_image'] == SITE_URL . "/img/preview.png" && ($width >= 100 && $height >= 100)) {
                        $response['alternate_image'] = $finalImageUrl;
                    }
                    
                }
            }
        }
        
        
        return $response;
        
    }
    
    
    function filterUrl($value) {
        $value = trim($value);
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        $value = strtr($value, array_flip(get_html_translation_table(HTML_ENTITIES)));
        $value = strip_tags($value);
        $value = htmlspecialchars($value);
        return $value;
    }
    
    
    function extractTags($html, $tag, $selfclosing = null, $return_the_entire_tag = false, $charset = 'ISO-8859-1') {
        
        if (is_array($tag)) {
            $tag = implode('|', $tag);
        }
        
        //If the user didn't specify if $tag is a self-closing tag we try to auto-detect it
        //by checking against a list of known self-closing tags.
        $selfclosing_tags = array('area', 'base', 'basefont', 'br', 'hr', 'input', 'img', 'link', 'meta', 'col', 'param');
        if (is_null($selfclosing)) {
            $selfclosing = in_array($tag, $selfclosing_tags);
        }
        
        //The regexp is different for normal and self-closing tags because I can't figure out
        //how to make a sufficiently robust unified one.
        if ($selfclosing) {
            $tag_pattern =
                '@<(?P<tag>' . $tag . ')			# <tag
			(?P<attributes>\s[^>]+)?		# attributes, if any
			\s*/?>					# /> or just >, being lenient here
			@xsi';
        } else {
            $tag_pattern =
                '@<(?P<tag>' . $tag . ')			# <tag
			(?P<attributes>\s[^>]+)?		# attributes, if any
			\s*>					# >
			(?P<contents>.*?)			# tag contents
			</(?P=tag)>				# the closing </tag>
			@xsi';
        }
        
        $attribute_pattern =
            '@
		(?P<name>\w+)							# attribute name
		\s*=\s*
		(
			(?P<quote>[\"\'])(?P<value_quoted>.*?)(?P=quote)	# a quoted value
			|							# or
			(?P<value_unquoted>[^\s"\']+?)(?:\s+|$)			# an unquoted value (terminated by whitespace or EOF)
		)
		@xsi';
        
        //Find all tags
        if (!preg_match_all($tag_pattern, $html, $matches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) {
            //Return an empty array if we didn't find anything
            return array();
        }
        
        $tags = array();
        foreach ($matches as $match) {
            
            //Parse tag attributes, if any
            $attributes = array();
            if (!empty($match['attributes'][0])) {
                
                if (preg_match_all($attribute_pattern, $match['attributes'][0], $attribute_data, PREG_SET_ORDER)) {
                    //Turn the attribute data into a name->value array
                    foreach ($attribute_data as $attr) {
                        if (!empty($attr['value_quoted'])) {
                            $value = $attr['value_quoted'];
                        } else if (!empty($attr['value_unquoted'])) {
                            $value = $attr['value_unquoted'];
                        } else {
                            $value = '';
                        }
                        
                        //Passing the value through html_entity_decode is handy when you want
                        //to extract link URLs or something like that. You might want to remove
                        //or modify this call if it doesn't fit your situation.
                        $value = html_entity_decode($value, ENT_QUOTES, $charset);
                        
                        $attributes[$attr['name']] = $value;
                    }
                }
                
            }
            
            $tag = array(
                'tag_name' => $match['tag'][0],
                'offset' => $match[0][1],
                'contents' => !empty($match['contents']) ? $match['contents'][0] : '', //empty for self-closing tags
                'attributes' => $attributes,
            );
            
            if ($return_the_entire_tag) {
                $tag['full_tag'] = $match[0][0];
            }
            
            $tags[] = $tag;
        }
        
        return $tags;
    }
    
    
    function cURL($cookies = TRUE, $cookie = '/tmp/cookies.txt', $compression = 'gzip', $proxy = '') {
        $this->headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
        $this->headers[] = 'Connection: Keep-Alive';
        $this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
        $this->user_agent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)';
        $this->compression = $compression;
        $this->proxy = $proxy;
        $this->cookies = $cookies;
        if ($this->cookies == TRUE)
            $this->cookie($cookie);
    }
    
    function cookie($cookie_file) {
        if (file_exists($cookie_file)) {
            $this->cookie_file = $cookie_file;
        } else {
            fopen($cookie_file, 'w') or $this->error('The cookie file could not be opened. Make sure this directory has the correct permissions');
            $this->cookie_file = $cookie_file;
            fclose($this->cookie_file);
        }
    }
    
    function curlGet($url) {
        $url = str_replace("&amp;", '&', $url);
        
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($process, CURLOPT_HEADER, 0);
        curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
        if ($this->cookies == TRUE)
            curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
        if ($this->cookies == TRUE)
            curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
        curl_setopt($process, CURLOPT_ENCODING, $this->compression);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_HTTPGET, true);
        
        
        if ($this->proxy)
            curl_setopt($process, CURLOPT_PROXY, $this->proxy);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }
    
    
    function error($error) {
        echo $error;
    }
}
