<div class="row">
    <div class="col-md-2">
        <?php if ($showBtn) { ?>
            <div class="create-poll"><a href="<?= $this->Url->build(['controller' => 'Polls', 'action' => 'create']); ?>">Create Poll</a></div>
        <?php } else { ?>
            <div class="create-poll"><a href="javascript:void(0);" class="upgrade_account">Create Poll</a></div>
        <?php } ?>
    </div>
    <div class="col-md-10" id="polls"></div>
    <!-- div class="col-md-2"><h3 style="color: #F4B2BF; margin: -20px 0 0 0; text-align: center;">Exit Polling</h3></div -->
</div>
<?= $this->element('upgrade-account') ?>
<template id="questionTmpl">
    <div class="poll" id="poll_${id}" style="margin: -20px 0 0 0;">
        <div class="row">
            <div class="col-lg-2">
                <div class="poll-user"><img src="<?= PROFILE_IMAGE_PATH ?>thumbnail-${user.profile_image}" alt=""></div>
            </div>
            <div class="col-lg-10"
                 style="border-left:  1px solid #ededed; ">
                <form action="javascript:void(0);" class="poll_form" id="pollFormId_${id}">
                    <input type="hidden" name="poll_id" value="${id}">
                    <div class="row">
                        <div class="col-sm-12" style="border-bottom: 1px solid #ededed; padding-bottom: 10px;">
                            <div class="row">
                                <div class="col-sm-12"><h3 style="color: #0066A8">${topic}</h3></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12"><h5 style="color: #E02A4E">{{html question}}</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="radio radio-poll">
                                        
                                        {%if poll_answers.length %}
                                        {%if poll_answers[0].answer == "answer1" %}
                                        <input type="radio" name="poll_${id}" id="answer1_${id}" value="answer1"
                                               checked="checked" disabled="disabled">
                                        {%else%}
                                        <input type="radio" name="poll_${id}" id="answer1_${id}" value="answer1" disabled="disabled">
                                        {%/if%}
                                        {%else%}
                                        <input type="radio" name="poll_${id}" id="answer1_${id}" value="answer1">
                                        {%/if%}
                                        <label for="answer1_${id}" style="color:#7b7b7b;">${answer1}
                                            ${poll_answers.length}</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="radio radio-poll">
                                        {%if poll_answers.length %}
                                        {%if poll_answers[0].answer == "answer2" %}
                                        <input type="radio" name="poll_${id}" id="answer2_${id}" value="answer2"
                                               checked="checked" disabled="disabled">
                                        {%else%}
                                        <input type="radio" name="poll_${id}" id="answer2_${id}" value="answer2" disabled="disabled">
                                        {%/if%}
                                        {%else%}
                                        <input type="radio" name="poll_${id}" id="answer2_${id}" value="answer2">
                                        {%/if%}
                                        <label for="answer2_${id}" style="color:#7b7b7b;">${answer2}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="radio radio-poll">
                                        {%if poll_answers.length %}
                                        {%if poll_answers[0].answer == "answer3" %}
                                        <input type="radio" name="poll_${id}" id="answer3_${id}" value="answer3"
                                               checked="checked" disabled="disabled">
                                        {%else%}
                                        <input type="radio" name="poll_${id}" id="answer3_${id}" value="answer3" disabled="disabled">
                                        {%/if%}
                                        {%else%}
                                        <input type="radio" name="poll_${id}" id="answer3_${id}" value="answer3">
                                        {%/if%}
                                        <label for="answer3_${id}" style="color:#7b7b7b;">${answer3}</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="radio radio-poll">
                                        {%if poll_answers.length %}
                                        {%if poll_answers[0].answer == "answer4" %}
                                        <input type="radio" name="poll_${id}" id="answer4_${id}" value="answer4"
                                               checked="checked" disabled="disabled">
                                        {%else%}
                                        <input type="radio" name="poll_${id}" id="answer4_${id}" value="answer1" disabled="disabled">
                                        {%/if%}
                                        {%else%}
                                        <input type="radio" name="poll_${id}" id="answer4_${id}" value="answer4">
                                        {%/if%}
                                        <label for="answer4_${id}" style="color:#7b7b7b;">${answer4}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">&nbsp;</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 text-right">
                                    <label class="error" id="pollError_${id}"
                                           style="margin: 20px 0 0 0; float: left; display: none;">
                                        Please select an answer.
                                    </label>
                                    <label class="error" id="pollThanks_${id}"
                                           style="color: #B2D1E5;margin: 20px 0 0 0; float: left; display: none;">
                                        Thank you for polling.
                                    </label>
                                </div>
                                <div class="col-sm-2">
                                    {%if poll_answers.length %}
                                        <button class="btn btn-danger poll-the-question" style="background-color: #DA002C" id="pollBtn_${id}" disabled>
                                            <b>Polled</b>
                                        </button>
                                    {%else%}
                                        <button class="btn btn-danger poll-the-question" style="background-color: #DA002C" id="pollBtn_${id}">
                                            <b>Poll</b>
                                        </button>
                                    {%/if%}
                                    <!--button class="btn btn-danger poll-the-question" style="background-color: #DA002C"
                                            id="pollBtn_${id}">
                                        <b>Poll</b>
                                    </button -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    var loadPage = 1;
    var loadingData = false;
    $(function () {
    
        $('.upgrade_account').click(function () {
            $('#upgradeAccount').modal('show');
        });
        
        $("#polls").on("click", ".poll-the-question", function () {
            var id = $(this).attr('id').split('_')[1];
            $('#pollError_' + id).hide();
            var error = true;
            for (var i = 1; i <= 4; i++) {
                if ($('#answer' + i + "_" + id).is(':checked')) {
                    error = false;
                }
            }
            
            if (!error) {
                
                $('#pollBtn_' + id).attr("disabled", "disabled").html("Polled");
                for (var i = 1; i <= 4; i++) {
					$('#answer' + i + "_" + id).attr("disabled", "disabled").addClass('disabled');
				}
				
                $.ajax({
                    url: SITE_URL + "/polls/answer",
                    type: "POST",
                    data: $("#pollFormId_" + id).serialize(),
                    dataType: "json",
                    success: function (response) {
                        
                        if (response.code == 200) {
                            $('#pollThanks_' + id).fadeIn();
                        } else {
                            $().showFlashMessage("error", response.message);
                        }
                    }
                });
            } else {
                $('#pollError_' + id).fadeIn();
            }
            
        });
        
        function getPolls() {
            loadingData = true;
            $.ajax({
                url: SITE_URL + "/polls/get-polls-api/" + loadPage,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    
                    if (response.code == 200) {
                        loadPage = parseInt(loadPage) + 1;
                        $.template("questionTmpl", $('#questionTmpl').html());
                        $.tmpl("questionTmpl", response.data.polls).appendTo("#polls");
                        loadingData = false;
                    } else {
                        if (loadPage > 1) {
                            $("#polls").append('<h3 class="no-more-records">No more records found</h3>');
                        } else {
                            $().showFlashMessage("error", response.message);
                        }
                    }
                }
            });
            
        }
        
        setTimeout(function () {
            getPolls();
        }, 500);
        
        $(window).scroll(function () {
            if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                if (!loadingData) {
                    getPolls();
                }
            }
        });
        
    });


</script>
