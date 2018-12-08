<?php

namespace common\models\tables;

use Yii;

/**
 * This is the model class for table "telegram_offset".
 *
 * @property int $id
 * @property string $timestamp_offset
 */
class TelegramOffset extends \yii\db\ActiveRecord
{
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

//    public static function getNEwMessage($bot)
//    {
//
//        $updates = $this->bot->getUpdates($this->getOffset() + 1);
//        $updCount = count($updates);
//        if ($updCount > 0) {
//            echo "Новых сообщений: " . $updCount . PHP_EOL;
//            foreach ($updates as $update) {
//                $this->updateOffset($update);
//                if ($message = $update->getMessage()) {
//                    $this->processCommand($message);
//                }
//
//            }
//        } else {
//            echo "Новых сообщений нет" . PHP_EOL;
//        }
//    }
}
