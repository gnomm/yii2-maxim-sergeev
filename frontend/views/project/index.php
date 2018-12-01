<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--    <p>-->
    <!--        --><? //= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    <!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],


//            'id',
//            [
//                'label' => 'Chat',
//                'format' => 'raw',
//                'value' => function ($data) {
//                    $url = "http://front.task.local/task/";
//                    return Html::a('name', $url, ['title' => 'Перейти']);
//                }
//            ],
            'name' => [
                'label' => 'project',
                'format' => 'raw',
                'value' => function ($data) {
                    $url = "http://front.task.local/task/";
                    $name = $data->name;
                    return Html::a($name, $url, ['title' => 'Перейти']);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}{link}', // кнопка просмотра, изменения, удаления, ссылка
            ],
//[
//
////
//],

        ],
    ]); ?>
</div>
