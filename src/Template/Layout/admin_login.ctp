<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
        <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
        <title>
            <?= $this->fetch('title') ?> - <?= SITE_TITLE ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <?=
        $this->Html->css([
            'bootstrap.min',
            'font-awesome.min',
            'ionicons.min',
            'admin.lte',
            'iCheck/square/blue'
        ]) ?>

        <?=
        $this->Html->script([
            'jquery.min.js',
            'jquery.validate.min',
            'bootstrap.min',
            'iCheck/icheck.min'
        ])
        ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href=""><b><?= SITE_TITLE ?></b> Admin</a>
                
            </div>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
        <!-- /.login-box -->
        <!-- iCheck -->
        
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>
