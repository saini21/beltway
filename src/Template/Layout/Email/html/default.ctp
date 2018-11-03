<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title><?= $this->fetch('title') ?></title>
</head>
<body>
<div style="width:820px; box-shadow: 0 4px 8px 0 #333333; text-shadow: 1px 1px 2px #ffffff;">
    <div style="width:100%">
        <span style="width:100%;text-align:center;">
            <img src="https://beltwaygraffiti.com/img/logo.png" class="CToWUd" alt="<?= SITE_TITLE ?>">
        </span>
    </div>
    <?= $this->fetch('content') ?>
    <div style="padding:0px 20px">
        <p style="padding:0px;font-weight:bold;color:#4b4b4b">Thank you! <br /> <?= SITE_TITLE ?></p>
    </div>
</div>
</body>
</html>
