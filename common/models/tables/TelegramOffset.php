<?php

namespace common\models\tables;

use SonkoDmitry\Yii\TelegramBot\Component;
use TelegramBot\Api\Types\Update;
use Yii;

/**
 * This is the model class for table "telegram_offset".
 *
 * @property int $id
 * @property string $timestamp_offset
 */
/** @var Component */
class TelegramOffset extends \yii\db\ActiveRecord
{

//    /** @var Component */
//    public $bot;
//    public $offset = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telegram_offset';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['timestamp_offset'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timestamp_offset' => 'Timestamp Offset',
        ];
    }

//    public function getOffset()
//    {
//        $max = TelegramOffset::find()
//            ->select('id')
//            ->max('id');
//        if ($max > 0) {
//            $this->offset = $max;
//        }
//        return $this->offset;
//    }
//
//    public function updateOffset(Update $update)
//    {
//        $model = new TelegramOffset([
//            'id' => $update->getUpdateId(),
//            'timestamp_offset' => date("Y:m:d H:i:s")
//        ]);
//        $model->save();
//    }
//
//
//    public function processCommand(Message $message)
//    {
//        $params = explode(" ", $message->getText());
//        $command = $params[0];
//        $response = 'Неизвестная команда';
//        switch ($command) {
//            case '/help':
//                $response = "Доступные команды \n";
//                $response .= "/help - список команд \n";
//                $response .= "/projecy_create ##project_name## - создание проекта \n";
//                $response .= "/task_create ##responcible## ##project## - создание таска \n";
//                $response .= "/sp_create - подписка на создание проекта \n";
//                $response .= "/sp_delete - удаление подписки на создание проекта \n";
//                break;
//            case '/sp_create':
//                $response .= "Вы подписаны на оповещение о создании проектов";
//                TelegramSp::getAddSp();
//                break;
//            case '/sp_delete':
//                $response .= "Подписка удалена на оповещение о создании проектов";
//                TelegramSp::getDelSp();
//                break;
//        }
//
//        $this->bot->sendMessage($message->getFrom()->getId(), $response);
//    }

}
