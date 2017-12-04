<?php

namespace Tests;

use Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /** @var Calculator */
    private $calculator;

    public function setUp()
    {
        $this->calculator = new Calculator();
    }

    public function testItCanBeConstructed()
    {
        self::assertInstanceOf(Calculator::class, $this->calculator);
    }

    /**
     * @dataProvider provideAdderInput
     */
    public function testAddWorks($a, $b, $expected)
    {
        self::assertEquals($expected, $this->calculator->add($a, $b));
    }

    /**
     * @dataProvider provideAdderInput
     *
     * @return array
     */
    public function provideAdderInput()
    {
        return [
            [5, 2, 7],
            [4, 4, 8],
            [6, 9, 15],
        ];
    }

    /**
     * @dataProvider provideSubtracterInput
     */
    public function testSubtractWorks($a, $b, $expected)
    {
        self::assertEquals($expected, $this->calculator->subtract($a, $b));
    }

    /**
     * @dataProvider provideSubtracterInput
     *
     * @return array
     */
    public function provideSubtracterInput()
    {
        return [
            [1, 2, -1],
            [4, 4, 0],
            [6, 9, -3],
        ];
    }

    /**
     * @dataProvider provideMultiplierInput
     */
    public function testMultiplyWorks($a, $b, $expected)
    {
        // Act
        $result = $this->calculator->multiply($a, $b);

        // Assert
        self::assertEquals($expected, $result);
    }

    /**
     * @dataProvider provideMultiplierInput
     *
     * @return array
     */
    public function provideMultiplierInput()
    {
        return [
            [1, 2, 2],
            [4, 4, 16],
            [6, 9, 54],
        ];
    }

    /**
     * @dataProvider provideDividerInput
     */
    public function testDivideWorks($a, $b, $expected)
    {
        // Act
        $result = $this->calculator->divide($a,$b);

        // Assert
        self::assertEquals($expected, $result);
    }


    /**
     * @dataProvider provideDividerInput
     *
     * @return array
     */
    public function provideDividerInput()
    {
        return [
            [1, 2, 0.5],
            [4, 4, 1],
            [6, 3, 2],
        ];
    }

    public function test100PercentWillDoubleTheInput()
    {
        $result = $this->calculator->calculateWithPercentage(10, 100);

        self::assertEquals(20, $result);
    }

    public function test25PercentWillWork()
    {
        $result = $this->calculator->calculateWithPercentage(100, 25);

        self::assertEquals(125, $result);
    }

    public function test25PercentWillRoundUp()
    {
        $result = $this->calculator->calculateWithPercentage(10001, 25);

        self::assertEquals(12502, $result);
    }
}