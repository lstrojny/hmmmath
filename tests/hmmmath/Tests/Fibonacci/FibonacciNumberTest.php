<?php
namespace hmmmath\Tests\Fibonacci;

use hmmmath\Fibonacci\FibonacciNumber;
use PHPUnit\Framework\TestCase;

class FibonacciNumberTest extends TestCase
{
    public function testGrowLikeARabbitPopulation_Positive()
    {
        $number = new FibonacciNumber(0, 1);

        $this->assertSame(0, $number->getCurrent());
        $this->assertSame(1, $number->getNext()->getCurrent());
        $this->assertSame(1, $number->getNext()->getNext()->getCurrent());
        $this->assertSame(2, $number->getNext()->getNext()->getNext()->getCurrent());
        $this->assertSame(3, $number->getNext()->getNext()->getNext()->getNext()->getCurrent());
        $this->assertSame(5, $number->getNext()->getNext()->getNext()->getNext()->getNext()->getCurrent());
        $this->assertSame(8, $number->getNext()->getNext()->getNext()->getNext()->getNext()->getNext()->getCurrent());
        $this->assertSame(13, $number->getNext()->getNext()->getNext()->getNext()->getNext()->getNext()->getNext()->getCurrent());
    }

    public function testGrowLikeARabbitPopulation_Negative()
    {
        $number = new FibonacciNumber(0, -1);

        $this->assertSame(0, $number->getCurrent());
        $this->assertSame(-1, $number->getNext()->getCurrent());
        $this->assertSame(-1, $number->getNext()->getNext()->getCurrent());
        $this->assertSame(-2, $number->getNext()->getNext()->getNext()->getCurrent());
        $this->assertSame(-3, $number->getNext()->getNext()->getNext()->getNext()->getCurrent());
        $this->assertSame(-5, $number->getNext()->getNext()->getNext()->getNext()->getNext()->getCurrent());
        $this->assertSame(-8, $number->getNext()->getNext()->getNext()->getNext()->getNext()->getNext()->getCurrent());
        $this->assertSame(-13, $number->getNext()->getNext()->getNext()->getNext()->getNext()->getNext()->getNext()->getCurrent());
    }

    public function testDifferentInitialNumber()
    {
        $number = new FibonacciNumber(10, 20);
        $this->assertSame(10, $number->getCurrent());
        $this->assertSame(30, $number->getNext()->getCurrent());
        $this->assertSame(40, $number->getNext()->getNext()->getCurrent());
        $this->assertSame(70, $number->getNext()->getNext()->getNext()->getCurrent());
        $this->assertSame(110, $number->getNext()->getNext()->getNext()->getNext()->getCurrent());
    }
}
