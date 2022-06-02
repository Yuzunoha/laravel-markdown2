<?php

use PHPUnit\Framework\TestCase;

class test_fukuri extends TestCase
{
    public function test1()
    {
        // require_once()で実行されるechoをテストする
        $expectedString = $this->getExpectedString();
        $this->expectOutputString($expectedString);
        require_once('fukuri.php');
    }

    protected function getExpectedString(): string
    {
        $principal = 400000; //元金
        $rate = 0.5; //金利
        $length = 40; //年数

        $amount = $principal;
        $coefficient = 1.0 + ($rate / 100);
        $s = '';
        for ($i = 0; $i <= $length; $i++) {
            $s .= ($i . '年目：' . $amount . '円') . PHP_EOL;
            $amount *= $coefficient;
        }
        return $s;
    }
}
