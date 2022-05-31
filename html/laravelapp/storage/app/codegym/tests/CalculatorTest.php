<?php

use PHPUnit\Framework\TestCase;

require_once('./Calculator.php');

class CalculatorTest extends TestCase
{
    public function testIsSumCorrect()
    {
        $calc = new Calculator();
        $result = $calc->sum(1, 2.5);
        $expected = 3.5;
        $this->assertSame($expected, $result);
    }

    /**
     * @dataProvider subtractionProvider
     */
    public function testIsSubtractionCorrect($n1, $n2, $expected)
    {
        $calc = new Calculator();
        $result = $calc->subtract($n1, $n2);
        $this->assertSame($expected, $result);
    }


    /**
     *      @expectedException InvalidArgumentException
     */
    public function testDivisionByZeroThrowsException()
    {
        $calc = new Calculator();
        try {
            $result = $calc->divide(1, 0);
        } catch (InvalidArgumentException $e) {
            $this->assertTrue($e instanceof InvalidArgumentException);
        }
    }

    public function testMultiplyPrintsOutput()
    {
        $expected = '50';
        $this->expectOutputString($expected);
        $calc = new Calculator();
        $calc->multiply(5, 10);
    }


    public function subtractionProvider()
    {
        return [
            "data1" => [1, 1, 0],
            "data2" => [-1, 1, -2],
            "data3" => [5, 1, 4],
            "data4" => [1, 0.25, 0.75]
        ];
    }
}
