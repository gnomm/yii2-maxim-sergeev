<?php


namespace console\controllers;


use common\models\tables\TelegramOffset;
use common\models\tables\TelegramSp;
use common\models\tables\TelegramSpOld;
use common\models\tables\TelegramSt;
use SonkoDmitry\Yii\TelegramBot\Component;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;
use yii\console\Controller;

class TelegramController extends Controller
{
    /** @var Component */
    private $bot;
    private $offset = 0;

//    public $bot;
//    public $offset = 0;

    public function init()
    {
        parent::init();
        $this->bot = \Yii::$app->bot;
    }


    public function actionIndex()
    {
        $updates = $this->bot->getUpdates($this->getOffset() + 1);
        $updCount = count($updates);
        if ($updCount > 0) {
            echo "Новых сообщений: " . $updCount . PHP_EOL;
            foreach ($updates as $update) {
                $this->updateOffset($update);
                if ($message = $update->getMessage()) {
                    $this->processCommand($message);
                }

            }
        } else {
            echo "Новых сообщений нет" . PHP_EOL;
        }
//        var_dump(new TelegramOffset());
    }


    private function getOffset()
    {
        $max = TelegramOffset::find()
            ->select('id')
            ->max('id');
        if ($max > 0) {
            $this->offset = $max;
        }
        return $this->offset;
    }

    private function updateOffset(Update $update)
    {
        $model = new TelegramOffset([
            'id' => $update->getUpdateId(),
            'timestamp_offset' => date("Y:m:d H:i:s")
        ]);
        $model->save();
    }


    private function processCommand(Message $message)
    {
        $params = explode(" ", $message->getText());
        $command = $params[0];
        $response = 'Неизвестная команда';
        switch ($command) {
            case '/help':
                $response = "Доступные команды \n";
                $response .= "/help - список команд \n";
                $response .= "/projecy_create ##project_name## - создание проекта \n";
                $response .= "/task_create ##responcible## ##project## - создание таска \n";
                $response .= "/sp_create - подписка на создание проекта \n";
                $response .= "/sp_delete - удаление подписки на создание проекта \n";
                $response .= "/st_create - подписка на новые задачи \n";
                $response .= "/st_delete - удаление подписки на новые задачи \n";
                break;
            case '/sp_create':
                $response = "Вы подписаны на оповещение о создании проектов";
                TelegramSp::getAddSp();
                break;
            case '/sp_delete':
                $response = "Подписка удалена на оповещение о создании проектов";
                TelegramSp::getDelSp();
                break;
            case '/st_create':
                $response = "Вы подписаны на оповещение о создании новых задач";
                TelegramSt::getAddSt();
                break;
            case '/st_delete':
                $response = "Подписка удалена на оповещение о создании новых задач";
                TelegramSt::getDelSt();
                break;
        }

        $this->bot->sendMessage($message->getFrom()->getId(), $response);
    }


}