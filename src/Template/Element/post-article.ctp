<div class="modal fade " id="postArticle" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-bg">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times" style="color: #ffffff;"></i>
                </button>
            </div>
            <form action="javascript:void(0);" id="agendaForm">
                <input type="hidden" name="id" id="articleId" value="0"/>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-2"><label for="agendaSubject">Subject</label></div>
                        <div class="col-lg-10">
                            <input type="text" name="title" class="form-control" placeholder="Subject"
                                   id="agendaSubject">
                            <label for="agendaSubject" class="error" style="margin-top: 10px;"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2"><label for="agendaContent">Agenda</label></div>
                        <div class="col-lg-10">
                            <textarea type="text" name="content" class="form-control" placeholder="Post"
                                      id="agendaContent" style="height:250px;"></textarea>
                            <label for="agendaContent" class="error" style="margin-top: 10px;"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">&nbsp;</div>
                        <div class="col-lg-10">
                            <div id="urlPreview"
                                 style="display: block; border: 1px solid #ededed; margin: 3% 0% 0 3%; float:left; ">
                                <div class="row">
                                    <div class="col-lg-4" id="edit_previewImage">
                                        <img src="" style="width: 100%; float: left;"/>
                                        <input type="hidden" name="link_image" class="link-fields" id="edit_linkImage"
                                               style="margin-top: 10px;"/>
                                    </div>
                                    <div class="col-lg-8" id="previewDetails">
                                        <input type="hidden" name="link" class="link-fields" id="edit_link"/>
                                        <input type="hidden" name="link_host" class="link-fields" id="edit_linkHost"/>
                                        <input type="hidden" name="link_title" class="link-fields" id="edit_linkTitle"/>
                                        <input type="hidden" name="link_description" class="link-fields"
                                               id="edit_linkDescription"/>
                                        <h5 id="edit_siteBaseUrl"></h5>
                                        <h4 id="edit_siteTitle"></h4>
                                        <p id="edit_siteDescription"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">&nbsp;</div>
                        <div class="col-lg-10 text-right" style="color: #337ab7">
                            <div id="editMultipleFileUploader" style="display: none"></div>
                            
                            <div class="ajax-file-upload-container" id="ajaxContainerPopup"></div>
                            <input type="hidden" name="article_images" id="articleImagesPopup" value=""/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p id="editAllowedFiles" class="blink pull-left">Only JPG, JPEG AND PNG are supported</p>
                    <p id="editFileLimit" class="blink1" style="display:none;">You can upload maximum 10 images.</p>
                    <button type="button" onclick="editChooseFile();" class="btn btn-primary"
                            style=" font-weight: bold;"><i
                            class="fa fa-image"></i> Photo
                    </button>
                    <script>
                        function editChooseFile() {
                            document.getElementById("edit-ajax-upload-id").click();
                        }
                    </script>
                    <input type="submit" class="btn btn-success" value="Update" id="publishAgendaBtn"/>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var uploadedImageCount = 0;
    $(function () {
        
        $("#agendaForm").validate({
            rules: {
                title: {
                    required: true
                },
                content: {
                    required: true
                },
            },
            messages: {
                title: {
                    required: "Please enter agenda subject"
                },
                content: {
                    required: "Please enter agenda description"
                }
            },
            submitHandler: function (form) {
                
                if (!photoTypeError) {
                    $.ajax({
                        url: SITE_URL + "/articles/add-api",
                        type: "POST",
                        data: $("#agendaForm").serialize(),
                        dataType: "json",
                        success: function (response) {
                            var ArticleId = $('#articleId').val();
                            
                            if (response.code == 200) {
                                $('#postArticle').modal('hide');
                                $('articleId').val('0');
                                $.template("articleTmpl", $('#articleTmpl').html());
                                if (ArticleId == 0) {
                                    $.tmpl("articleTmpl", [response.data.article]).prependTo("#atricles");
                                } else {
                                    $("#article_" + ArticleId).replaceWith($.tmpl("articleTmpl", [response.data.article]));
                                }
                            } else {
                                $().showFlashMessage("error", response.message);
                            }
                            
                            $('#ajaxContainer').html('');
                        }
                    });
                    return false;
                }
            }
        });
        
        $('#atricles').on('click', '.edit_article', function () {
            var id = $(this).attr('id').split('_')[1];
            $("#ajaxContainerPopup, #edit_siteBaseUrl, #edit_siteTitle, #edit_siteDescription").html("");
            $('#edit_link, #edit_linkHost, #edit_linkTitle, #edit_linkDescription, #edit_linkImage').val('');
            $('#edit_previewImage img').attr('src', '');
            
            uploadedImageCount = 0;
            $.ajax({
                url: SITE_URL + "/articles/get-article-api/" + id,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    
                    if (response.code == 200) {
                        $('#agendaSubject').val(response.data.article.title);
                        $('#agendaContent').val(response.data.article.content);
                        $('#articleId').val(response.data.article.id);
                        $('#articleImagesPopup').val(response.data.article.article_images);
                        
                        
                        $('#edit_siteBaseUrl').html(response.data.article.link_host);
                        $('#edit_siteTitle').html(response.data.article.link_title);
                        $('#edit_siteDescription').html(response.data.article.link_description);
                        $('#edit_previewImage img').attr('src', response.data.article.link_image);
                        
                        //
                        $('#edit_link').val(response.data.article.link);
                        $('#edit_linkHost').val(response.data.article.link_host);
                        $('#edit_linkTitle').val(response.data.article.link_title);
                        $('#edit_linkDescription').val(response.data.article.link_description);
                        $('#edit_linkImage').val(response.data.article.link_image);
                        
                        $('#publishAgendaBtn').val('Update');
                        if (response.data.article.article_images.length != 0) {
                            var images = response.data.article.article_images.split(",");
                            var imgs = [];
                            $.each(images, function (index, img) {
                                imgs.push({index: index, img: img});
                                uploadedImageCount = parseInt(uploadedImageCount) + 1;
                            });
                            $.template("imageTmpl", $('#imageTmpl').html());
                            $.tmpl("imageTmpl", imgs).appendTo("#ajaxContainerPopup");
                        }
                        $('#postArticle').modal('show');
                    } else {
                        $().showFlashMessage("error", response.message);
                    }
                }
            });
            
        });
        
        
        var editSettings = {
            url: SITE_URL + "/articles/upload",
            method: "POST",
            allowedTypes: "jpg,jpeg,png",
            fileName: "file",
            fileUploadId: "edit-ajax-upload-id",
            multiple: true,
            showQueueDiv: 'ajaxContainerPopup',
            showError: false,
            dragdropWidth: '100%',
            statusBarWidth: '100%',
            showFileCounter: false,
            maxFileCount: 10,
            showDelete: true,
            onSuccess: function (files, data, xhr, pd) {
                //
                var d = JSON.parse(data);
                
                if (d.code == 400) {
                    pd.progressbar.removeClass('ajax-file-upload-bar').addClass('ajax-file-upload-red').html("Failed");
                }
                
                if (d.code == 200) {
                    var images = [];
                    if ($('#articleImagesPopup').val().length > 0) {
                        images = $('#articleImagesPopup').val().split(',');
                    }
                    images.push(d.data.path);
                    $('#articleImagesPopup').val(images.join(","));
                }
            },
            onSelect: function (files) {
                uploadedImageCount = uploadedImageCount + files.length;
                if (uploadedImageCount > 10) {
                    //Blink 5 Times
                    editBlinkLimit();
                    editBlinkLimit();
                    editBlinkLimit();
                    editBlinkLimit();
                    editBlinkLimit();
                    return false;
                } else {
                    $('#editFileLimit').hide();
                }
                
            },
            onError: function (files, status, errMsg) {
                $("#finalStatus").html("<font color='red'>Upload is Failed</font>");
            },
            deleteCallback: function (data, pd) {
                var d = JSON.parse(data);
                if (d.code == 200) {
                    var images = $('#articleImagesPopup').val().split(',');
                    var finalImages = [];
                    $.each(images, function (i, img) {
                        if (d.data.path != img) {
                            finalImages.push(img);
                        }
                    });
                    $('#articleImagesPopup').val(finalImages.join(","));
                }
            },
        }
        
        $("#editMultipleFileUploader").uploadFile(editSettings);
        
        function editBlinkLimit() {
            $('.blink1').fadeOut(500);
            $('.blink1').fadeIn(500);
            $('#editFileLimit').css('color', "#ea4d4d").css('font-weight', "bold");
        }
        
        var editProgress = null;
        $('#agendaContent').keyup(function () {
            var q = $(this).val();
            $("#ajaxContainerPopup, #edit_siteBaseUrl, #edit_siteTitle, #edit_siteDescription").html("");
            $('#edit_link, #edit_linkHost, #edit_linkTitle, #edit_linkDescription, #edit_linkImage').val('');
            editProgress = $.ajax({
                type: 'POST',
                data: 'q=' + q,
                url: SITE_URL + "/articles/url-exists/",
                dataType: "JSON",
                beforeSend: function () {
                    //checking progress status and aborting pending request if any
                    if (editProgress != null) {
                        editProgress.abort();
                    }
                },
                success: function (response) {
                    if (response.code == 200) {
                        
                        $.ajax({
                            type: 'POST',
                            data: 'url=' + response.data.link,
                            dataType: "JSON",
                            url: SITE_URL + "/articles/fetch-preview/",
                            beforeSend: function () {
                                $('#edit_siteBaseUrl').html('Fetching Preview...');
                                $('#edit_previewImage img').attr('src', '');
                                $('#edit_siteTitle, #edit_siteDescription').html('');
                            },
                            success: function (resp) {
                                if (resp.code == 200) {
                                    if (typeof  resp.data.alternate_image != undefined) {
                                        $('#edit_previewImage img').attr('src', resp.data.alternate_image);
                                    }
                                    
                                    if (typeof  resp.data.image != undefined) {
                                        $('#edit_previewImage img').attr('src', resp.data.image);
                                    }
                                    
                                    $('#edit_siteBaseUrl').html(resp.data.host);
                                    $('#edit_siteTitle').html(resp.data.title);
                                    $('#edit_siteDescription').html(resp.data.description);
                                    
                                    //
                                    $('#edit_link').val(resp.data.url);
                                    $('#edit_linkHost').val(resp.data.host);
                                    $('#edit_linkTitle').val(resp.data.title);
                                    $('#edit_linkDescription').val(resp.data.description);
                                    $('#edit_linkImage').val(resp.data.image);
                                }
                            }
                        });
                        
                    } else {
                        //Do Somethig
                    }
                },
                complete: function () {
                    // after ajax xomplets progress set to null
                    editProgress = null;
                }
            });
        });
        
    });
</script>
