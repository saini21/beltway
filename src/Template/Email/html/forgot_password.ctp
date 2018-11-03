<div style="padding:0px 20px">
    <span style="width:100%;display:inline-block;color:#4b4b4b;font-size:1em;margin:20px 0 0">Hello <?= $name ?>, </span>
    <h4 style="margin-top:15px">It seems that you have forgotten your password of your <?= $appName ?> account.</h4>
    <p style="color:#4b4b4b">Don't worry your password is just a click away. <a href="<?= $resetUrl; ?>" target="_blank">Click here to reset.</a> or use the following link to reset your password.</p>
    <p><?= $resetUrl; ?></p>
    <p style="color:#4b4b4b">If you didn't request this, please ignore this email.<br>Your password won't change until you access the link above and create a new one.</p>
</div>
