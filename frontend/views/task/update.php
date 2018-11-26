<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\tables\tasks */
/* @var $users array */


$this->title = 'Update Tasks: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tasks-update">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    --><?php //var_dump($users)?>
<!--    --><?php //var_dump($model)?>
    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users
    ]) ?>

</div>
