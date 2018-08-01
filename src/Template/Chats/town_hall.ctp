<style>
    .discussions li {
        width: 100%;
        float: left;
        position: relative;
        background: #dddddd;
        color: #ffffff;
        border-bottom: 1px solid #aaaaaa;
    }
    
    .discussions li a {
        padding: 10px;
        width: 100%;
        color: #777777;
        font-weight: normal;
        float: left;
    }
    
    .active-chat {
        background: #d73233 !important;
    }
    
    .active-chat a {
        padding: 10px !important;
        width: 100% !important;
        color: #ffffff !important;
        font-weight: bold !important;
        float: left;
    }
    .no-more-message{
        text-align: center;
        width: 100%;
        color: #aaaaaa;
        font-size: 16px;
        margin-bottom: 25px;
        float: left;
    }
</style>

<div class="row">
    <div class="col-md-4">
        <h3 style="margin-top: 0px;">Discussions
            <a href="<?= $this->Url->build(['controller' => 'Chats', 'action' => 'createGroup']); ?>">
                <button class="btn btn-info pull-right" id="createChatBtn"><b>Create Group</b></button>
            </a>
        </h3>
        <ul class="discussions">
            <?php foreach ($chats as $chat) { ?>
                <li <?php if ($chat->token == $token) { ?> class="active-chat" <?php } ?>>
                    <a href="<?= $this->Url->build(['controller' => 'Chats', 'action' => 'townHall', $chat->token]); ?>"><?= $chat->name ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="col-md-8">
        <?php if (empty($currentChat)) { ?>
            <h5>Please create discussion group.</h5>
        <?php } else { ?>
            <div class="chat-box">
                <div class="chat-box-title">
                    <h5><?= $currentChat['name'] ?></h5>
                    <nav id="chat-menu">
                        <ul>
                            <li><a href="#">Setting <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul>
                                    <li>
                                        <a href="<?= $this->Url->build(['controller' => 'Chats', 'action' => 'editGroup', $token]); ?>">Edit
                                            Group</a></li>
                                    <!-- li><a href="#">Members</a></li -->
                                    <li><a href="#" data-toggle="modal" data-target="#deleteChatModal">Exit Group</a>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="chat-window" id="chatWindow"></div>
                
                <div class="submit-section">
                    <form action="javascriptL:void(0" method="post" id="sendMessageForm">
                        <div class="text-section">
                            <textarea placeholder="Type message here..." style="resize: none" name="message" id="messageArea" rows="1"></textarea>
                            <input type="submit" value="SEND" class="btn btn-danger pull-right" style="background: #d73233 !important; margin-top: 5px; font-weight: bold" />
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<template id="mineMessage">
    <div class="u-section s-left">
        <div class="u-msg">${message}</div>
        <div class="u-name">
            <p>
                <img src="${profile_image}" alt="${name}"><br>
                ${name}
            </p>
        </div>
    </div>
</template>
<template id="theirMessage">
    <div class="u-section">
        <div class="u-name">
            <p>
                <img src="${profile_image}" alt="${name}"><br>
                ${name}
            </p>
        </div>
        <div class="u-msg">${message}</div>
    </div>
</template>
<div class="modal fade" id="deleteChatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-bg">
                <h5 class="modal-title" id="exampleModalLongTitle">Exit Group - <?= $currentChat['name'] ?> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to exit from group?
            </div>
            <div class="modal-footer">
                <a href="<?= $this->Url->build(['controller' => 'Chats', 'action' => 'exitGroup', $token]); ?>" class="btn btn-danger">Exit Group</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    var chat = <?= json_encode($currentChat) ?>;
    var TOKEN = '<?= $token ?>';
    var userToken = '<?= md5($authUser['id']) ?>';
    var mainId = '<?= $authUser['id'] ?>';
</script>
<?= $this->Html->script([
    'chats'
]); ?>

