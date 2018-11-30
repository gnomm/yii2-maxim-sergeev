<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\tables\tasks */
/* @var $form yii\widgets\ActiveForm */
/* @var $users  array */
?>

<?php //var_dump($model)?>
<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
        'language' => 'ru'
    ]) ?>

<!--    --><?//= $form->field($model, 'responsible_id')->tes ?>
    <?= $form->field($model, 'responsible_id')->dropDownList($users) ?>
<!--    --><?//= $form->field($model, 'responsible_id')->textInput(Yii::$app->user->identity->username) ?>
<!--    --><?//= $form->field($model, 'created_at') ?>
<!--    --><?//= $form->field($model, 'updated_at') ?>
<!--    --><?//= $form->field($model, 'image')->fileInput();?>
<!--    echo \yii\helpers\Html::submitButton('Загрузить');-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <!--    --><?php //echo \yii\jui\DatePicker::widget([
    //        'nodel' => $model,
    //        'attribute' => 'date',
    //        'dateFormat' => 'yyyy-MM-dd',
    //        'language' => 'ru'
    //    ]) ?>

    <?php ActiveForm::end(); ?>

</div>
