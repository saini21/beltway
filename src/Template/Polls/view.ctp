<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Poll $poll
 */
$answers = $poll->poll_answers;
$totalPolls = count($answers);
$a1 = 0;
$a2 = 0;
$a3 = 0;
$a4 = 0;
foreach ($answers as $answer) {
    switch ($answer['answer']) {
        case "answer1":
            {
                $a1++;
                break;
            }
        case "answer2":
            {
                $a2++;
                break;
            }
        case "answer3":
            {
                $a3++;
                break;
            }
        case "answer4":
            {
                $a4++;
                break;
            }
    }
}

if($totalPolls > 0) {
    $answer1Percent = ($a1 / $totalPolls) * 100;
    $answer2Percent = ($a2 / $totalPolls) * 100;
    $answer3Percent = ($a3 / $totalPolls) * 100;
    $answer4Percent = ($a4 / $totalPolls) * 100;
} else {
    $answer1Percent = 0;
    $answer2Percent = 0;
    $answer3Percent = 0;
    $answer4Percent = 0;
}


echo $this->Html->css(['morris/morris']);

echo $this->Html->script([
    'raphael/raphael.min',
    'morris/morris'
]);

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav breadcrumb">
        <li><?= $this->Html->link(__('Create Poll'), ['action' => 'create']) ?> </li>
        <li><?= $this->Html->link(__('My Polls'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Edit Current Poll'), ['action' => 'edit', $poll->id]) ?> </li>
    </ul>
</nav>
<h3 style="color: #0066A8"><?= $poll->topic ?></h3>
<div class="row">
    <div class="col-lg-12" style="color: #E02A4E"><label>Question:</label> <?= $poll->question ?></div>
</div>
<div class="row">
    <div class="col-lg-12">&nbsp;</div>
</div>
<?php if($totalPolls > 0) { ?>
<div class="row">
    <div class="col-lg-6">
        <!-- Donut Chart -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <div id="donut_chart" class="graph"></div>
                </div>
            </div>
        </div>
        <!-- #END# Donut Chart -->
    </div>
    <div class="col-lg-6">
        <div style="margin: 50px 0 0 0">
            <div class="row">
                <div class="col-lg-4"><?= @$answer1Percent ?> %</div>
                <div class="col-lg-4">answered</div>
                <div class="col-lg-4"><?= $poll->answer1 ?></div>
            </div>
            <div class="row">
                <div class="col-lg-4"><?= @$answer2Percent ?> %</div>
                <div class="col-lg-4">answered</div>
                <div class="col-lg-4"><?= $poll->answer2 ?></div>
            </div>
            <div class="row">
                <div class="col-lg-4"><?= @$answer3Percent ?> %</div>
                <div class="col-lg-4">answered</div>
                <div class="col-lg-4"><?= $poll->answer3 ?></div>
            </div>
            <div class="row">
                <div class="col-lg-4"><?= @$answer4Percent ?> %</div>
                <div class="col-lg-4">answered</div>
                <div class="col-lg-4"><?= $poll->answer4 ?></div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<div class="row">
    <div class="col-lg-12">&nbsp;</div>
</div>
<div class="row">
    <div class="col-lg-8" style="color: #E96680"><label>Total Polls:</label> <?= $totalPolls ?></div>
    <div class="col-lg-3 right text-right">
        <a href="<?= $this->Url->build(['controller' => 'Polls', 'action' => 'index']); ?>" class="btn btn-success">Back</a>
    </div>
    <div class="col-lg-1">&nbsp;</div>
</div>
<script>
    $(function () {
        Morris.Donut({
            element: 'donut_chart',
            data: [{
                label: '<?= $poll->answer1 ?>',
                value: <?= $answer1Percent ?>
            }, {
                label: '<?= $poll->answer2 ?>',
                value: <?= $answer2Percent ?>
            }, {
                label: '<?= $poll->answer3 ?>',
                value: <?= $answer3Percent ?>
            }, {
                label: '<?= $poll->answer4 ?>',
                value: <?= $answer4Percent ?>
            }],
            colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)'],
            formatter: function (y) {
                return y + '%'
            }
        });
    });

</script>
