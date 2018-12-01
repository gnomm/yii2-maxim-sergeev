<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tasks', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php \yii\widgets\Pjax::begin()?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//        'id',
            'name',
            'description:ntext',
            'date',
            'responsible_id' => [
                'label' => 'Responsible',
                'value' => function ($data) {
                    return $data->responsible->username;

                },
            ],
            'initiator_id' => [
                'label' => 'Initiator',
                'value' => function ($data) {
                    return $data->initiator->username;
                }
            ],
//            'responsible_id' => [
//                'label' => 'Responsible',
////                'value' => function ($data) {
////                    return $data->responsible->username;
////                }
//            ],
////            'initiator_id',
//            'initiator_id' => [
//                'label' => 'Initiator',
////                'value' => function ($data) {
////                    return $data->user->username;
////                }
//            ],
            ['class' => 'yii\grid\ActionColumn'],

//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'name',
//            'description:ntext',
//            'date',
//            'responsible_id',
//
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?= \yii\helpers\Html::a("Обновить", ['task/index'], ['class' => 'btn btn-success']) ?>
    <?php \yii\widgets\Pjax::end()?>

</div>
