<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav breadcrumb">
        <li><?= $this->Html->link(__('Exit Polling'), ['action' => 'exitPolling']) ?> </li>
        <li><?= $this->Html->link(__('My Polls'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="col-md-2"></div>
<div class="col-md-8">
    <div class="pc">
        <h4>Create Poll</h4>
        <div class="form-part-one pulbox">
            <?= $this->Form->create($poll, ['class' => 'question', 'id' => 'createPollForm']) ?>
            <div class="form-group">
                <div class="col-md-10">
                    <?= $this->Form->control('topic', ['class' => 'form-control', 'style' => "height:40px"]) ?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <?= $this->Form->control('question', ['class' => 'form-control', 'style' => "height:40px"]) ?>
                </div>
            </div>
            
            
            <div class="form-group">
                <div class="col-md-12"><h5>Fill Answers</h5></div>
                <div class="col-md-6">
                    <?= $this->Form->control('answer1', ['label' => 'Answer 1', 'class' => 'form-control', 'style' => "height:40px"]) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('answer2', ['label' => 'Answer 2','class' => 'form-control', 'style' => "height:40px"]) ?>
                </div>
            
            </div>
            
            <div class="form-group">
                <div class="col-md-6">
                    <?= $this->Form->control('answer3', ['label' => 'Answer 3','class' => 'form-control', 'style' => "height:40px"]) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('answer4', ['label' => 'Answer 4','class' => 'form-control', 'style' => "height:40px"]) ?>
                </div>
            
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <input type="submit" class="que-sub" value="SUBMIT QUESTION" id="createPollBtn">
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        
        
        $("#createPollForm").validate({
            rules: {
                topic: {
                    required: true
                },
                question: {
                    required: true
                },
                answer1: {
                    required: true
                },
                answer2: {
                    required: true
                },
                answer3: {
                    required: true
                },
                answer4: {
                    required: true
                }
                
            },
            messages: {
                topic: {
                    required: "Please enter topic"
                },
                question: {
                    required: "Please enter question"
                },
                answer1: {
                    required: "Please enter first answer choice"
                },
                answer2: {
                    required: "Please enter second answer choice"
                    
                },
                answer3: {
                    required: "Please enter third answer choice"
                },
                answer4: {
                    required: "Please enter fourth answer choice"
                }
            }
        });
        
        $(document).on("click", "#createPollBtn", function () {
            if ($("#createPollForm").valid() == true) {
                $("#createPollForm").submit();
            }
            
        });
    });
</script>
