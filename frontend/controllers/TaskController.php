<?php

namespace frontend\controllers;

use app\events\SentTaskMailEvent;
use common\models\ContactForm;
use common\models\tables\Chat;
use common\models\tables\Project;
use common\models\tables\TelegramSp;
use common\models\tables\TelegramSpOld;
use Yii;
//use app\behaviors\MyBehaviors;
use common\models\tables\Tasks;
use common\models\tables\Users;
//use app\models\Test;
use common\models\User;
use yii\base\Event;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\rest\ActiveController;
use yii\swiftmailer\Mailer;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use app\validators\MyValidator;
use yii\validators;
use yii\web\UploadedFile;

class TaskController extends ActiveController
//class TaskController extends ActiveController
{
    public $modelClass = Tasks::class;

    public function actionIndex()
    {
        $month = date('n');
//        $month = 11;
        $id = Yii::$app->user->id;

//        var_dump(Yii::$app);exit;

        $provider = new ActiveDataProvider([
            'query' => Tasks::getTaskCurrentMonth($month, $id),

        ]);


        $users = ArrayHelper::map(Users::find()->all(), 'id', 'username');


        return $this->render('index', [
            'provider' => $provider,
            'users' => $users
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    protected function findModel($id)
    {
        if (($model = tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * Updates an existing tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $users = ArrayHelper::map(Users::find()->all(), 'id', 'username');
        return $this->render('update', [
            'model' => $model,
            'users' => $users
        ]);
    }


    /**
     * Deletes an existing tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionOne($id)
    {
        $model = Tasks::findOne($id);
        $channel = "task_{$id}";
//        var_dump($channel);
        return $this->render("one", [
            'model' => $model,
            'history' => Chat::getChannelHistory($channel),
            'channel' => $channel
        ]);
    }


        public function actionTest()
    {
        $id = TelegramSp::getTelegramIdUser();
        echo  $id;
//        /** @var Component $bot */
//        $bot = Yii::$app->bot;
//        $updates = $bot->getUpdates();
//
//        foreach ($updates as $update) {
//            $id = $update->getMessage()->getFrom()->getId();
//        }
//        echo $id;




//        $test = TelegramSpOld::getSendSp();
//        var_dump($test);exit;
//        var_dump(Project::getTask(1));

//        $project = new Project();
//        $project-
//        var_dump($project);
//        $test = function ($data) {
////             $data->user->username;
//$data->_identity->username;
//        };
//        var_dump($test);
//        Chat::addChat();


//        var_dump(Yii::$app->getDb());
//        $test = (Yii::$app->session['__id']);

//var_dump(Yii::$app->user->identity->username);
//        $chat = new Chat();
//        $chat->responsible_id = 2;
//        $chat->task_id = 1;
//        $chat->message = 'test';
//        $chat->save();
//$user = User::findIdentity(Yii::$app->session['__id']);
//var_dump($user);
//        var_dump(User::findByUsername($user));
//        var_dump(Yii::$app->session['__id']);
//        var_dump($_SESSION);

//        $user = new Users();
//        $user->username = 'user3';
//        $user->password_hash = 'qwerty';
//        $user->email = 'tets@test.ru3';
//        $user->save();

//        $dateDeadline = Tasks::find()
////            ->where('date')
//            ->all();
//
//
//        foreach ($dateDeadline as $value) {
//            var_dump($value['date']);
//        }
//       \Yii::$app->language = "en";
//        echo \Yii::t("app", 'error', ['error_code' => 404]);
//        exit;

//        $model = new Test();
//        if (\Yii::$app->request->isPost) {
//            $model->load(Yii::$app->request->post());
//            $model->image = UploadedFile::getInstance($model, 'image');
//            $model->upload();
////            var_dump( $model->upload());
////            exit;
////            var_dump($model);
//        }
//
//        return $this->render('test', ['model' => $model]);
////        exit;


//        $user = new Users();
//        $user->username = 'qwerty';
//        $user->password = \Yii::$app->security->generatePasswordHash('qwerty');
//        $user->role_id = 2;
//        $user->save();


//         var_dump(Yii::$app->user->id);
//        echo 'sss';

//        $user = new Users();
//        $user->username = 'admin';
//        $user->password = \Yii::$app->security->generatePasswordHash('admin');
//        $user->email = 'admin@admin.ru';
//        $user->role_id = 1;
////        var_dump($user);
//        $user->save();

//        Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, function ($event) {
//
//            $userEmail = Tasks::getUserEmail($event);
//
//            Yii::$app->mailer->compose()
//                ->setTo($userEmail->user->email)
//                ->setFrom(\Yii::$app->params['adminEmail'])
//                ->setSubject($event->sender->name)
//                ->setTextBody($event->sender->description)
//                ->send();
//        });


//        $task = new Tasks();
//        $task->name = 'Test send';
//        $task->description = 'new task';
//        $task->date = '2018-10-21';
//        $task->responsible_id = 4;
//        $task->save();

        //        $model = new Test;
//        $model->attachBehavior('my', [
//            'class' => MyBehaviors::class,
//            'massage' => 'sdvdsvsdvsdv'
//        ]);
//
//        $model->detachBehavior('my');
//
//        $model->title = '321';
//        $model->bar();
//        exit;
//        Event::on(Users::class, Users::EVENT_AFTER_INSERT, function ($event){
//            $task = new Tasks([
//                'name' => 'Ознакомиться с проектом',
//                'description' => 'Описаение задания',
//                'responsible_id' => $event->sender->id
//            ]);
//            $task->save();
//        });
//
//
//        $user = new Users();
//        $user->username = 'ivan';
//        $user->password = \Yii::$app->security->generatePasswordHash('qwerty');
//        $user->role_id = 2;
//        $user->save();
//
//
//        $handler1 = function ($event){
////            var_dump($event);
//            echo "первый обродобтчик сработал {$event->massage}";
//        };
//        Event::on(Test::class, Test::EVENT_FOO_START, $handler1);
//        $model = new Test();
//    //    $model->on(Test::EVENT_FOO_START, $handler1);
//        $model->foo();
//
////        $model->on(Test::EVENT_FOO_END, function (){
////            echo "второй обродобтчик сработал";
////        }
////        );
////
////        $model->on(Test::EVENT_FOO_START, [new \stdClass(), 'sxsasss']);
////
////        $model->foo();
////
////        $model->off(Test::EVENT_FOO_START, $handler1);
////        $model->foo();
//
//        exit;


    }


}