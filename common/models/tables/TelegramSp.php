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

    public static function getTelegramIdUser()
    {
        /** @var Component $bot */
        $bot = Yii::$app->bot;
        $updates = $bot->getUpdates();

        foreach ($updates as $update) {
            $id = $update->getMessage()->getFrom()->getId();
        }
        return $id;
    }

    public function getAddSp()
    {
        $id = TelegramSp::getTelegramIdUser();

        $addSp = new TelegramSp([
            'telegram_id' => $id,
            'timestamp_offset' => date("Y:m:d H:i:s")
        ]);
        $addSp->save();
    }

    public function getDelSp()
    {
        $id = TelegramSp::getTelegramIdUser();

        $delSp = TelegramSp::find()
            ->where(['telegram_id' => $id])
            ->one();
        $delSp->delete();
    }

    public static function getSendSp()
    {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;
        $users = TelegramSp::find()
            ->where('telegram_id')
            ->all();

        $newProject = Project::find()
//            ->where('id')
            ->orderBy(['id' => SORT_DESC])
            ->limit(1)
            ->one();


        $projectId = $newProject['id'];
        $link = "http://front.task.local/project/view?id={$projectId}";
//        var_dump($link);
//        $bot->sendMessage(466488726, "Создан новый проект {$link}");

        foreach ($users as $user) {
            $usersSend = $user['telegram_id'];
            $bot->sendMessage($usersSend, "Создан новый проект {$link}");
        }
    }
}
