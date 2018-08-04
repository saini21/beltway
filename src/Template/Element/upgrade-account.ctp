<div class="modal fade" id="upgradeAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-bg">
                <h5 class="modal-title" id="exampleModalLongTitle">Upgrade Your Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <b>To enjoy this feature please upgrade your account</b>
                <br/>
            </div>
            <div class="modal-footer">
                <?php if ($authUser['role'] == "Politician") { ?>
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'politician']); ?>"
                       class="btn btn-success">Upgrade</a>
                <?php } else { ?>
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'privateCitizen']); ?>"
                       class="btn btn-success">Upgrade</a>
                <?php } ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
