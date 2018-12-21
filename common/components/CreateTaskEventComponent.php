<?php
/**
 * Created by PhpStorm.
 * User: gnom
 * Date: 21.12.2018
 * Time: 15:05
 */

namespace common\components;


use common\models\tables\Tasks;
use common\models\tables\TelegramSt;
use yii\base\Component;
use yii\base\Event;

class CreateTaskEventComponent extends Component
{
    public function init()
    {
        parent::init();
        Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, function (Event $event){
            $model = $event->sender;
            TelegramSt::getSendSt();
//            echo 'test';
        });
    }

}