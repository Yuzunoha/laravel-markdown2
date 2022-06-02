<?php

use PHPUnit\Framework\TestCase;

class test_shiharai extends TestCase
{
    public function test1()
    {
        // require_once()で実行されるechoをテストする
        $expectedString = $this->getExpectedString();
        $this->expectOutputString($expectedString);
        require_once('shiharai.php');
    }

    protected function getExpectedString(): string
    {
        $amount = 988;
        $coins = [
            500 => 0,
            100 => 0,
            50 => 0,
            10 => 0,
            5 => 0,
            1 => 0,
        ];

        $coinValues = array_keys($coins);

        $i = 0;
        while (0 < $amount) {
            $coinValue = $coinValues[$i];
            while ($coinValue <= $amount) {
                $amount -= $coinValue;
                $coins[$coinValue]++;
            }
            $i++;
        }

        /*
        500円玉：1枚
        100円玉：4枚
        50円玉：1枚
        10円玉：3枚
        5円玉：1枚
        1円玉：3枚
        */
        $s = '';
        foreach ($coins as $k => $v) {
            $s .= $k . '円玉：' . $v . '枚' . PHP_EOL;
        }
        return $s;
    }
}
