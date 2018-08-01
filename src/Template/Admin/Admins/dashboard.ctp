<?php $this->assign('title', __('Dashboard')) ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <!-- <small>Control panel</small> -->
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6 box-main">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?= $politicianCount ?></h3>
                    <p><?= __('Politicians') ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <?=
                $this->Html->link(
                        __('More info') . ' <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'Videos', 'action' => 'index','?' => [
                        'type' => 'all'
                    ]], ['escape' => false, 'title' => __('More info'), 'class' => 'small-box-footer']
                )
                ?>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6 box-main">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $privateCitizenCount ?></h3>
                    <p><?= __('Private Citizens') ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-group"></i>
                </div>
                <?=
                $this->Html->link(
                        __('More info') . ' <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'Hashtags', 'action' => 'index'], ['escape' => false, 'title' => __('More info'), 'class' => 'small-box-footer']
                )
                ?>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6 box-main">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= $activePollsCount ?></h3>
                    <p><?= __('Active Polls') ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-hand-pointer-o"></i>
                </div>
                <?=
                $this->Html->link(
                        __('More info') . ' <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'Users', 'action' => 'index'], ['escape' => false, 'title' => __('More info'), 'class' => 'small-box-footer']
                )
                ?>
            </div>
        </div>
    
        <div class="col-lg-3 col-xs-6 box-main">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $agendaCount ?></h3>
                    <p><?= __('Agendas') ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-list-alt"></i>
                </div>
                <?=
                $this->Html->link(
                    __('More info') . ' <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'Users', 'action' => 'index'], ['escape' => false, 'title' => __('More info'), 'class' => 'small-box-footer']
                )
                ?>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
