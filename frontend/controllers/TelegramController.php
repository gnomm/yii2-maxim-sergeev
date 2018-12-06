<?php

namespace frontend\controllers;

use SonkoDmitry\Yii\TelegramBot\Component;
use yii\web\Controller;

class TelegramController extends Controller
{
    public function actionReceive()
    {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;
        $bot->setCurlOption(CURLOPT_TIMEOUT, 20);
        $bot->setCurlOption(CURLOPT_CONNECTTIMEOUT, 10);
        $bot->setCurlOption(CURLOPT_HTTPHEADER, ['Expect:']);

        $updates = $bot->getUpdates();
//var_dump($updates);
        $messages = [];

        foreach ($updates as $update) {
            $message = $update->getMessage();
            $username = $message->getFrom()->getUsername();
//            $username = $message->get;
            $messages[] = [
                'text' => $message->getText(),
                'username' => $username
            ];
        }
//        var_dump($messages);
        return $this->render('receive',[
            'messages' => $messages
        ]);
    }

    public function actionSend()
    {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;
        $bot->sendMessage(357183223, 'From yii with love' );
    }
}