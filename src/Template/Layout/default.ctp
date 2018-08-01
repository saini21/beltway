<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    
    <?= $this->Html->css(['bootstrap.min', 'style']) ?>
    
    <?=
    $this->Html->script([
        'jquery.min.js',
        'jquery.tmpl',
        'jquery.validate.min',
        'bootstrap.js',
        'wow.js',
        'flash-message',
        'moment',
        'socket.io-client/socket.io',
    ])
    ?>
    
    <script type="text/javascript">
        //var SITE_URL = '<?= $this->request->scheme() . '://' . $this->request->host() ?>';
        var SITE_URL = '<?= SITE_URL ?>';
        var currentUserId = <?= $authUser['id'] ?>;
        var HOST_IP = '<?= HOST_IP ?>';
        var SOCKET_PORT = <?= SOCKET_PORT ?>;
    </script>
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<?= $this->element('header') ?>
<div class="wrapper">
    <div class="container">
        <div class="container clearfix">
            <div class="flach-container">
                <?= $this->Flash->render() ?>
            </div>
            <?= $this->fetch('content') ?>
        </div>
    </div>
</div>

<?= $this->element('footer') ?>
<?= $this->element('coming_soon') ?>
<!-- Footer End -->
<?= $this->fetch('footer_script') ?>
<script>
    $(document).ready(function () {
        $('.message').attr('title', 'Click to Hide');
    });
</script>
</body>
</html>
