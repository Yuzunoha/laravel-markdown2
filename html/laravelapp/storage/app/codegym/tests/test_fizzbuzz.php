<?php

use PHPUnit\Framework\TestCase;

class test_fizzbuzz extends TestCase
{
    protected function setUp(): void
    {
        require_once('fizzbuzz.php');
    }

    public function test1()
    {
        echo "いい感じ" . PHP_EOL;
        $this->assertEquals(1, 1);
    }
}
