<?php

namespace Tests;

use FrogJump;
use PHPUnit\Framework\TestCase;

class FrogJumpTest extends TestCase
{
    /** @var FrogJump */
    private $frogJump;

    public function setUp()
    {
        $this->frogJump = new FrogJump();
    }

    public function testItCanBeConstructed()
    {
        self::assertInstanceOf(FrogJump::class, $this->frogJump);
    }

    /**
     * @dataProvider provideSolutionInput
     */
    public function testSolutionWorks($a, $b, $c, $expected)
    {
        self::assertEquals($expected, $this->frogJump->solution($a, $b, $c));
    }

    /**
     * @dataProvider provideSolutionInput
     *
     * @return array
     */
    public function provideSolutionInput()
    {
        return [
            [-1, 3, 2, 2],
            [10, 85, 30, 3],
            [10, 11, 1, 1],
            [10, 10, 3, 0],
        ];
    }

    public function testProvidingInvalidStartingAndTargetPositionsThrowsException()
    {
        $this->expectException(\LogicException::class);

        $this->frogJump->solution(10, 3, 4);
    }
}