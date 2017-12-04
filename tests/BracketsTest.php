<?php

namespace Tests;

use Brackets;
use PHPUnit\Framework\TestCase;

class BracketsTest extends TestCase
{
    /** @var Brackets */
    private $brackets;

    public function setUp()
    {
        $this->brackets = new Brackets();
    }

    public function testItCanBeConstructed()
    {
        self::assertInstanceOf(Brackets::class, $this->brackets);
    }

    /**
     * @dataProvider provideSolutionInput
     */
    public function testSolutionWorks($a, $expected)
    {
        self::assertEquals($expected, $this->brackets->solution($a));
    }

    /**
     * @dataProvider provideSolutionInput
     *
     * @return array
     */
    public function provideSolutionInput()
    {
        return [
            ['{[()()]}', 1],
            ['([)()]', 0],
            [' ', 1],
            ['', 1],
        ];
    }
}