<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\tables\tasks */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Task', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name',
            'description:ntext',
            'date',
            'responsible_id' =>
                [
                    'label' => 'Name',
                    'value' => $model->user->username
                ],
            'initiator_id',
            'created_at',
            'updated_at'

//            'responsible_id',
        ],
    ]) ?>

</div>
