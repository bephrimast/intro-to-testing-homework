<?php

namespace tests;

use PHPUnit\Framework\TestCase;

class calculatorTest extends TestCase{

    private $calculcator;

    public function SetUp(){
        $this->calculator = new \Calculator();
    }

    public function testItCanBeConstructed(){
        self::assertInstanceOf(\Calculator::class, $this->calculator);
    }

    /**
     * @dataProvider provideAddInput
     */
    public function testAddWorks($a, $b, $expected){

        self::assertEquals($expected, $this->calculator->Add($a, $b));
    }
    
    /**
     * @dataProvider provideSubtractInput
     */
    public function testSubstractWorks($a, $b, $expected){
        
        self::assertEquals($expected, $this->calculator->Substract($a,$b));
    }

    /**
     * @dataProvider provideMultiplierInput
     */

    public function testMultiplyWorks($a, $b, $expected){
        // Arrange
        
        // Act
        $result = $this->calculator->Multiply($a,$b);
        
        // Assert
        self::assertEquals($expected, $this->calculator->Multiply($a,$b));

    }

    public function test100PercentsWillDoubleTheInput(){

        $result = $this->calculator->calculateWithPercentage(10, 100);
        self::assertEquals(20, $result);
    }

    public function test25PercentsWillRoundUp(){

        $result = $this->calculator->calculateWithPercentage(10001, 25);
        self::assertEquals(12502, $result);
    }

    public function test25PercentsWillRoundUpFloat(){

        $result = $this->calculator->calculateWithPercentage(10001, 25);
        self::assertEquals(12502, $result);

    }

    /**
     * @dataProvider providePercentageInput
     */
    public function testReturnsFloats($a, $b, $expected){

        $result = $this->calculator->calculateWithPercentage($a, $b);
        self::assertTrue(is_float($result));
        self::assertEquals($expected, $result);

    }

    public function providePercentageInput(){
        return[
            [100, 25, 125.0],
            [100, 8, 108.00],
            [100.01, 8, 108.02]
        ];

    }
    public function provideMultiplierInput(){
        return[
            [1, 2, 2],
            [4, 4, 16],
            [7, 9, 63]
        ];
    }
    public function provideSubtractInput(){
        return[
            [2, 2, 0],
            [10, 5, 5],
            [0, 10, -10]
        ];
    }
    public function provideAddInput(){
        return[
            [1, 2, 3],
            [4, 4, 8],
            [7, 9, 16]
        ];
    }
}