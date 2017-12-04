<?php

namespace tests;

use PHPUnit\Framework\TestCase;

class frogJumpTests extends TestCase{

    private $frog;

    public function SetUp(){
        $this->frog = new \FrogJump();
    }

    public function testItCanBeConstructed(){
        self::assertInstanceOf(\FrogJump::class, $this->frog);
    }

    /**
     * @dataProvider provideSolutionInputs
     */
    public function testSolution($x, $y, $d, $expected){

        $result = $this->frog->solution($x, $y, $d);
        self::assertEquals($expected, $result);
    }

    public function provideSolutionInputs(){
        return [
            [0, 50, 10, 5],
            [50, 50, 25, 0],
            [0, 10, 3, 4],
            [10, 85, 30, 3]
        ];
    }

    
}