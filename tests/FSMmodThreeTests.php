<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../modthree.php';

class FSMmodThreeTests extends TestCase
{
    public function modThree(String $input): int
    {
        return modThree($input);
    }

    public function testModThree(): void
    {
        $this->assertEquals(1, $this->modThree('1101')); // Testing 13 mod 3 = 1
        $this->assertEquals(2, $this->modThree('1110')); // Testing 14 mod 3 = 2
        $this->assertEquals(0, $this->modThree('1111')); // Testing 15 mod 3 = 0
    }

    public function testEmptyInput(): void
    {
        $this->assertEquals(0, $this->modThree('')); // Expecting state S0, which is 0
    }

    public function testSingleSymbol(): void
    {
        $this->assertEquals(0, $this->modThree('0')); // Expecting state S0 (0)
        $this->assertEquals(1, $this->modThree('1')); // Expecting state S1 (1)
    }

    public function test0123(): void
    {
        $this->assertEquals(0, $this->modThree('000')); // Expecting state S0 (0)
        $this->assertEquals(1, $this->modThree('001')); // Expecting state S1 (1)
        $this->assertEquals(2, $this->modThree('010')); // Expecting state S2 (2)
        $this->assertEquals(0, $this->modThree('011')); // Expecting state S0 (0)
    }
    public function testAllZeros(): void
    {
        $this->assertEquals(0, $this->modThree('00000000000000000')); // Expecting state S0 (0)
    }

    public function test00000000X(): void
    {
        $this->assertEquals(0, $this->modThree('00000000')); // Expecting state S0 (0)
        $this->assertEquals(1, $this->modThree('00000001')); // Expecting state S1 (1)
        $this->assertEquals(2, $this->modThree('00000010')); // Expecting state S2 (2)
        $this->assertEquals(0, $this->modThree('00000011')); // Expecting state S0 (0)
    }

    public function testABigOne(): void
    {
        $input = str_repeat('1001101001000110100000001', 10000); // Long string for the test
        $this->assertEquals(0, $this->modThree($input)); // Expecting state S2 (2)
    }

    public function testInvalidSymbolInput(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->modThree('1111202'); // Expecting an error because 2 is not part of the alphabet
    }
}
