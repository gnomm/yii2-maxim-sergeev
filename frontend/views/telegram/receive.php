<?php
$script = <<<JS
setInterval(function() {
  // console.log("1");
  $("#btnRefresh").click();
},
1000
)
JS;
$this->registerJs($script);
?>

<?php \yii\widgets\Pjax::begin() ?>
    <div class="messageContainer">
        <?php echo \yii\helpers\Html::a("Refresh", ["telegram/receive"], ['id' => 'btnRefresh', 'class' => 'btn btn-success']) ?>

        <?php foreach ($messages as $message): ?>
            <div>
                <strong><?= $message['username'] ?> : </strong>
                <?= $message['text'] ?>

            </div>
        <?php endforeach; ?>
    </div>
<?php \yii\widgets\Pjax::end() ?>