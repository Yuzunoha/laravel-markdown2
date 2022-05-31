<?php
class Calculator
{

    public function sum($n1, $n2)
    {
        return $n1 + $n2;
    }

    public function subtract($n1, $n2)
    {
        return $n1 - $n2;
    }

    public function divide($n1, $n2)
    {
        if ($n2 == 0)
            throw new InvalidArgumentException('Division by zero.');
        return $n1 / $n2;
    }

    public function multiply($n1, $n2)
    {
        echo $n1 * $n2;
    }
}
