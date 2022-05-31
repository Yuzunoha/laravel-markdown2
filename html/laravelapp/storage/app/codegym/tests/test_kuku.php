<?php

use PHPUnit\Framework\TestCase;

class test_kuku extends TestCase
{
    public function test1()
    {
        // require_once()で実行されるechoをテストする
        $expectedString = $this->getExpectedString();
        $this->expectOutputString($expectedString);
        require_once('kuku.php');
    }

    protected function getExpectedString(): string
    {
        $s = '';
        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 9; $j++) {
                $s .= $i * $j;
                if ($j !== 9) {
                    $s .= ' ';
                }
            }
            $s .= PHP_EOL;
        }
        return $s;
    }
}
