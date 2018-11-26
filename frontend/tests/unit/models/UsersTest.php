<?php

namespace frontend\tests\unit\models;

use common\models\LoginForm;
use common\models\tables\Tasks;
use common\models\tables\Users;
use Yii;
use frontend\models\ContactForm;

class UsersTest extends \Codeception\Test\Unit
{

//    public function testAddUser()
//    {
//        $user = new Users([
//            'username' => 'test',
//            'password_hash' => 'password',
//            'email' => 'test@test.ru'
//        ]);
//
//        $this->assertTrue($user->save(), 'Что-то пошло не так');
//    }

    public function testValidateWrong()
    {
//        $user = new Users();
//        $user->username = 'test';
//        $user->password_hash = 'useruser';
//        $user->email = 'test@test.ru';
//        $user = new Users([
//            'username' => 'test2',
//            'email' => 'wwww'
//        ]);

        $user = new Users([
            'username' => 'test',
//            'password_hash' => 'password',
            'email' => 'test@test.ru'
        ]);


        $this->assertFalse($user->validate(), 'Validate incorrect username and email');
//        $this->assertArrayHasKey('username', $user->getErrors(), 'check incorrect username error ');
        $this->assertArrayHasKey('email', $user->getErrors(), 'check incorrect email error ');

//        $this->assertFalse($user->validate(), 'Validate empty username');
//        $this->assertArrayHasKey('username', $user->getErrors(), 'check empty username error ');
//        $this->assertArrayHasKey('email', $user->getErrors(), 'check empty email error ');

    }
}
