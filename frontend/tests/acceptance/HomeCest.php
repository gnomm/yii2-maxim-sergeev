<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
                $I->click('Login');
//                $I->see('My Application');

        $I->wait(5); // wait for page to be opened

//                $I->seeLink('View');
//        $I->click('View');
//        $I->wait(5); // wait for page to be opened
//        $I->see('This is the About page.');



//
//        $I->seeLink('About');
//        $I->click('About');
//        $I->wait(2); // wait for page to be opened
//        $I->see('This is the About page.');
//
//        $I->seeLink('Contact');
//        $I->click('Contact');
//        $I->wait(2); // wait for page to be opened
//
//        $I->seeLink('Signup');
//        $I->click('Signup');
//        $I->wait(2); // wait for page to be opened
//
//        $I->seeLink('Login');
//        $I->click('Login');
//        $I->wait(2); // wait for page to be opened



    }
}
