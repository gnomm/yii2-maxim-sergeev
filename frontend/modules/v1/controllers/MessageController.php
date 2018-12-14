<?php
/**
 * Created by PhpStorm.
 * User: gnom
 * Date: 07.12.2018
 * Time: 13:28
 */

namespace frontend\modules\v1\controllers;


use common\models\search\MessageFilter;
use common\models\tables\Message;
use common\models\tables\Users;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class MessageController extends ActiveController
{
    public $modelClass = Message::class;

//    public function behaviors()
//    {
//
//        $behaviors = parent::behaviors();
//        $behaviors['authentificator'] = [
//            'class' => HttpBasicAuth::class,
//            'auth' => function ($username, $password) {
//                $user = User::findByUsername($username);
//                if ($user != null && $user->validatePassword($password)) {
//                    return $user;
//                }
//                return null;
//            }
//        ];
//        return $behaviors;
//    }

    public function actions()
    {
    $action = parent::actions();
//    unset($action['delete']);
        unset($action['index']);
    return $action;
    }

    public function actionIndex()
    {
        $filter = \Yii::$app->request->get('filter');
//        var_dump($filter);exit;
        $query = Message::find();
//        $query->where(['user_id' => 2]);
        return new ActiveDataProvider([
            'query' => (new MessageFilter)->filter($filter, $query)
        ]);
    }



//    public function checkAccess($action, $mpde = null, $params = [])
//    {
//        if (!\Yii::$app->user->id) {
//            throw new ForbiddenHttpException();
//        }
//    }

}