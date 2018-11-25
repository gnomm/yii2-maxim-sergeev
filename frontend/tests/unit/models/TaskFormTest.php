<?php
namespace frontend\tests\unit\models;

use common\models\tables\Tasks;
use Yii;
use frontend\models\ContactForm;

class TaskFormTest extends \Codeception\Test\Unit
{
    public function testTasks()
    {
        $model = new Tasks();

        $model->attributes = [
            'name' => 'TAskTest',
            'description' => 'testDescription',
            'date' => '2018-11-30',
            'user_id' => '1',
        ];


//        expect_that($model->sendEmail('admin@example.com'));

//        // using Yii2 module actions to check email was sent
//        $this->tester->seeEmailIsSent();
//
//        $emailMessage = $this->tester->grabLastSentEmail();
//        expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
//        expect($emailMessage->getTo())->hasKey('admin@example.com');
//        expect($emailMessage->getFrom())->hasKey('tester@example.com');
//        expect($emailMessage->getSubject())->equals('very important letter subject');
//        expect($emailMessage->toString())->contains('body of current message');
    }
}
