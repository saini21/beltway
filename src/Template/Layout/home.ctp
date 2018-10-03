<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= SITE_TITLE ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    
    <?= $this->Html->css(['bootstrap.min', 'style']) ?>
    
    <?=
    $this->Html->script([
        'jquery.min.js',
        'jquery.validate.min',
        'bootstrap.js',
        'wow.js',
        'flash-message'
    ])
    ?>
    
    <script type="text/javascript">
        //var SITE_URL = '<?= $this->request->scheme() . '://' . $this->request->host() ?>';
        var SITE_URL = '<?= SITE_URL ?>';
    </script>
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<?= $this->element('home-header') ?>
<div class="wrapper">
    <div class="container">
        <div class="container clearfix container-fluid">
            <div class="flach-container">
                <?= $this->Flash->render() ?>
            </div>
            <?= $this->fetch('content') ?>
        </div>
    </div>
</div>
<?php if (in_array($this->request->params['action'], ['register', 'login'])) { ?>
    <?= $this->element('footer') ?>
<?php } ?>
<?= $this->element('coming_soon') ?>
<!-- Footer End -->

<?= $this->fetch('footer_script') ?>

<script>
    $(document).ready(function () {
        $('.message').attr('title', 'Click to Hide');
        setTimeout(function () {
            $('.flach-container').fadeOut(2000);
        }, 4000)
        
    });
</script>
</body>
</html>
