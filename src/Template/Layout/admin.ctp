<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
        <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
        <title>
            <?= isset($title) ? $title : $this->fetch('title') ?> - <?= SITE_TITLE ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <?=
        $this->Html->css([
            'bootstrap.min',
            'font-awesome.min',
            'ionicons.min',
            '_all-skins.min',
            'iCheck/square/blue',
            'admin.lte'])
        ?>

        <?=
        $this->Html->script([
            'jquery.min.js',
            'jquery.validate.min',
            'bootstrap.min',
            'admin',
            'admin.demo',
            'RowSorter'
        ])
        ?>

        <!-- iCheck -->
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
        <script type="text/javascript">
            var SITE_URL = '<?= SITE_URL ?>';
        </script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?= $this->Url->build(['controller' => 'Admins', 'action' => 'dashboard']) ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b><?= SITE_TITLE ?></b><?= __('Admin') ?></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b><?= SITE_TITLE ?></b><?= __('Admin') ?></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only"><?= __('Toggle navigation') ?></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?= $this->Html->image(SITE_URL . $this->request->session()->read('Auth.User.profile_image'), ['class' => 'user-image', 'alt' => __('User Image')]) ?>
                                    <span class="hidden-xs"><?= $this->request->session()->read('Auth.User.name') ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <?= $this->Html->image(SITE_URL . $this->request->session()->read('Auth.User.profile_image'), ['class' => 'img-circle', 'alt' => __('User Image')]) ?>
                                        <p>
                                            <?= $this->request->session()->read('Auth.User.name') ?> - <?= $this->request->session()->read('Auth.User.role') ?>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <?= $this->Html->link(__('Profile'), ['controller' => 'Admins', 'action' => 'profile'], ['class' => 'btn btn-default btn-flat']) ?>
                                        </div>
                                        <div class="pull-right">
                                            <?= $this->Html->link('Sign out', ['controller' => 'Admins', 'action' => 'logout'], ['class' => 'btn btn-default btn-flat']) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <?= $this->element('Admin/sidebar') ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>
                    <?= __('Copyright') ?> &copy; <?= date('Y') ?>-<?= date('Y') + 1 ?> <?= SITE_TITLE ?>.
                </strong> <?= __('All rights reserved') ?>.
            </footer>
        </div>
        <!-- ./wrapper -->


        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->



    </body>


</html>
