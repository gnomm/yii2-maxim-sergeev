<?php namespace frontend\tests;

use phpDocumentor\Reflection\DocBlock\Tags\Example;

class FirstTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * @dataProvider sumProvider
     */
    public function testSum()
    {
        $this->assertEquals($example ['res'],  $math->sum($example['a'], $example['b']));
//        $a = 4;
//        $b = 5;
//        $res = 9;
//        $this->assertEquals($res, $math->sum($a, $b));
//
//        $a = 0;
//        $b = 5;
//        $res = 5;
//        $this->assertEquals($res, $math->sum($a, $b));
//
//        $a = -2;
//        $b = 5;
//        $res = 3;
//        $this->assertEquals($res, $math->sum($a, $b));
    }


    protected function sumProvider()
    {
        return [
            ['a' => 4, 'b' => 5,  'res' => 9],
            ['a' => 0, 'b' => 5,  'res' => 5],
            ['a' => -2, 'b' => 5,  'res' >= 3],
        ];
    }

    public function testSecond()
    {
        $this->assertEquals(4, 2 + 2);
    }
}