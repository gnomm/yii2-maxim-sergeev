<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\tables\tasks */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //            'id',
            'name',
            'description:ntext',
            'date',
//            'responsible_id' =>
//                [
//                    'label' => 'Responsible',
////                    'value' => $model->user->username
//                ],
//            'initiator_id' =>[
//                'label' => 'Initiator',
////                'value' => $model->user->username
//            ],
            'responsible_id' =>
                [
                    'label' => 'Responsible',
                    'value' => $model->responsible->username
                ],
            'initiator_id' => [
                'label' => 'Initiator',
                'value' => $model->initiator->username
//                'value' => $model->user->username
            ],
            'project_id',
            'created_at',
            'updated_at'
//            'id',
//            'name',
//            'description:ntext',
//            'date',
//            'responsible_id',
        ],
    ]) ?>

</div>
