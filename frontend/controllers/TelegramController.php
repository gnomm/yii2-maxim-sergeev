<?php

namespace frontend\controllers;

use common\models\tables\TelegramMessage;
use SonkoDmitry\Yii\TelegramBot\Component;
use yii\web\Controller;

class TelegramController extends Controller
{
    public function actionReceive()
    {
        $messages = TelegramMessage::getTelegramMessage();

        return $this->render('receive',[
            'messages' => $messages
        ]);
    }

    public function actionSend()
    {
        TelegramMessage::getSendOneUser('466488726','привет');
    }
}