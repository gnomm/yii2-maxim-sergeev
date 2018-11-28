<?php
//
//use yii\helpers\Html;
//use yii\grid\GridView;
//
///* @var $this yii\web\View */
///* @var $searchModel common\models\search\ChatSearch */
///* @var $dataProvider yii\data\ActiveDataProvider */
//
//$this->title = 'Chats';
//$this->params['breadcrumbs'][] = $this->title;
//?>
<!--<div class="chat-index">-->
<!---->
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!--    --><?php //// echo $this->render('_search', ['model' => $searchModel]); ?>
<!---->
<!--<!--    <p>-->-->
<!--<!--        -->--><?////= Html::a('Create Chat', ['create'], ['class' => 'btn btn-success']) ?>
<!--<!--    </p>-->-->
<!---->
<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
////        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'user_id',
//            'task_id',
//            'message',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>
<!--</div>-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WebSocet - client</title>

</head>
<body>

<form action="#" name = "chat_form" id="chat_form">
    <label >
        введите сообщение
        <input type="text" name="message">
        <input type="submit">
    </label>

</form>
<hr>

<div id="root_chat"></div>

</body>
<script src="client.js"></script>
</html>