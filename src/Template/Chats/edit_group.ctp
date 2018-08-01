<h3>Create Group</h3>
<form action="<?= $this->Url->build(['controller' => 'Chats', 'action' => 'editGroup', $token]); ?>" id="createCHatForm" method="post">
    <input type="hidden" name="token" value="<?= $token?>">
    <br/>
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-10">
            <label>Group Name (Topic)</label>
            <input type="text" style="height:40px" name="name" class="form-control" value="<?= $chat['name'] ?>"/>
            <label for="name" class="error" style="display: none; margin-top: 10px;">Please enter group name.</label>
        </div>
        <div class="col-lg-1">&nbsp;</div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-10">
            <label>Members</label>
            <input type="text" name="country" class="form-control" id="groupMember"/>
        </div>
    </div>
    <br/>
    
    
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-11"><h4>Group Members</h4></div>
        <div class="col-lg-1"></div>
        <div class="col-lg-6">
            <ul id="selectedMembers">
                <?php foreach ($chat['chat_members'] as $userId => $user){ ?>
                
                <li class="member-suggestion">
                    <img src="<?= $user['profile_image'] ?>" width="60">
                    <label>&nbsp;&nbsp;&nbsp;<?= $user['name'] ?></label>
                    <input type="hidden" name="user_ids[]" class="user-ids" value="<?= $userId?>">
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-lg-5">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-10">
            <a href="<?= $this->Url->build(['controller' => 'Chats', 'action' => 'townHall', $token]); ?>" class="btn btn-danger pull-right" style=" margin-left: 20px;">Cancel</a>
            <input type="submit" value="Create Group" class="btn btn-success pull-right">
        </div>
    </div>
    <br/>
</form>
<template id="chatMemberTmp">
    <li class="member-suggestion">
        <img src="${profile_image}" width="60">
        <label>&nbsp;&nbsp;&nbsp;${name}</label>
        <input type="hidden" name="user_ids[]" class="user-ids" value="${id}" />
        <button class="btn btn-danger remove-member pull-right" title="Remove Member">&times;</button>
    </li>
</template>
<?= $this->Html->script(['jquery.autocomplete']); ?>
<script>
    $(function () {
        'use strict';
        
        $('#groupMember').autocomplete({
            //serviceUrl: SITE_URL + '/chats/suggestMembers',
            formatResult:function (suggestion, currentValue) {
                if (!currentValue) {
                    return suggestion.value;
                }
                
                return suggestion.value;
            },
            lookup: function (query, done) {
                
                var userIds = [];
                
                $('.user-ids').each(function () {
                    userIds.push($(this).val());
                });
                
                $.ajax({
                    url: SITE_URL + '/chats/suggestMembers/?q=' + query,
                    dataType: "JSON",
                    type: "POST",
                    data:{'user_ids':userIds},
                    success: function (resp) {
                        done(resp);
                    }
                })
            },
            onSelect: function (suggestion) {
                $('#groupMember').val('');
                $.template("chatMemberTmp", $('#chatMemberTmp').html());
                $.tmpl("chatMemberTmp", [suggestion.data]).appendTo("#selectedMembers");
            },
            onHint: function (hint) {
                $('#groupMember').val(hint);
            },
            onInvalidateSelection: function () {
                $('#selction-ajax').html('You selected: none');
            }
        });
        
        $('#selectedMembers').on('click','.remove-member', function () {
            $(this).parent().remove();
        });
        $("#createCHatForm").validate({
            rules: {
                name: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter group name."
                }
            }
        });
    });
</script>
