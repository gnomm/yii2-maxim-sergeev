<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


//use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\tables\tasks */
/* @var $form yii\widgets\ActiveForm */
/* @var $users  array */
?>

<?php //var_dump(Yii::$ap)?>
<?= \yii\grid\GridView::widget([
//    'model' => $model,
    'dataProvider' => $provider,
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
//        'image' => [
//            'attribute' => 'image',
//            'format' => 'html',
//            'value' => function ($data) {
//                return Html::a(Html::img(Yii::getAlias('@web/uploadImg/small/') . $data['image']),
//                    Yii::getAlias('@web/uploadImg/') . $data['image']);
////                return Html::img(Yii::getAlias('@web/uploadImg/small/') . $data['image']);
//            }
//        ],
//        [
//            'label' => 'Chat',
//            'format' => 'raw',
//            'value' => function ($data) {
//                $url = "http://front.task.local/chat/";
//                return Html::a('Перейти', $url, ['title' => 'Перейти']);
//            }
//        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}{link}', // кнопка просмотра, изменения, удаления, ссылка
        ],
    ],
]) ?>
