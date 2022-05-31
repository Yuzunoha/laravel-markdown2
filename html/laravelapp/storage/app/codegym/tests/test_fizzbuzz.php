<?php

use PHPUnit\Framework\TestCase;

class test_fizzbuzz extends TestCase
{
    public function test1()
    {
        // require_once()で実行されるechoをテストする
        $expectedString = $this->getExpectedString();
        $this->expectOutputString($expectedString);
        require_once('fizzbuzz.php');
    }

    protected function getExpectedString()
    {
        $s = '';
        for ($i = 1; $i <= 100; $i++) {
            if ($i % 15 === 0) {
                $s .= "3の倍数であり、5の倍数" . PHP_EOL;
            } else if ($i % 3 === 0) {
                $s .= "3の倍数" . PHP_EOL;
            } else if ($i % 5 === 0) {
                $s .= "5の倍数" . PHP_EOL;
            } else {
                $s .= $i . PHP_EOL;
            }
        }
        return $s;
    }
}
