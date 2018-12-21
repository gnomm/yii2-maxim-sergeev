<?php
namespace common\components;


use common\models\tables\Project;
use common\models\tables\TelegramSp;
use yii\base\Component;
use yii\base\Event;

class CreateProjectEventComponent extends Component
{
    public function init()
    {
        parent::init();
        Event::on(Project::class, Project::EVENT_AFTER_INSERT, function(Event $event){
            $model = $event->sender;
//            echo 'test';
           TelegramSp::getSendSp();
        });
    }

}