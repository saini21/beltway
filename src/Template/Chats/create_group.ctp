<h3>Create Discussion</h3>
<form action="<?= $this->Url->build(['controller' => 'Chats', 'action' => 'createGroup']); ?>" id="createCHatForm" method="post">
    <br/>
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-10">
            <label>Topic</label>
            <input type="text" style="height:40px" name="name" class="form-control"/>
            <label for="name" class="error" style="display: none; margin-top: 10px;">Please enter topic.</label>
        </div>
        <div class="col-lg-1">&nbsp;</div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-10">
            <label>Search Members to add</label>
            <input type="text" name="country" class="form-control" id="groupMember"/>
        </div>
    </div>
    <br/>
    
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-11"><h4>Members</h4></div>
        <div class="col-lg-1"></div>
        <div class="col-lg-6">
            <ul id="selectedMembers">
                <li class="member-suggestion">
					<?php if($authUser['profile_image']  == "default-user.png") { ?>
						<img src="<?= SITE_URL ?>/img/<?= $authUser['profile_image'] ?>" width="60">
                    <?php } else { ?>
						<img src="<?= PROFILE_IMAGE_PATH.$authUser['profile_image'] ?>" width="60">
					<?php } ?>
                    <label>&nbsp;&nbsp;&nbsp;<?= $authUser['first_name'] ?> <?= $authUser['last_name'] ?></label>
                    <input type="hidden" name="user_ids[]" class="user-ids" value="<?= $authUser['id']?>">
                </li>
            </ul>
        </div>
        <div class="col-lg-5">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-10">
            <a href="<?= $this->request->referer(); ?>" class="btn btn-danger pull-right" style=" margin-left: 20px;">Cancel</a>
            <input type="submit" value="Create Discussion" class="btn btn-success pull-right">
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
                    required: "Please enter topic."
                }
            }
        });
    });
</script>
