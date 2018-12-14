<?php
/**
 * Created by PhpStorm.
 * User: gnom
 * Date: 14.12.2018
 * Time: 11:44
 */

namespace common\models\tables;


use SonkoDmitry\Yii\TelegramBot\Component;
use yii\db\ActiveRecord;

class TelegramMessage extends ActiveRecord
{
    public static function getTelegramMessage()
    {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;
        $bot->setCurlOption(CURLOPT_TIMEOUT, 20);
        $bot->setCurlOption(CURLOPT_CONNECTTIMEOUT, 10);
        $bot->setCurlOption(CURLOPT_HTTPHEADER, ['Expect:']);

        $updates = $bot->getUpdates();
        $messages = [];

        foreach ($updates as $update) {
            $message = $update->getMessage();
            $username = $message->getFrom()->getUsername();
            $messages[] = [
                'text' => $message->getText(),
                'username' => $username
            ];
        }
        return $messages;
    }

    public static function getSendOneUser($id, $messages)
    {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;
        $bot->sendMessage($id, $messages);
    }
}