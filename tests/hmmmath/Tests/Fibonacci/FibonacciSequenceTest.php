<?php
namespace hmmmath\Tests\Fibonacci;

use hmmmath\Fibonacci\FibonacciSequence;
use InterNations\Component\Testing\AbstractTestCase;
use LimitIterator;

class FibonacciSequenceTest extends AbstractTestCase
{
    public function testClassicSequence()
    {
        $sequence = new FibonacciSequence();

        $this->assertSame(
            [0, 1, 1, 2, 3, 5, 8, 13, 21, 34],
            iterator_to_array(new LimitIterator($sequence, 0, 10)),
            'Simple sequence'
        );
        $this->assertSame(
            [0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233, 377],
            iterator_to_array(new LimitIterator($sequence, 0, 15)),
            'Retry to test rewind()'
        );
    }

    public function testClassicalSequence_2()
    {
        $sequence = new FibonacciSequence(0, 1);

        $this->assertSame(
            [0, 1, 1, 2, 3, 5, 8, 13, 21, 34],
            iterator_to_array(new LimitIterator($sequence, 0, 10)),
            'Simple sequence'
        );
        $this->assertSame(
            [0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233, 377],
            iterator_to_array(new LimitIterator($sequence, 0, 15)),
            'Retry to test rewind()'
        );
    }

    public function testVaryIncrement()
    {
        $sequence = new FibonacciSequence(0, 2);

        $this->assertSame(
            [0, 2, 2, 4, 6, 10, 16, 26, 42, 68],
            iterator_to_array(new LimitIterator($sequence, 0, 10)),
            'Simple sequence'
        );
        $this->assertSame(
            [0, 2, 2, 4, 6, 10, 16, 26, 42, 68],
            iterator_to_array(new LimitIterator($sequence, 0, 10)),
            'Retry to test rewind()'
        );
    }
}
