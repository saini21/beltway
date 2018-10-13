<footer style="float: left; text-align: center; width: 100%; padding: 16px 0; color: #333; font-size: 12px;">
    &#169; 2018 Beltway Graffiti LLC <br />
    
    <?php if(!in_array($this->request->params['action'], ['privateCitizen', 'register'])) { ?>
    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'privacyPolicy']); ?>">Privacy Policy</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'termsOfService']); ?>">Terms of Service</a>
    <?php } ?>
</footer>
