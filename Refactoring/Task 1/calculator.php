<?php

/**
 * Class Calculator
 */
class Calculator
{
    /**
     * Addition of two numbers
     * @param $a
     * @param $b
     * @return float
     */
    public static function plus(float $a, float $b): float
    {
        return $a + $b;
    }

    /**
     * Subtraction of two numbers
     * @param float $a
     * @param float $b
     * @return float
     */
    public static function minus(float $a, float $b): float
    {
        return $a - $b;
    }

    /**
     * Multiplication of two numbers
     * @param float $a
     * @param float $b
     * @return float
     */
    public static function multiply(float $a, float $b): float
    {
        return $a * $b;
    }

    /**
     * Division of two numbers
     * @param float $a
     * @param float $b
     * @return float
     */
    public static function divide(float $a, float $b): float
    {
        return $a / $b;
    }

    /**
     * Square root of the number
     * @param float $a
     * @return float
     */
    public static function squareRoot(float $a): float
    {
        return sqrt($a);
    }
}
