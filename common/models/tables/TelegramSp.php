<?php

namespace common\models\tables;

use SonkoDmitry\Yii\TelegramBot\Component;
use Yii;

/**
 * This is the model class for table "telegram_sp".
 *
 * @property int $id
 * @property int $telegram_id
 * @property string $timestamp_offset
 */
class TelegramSp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telegram_sp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telegram_id'], 'integer'],
            [['timestamp_offset'], 'safe'],
            [['telegram_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'telegram_id' => 'Telegram ID',
            'timestamp_offset' => 'Timestamp Offset',
        ];
    }

    public function getAddSp()
    {
        /** @var Component $bot */
        $bot = Yii::$app->bot;
        $updates = $bot->getUpdates();

        foreach ($updates as $update) {
            $id = $update->getMessage()->getFrom()->getId();
        }

        $addSp = new TelegramSp([
            'telegram_id' => $id,
            'timestamp_offset' => date("Y:m:d H:i:s")
        ]);
        $addSp->save();
    }

    public function getDelSp()
    {
        /** @var Component $bot */
        $bot = Yii::$app->bot;
        $updates = $bot->getUpdates();

        foreach ($updates as $update) {
            $id = $update->getMessage()->getFrom()->getId();
        }

        $delSp = TelegramSp::find()
            ->where(['telegram_id' => $id])
            ->one();
        $delSp->delete();


    }
}
