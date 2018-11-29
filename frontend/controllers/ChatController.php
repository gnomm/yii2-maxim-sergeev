<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\tables\Chat;
use common\models\search\ChatSearch;


class ChatController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ChatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}