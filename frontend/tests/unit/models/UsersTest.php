<?php

namespace frontend\tests\unit\models;

use common\models\LoginForm;
use common\models\tables\Tasks;
use common\models\tables\Users;
use common\models\User;
use Yii;
use frontend\models\ContactForm;

class UsersTest extends \Codeception\Test\Unit
{

    public function testAddUser()
    {
        $user = new Users([
            'username' => 'admin2',
            'password_hash' => 'password',
            'email' => 'test@test.ru'
        ]);


//        $user->save();
//        $this->assertTrue($user->save(), 'model ti saves');
        $this->assertTrue($user->save(), 'Что-то пошло не так');


    }

//    public function testValidateWrong()
//    {
//        $user = new Users([
//            'username' => 'test',
//            'password_hash' => 'password',
//            'email' => 'testtest.ru'
//        ]);
//
//
//        $this->assertFalse($user->validate(), 'Validate incorrect username and email');
//        $this->assertArrayHasKey('username', $user->getErrors(), 'check incorrect username error ');
//        $this->assertArrayHasKey('email', $user->getErrors(), 'check incorrect email error ');
//    }
}

