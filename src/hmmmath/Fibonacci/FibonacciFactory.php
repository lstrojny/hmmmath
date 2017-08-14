<?php
namespace hmmmath\Fibonacci;

use hmmmath\Exception\InvalidArgumentException;
use Traversable;
use LimitIterator;

class FibonacciFactory
{
    /**
     * Create fibonacci sequence
     *
     * The sequence is infinite but the factory method optionally takes a third argument to limit the sequence. A fourth
     * parameter can be passed to specify an offset for the sequence.
     */
    public static function sequence(int $start = 0, int $increment = 1, int $limit = 0, int $offset = 0): Traversable
    {
        $sequence = new FibonacciSequence($start, $increment);

        InvalidArgumentException::assertParameterType(3, 'integer', $limit, 'unsigned');
        InvalidArgumentException::assertParameterType(4, 'integer', $offset, 'unsigned');

        if ($limit > 0) {
            $sequence = new LimitIterator($sequence, $offset, $limit);
        }

        return $sequence;
    }

    /** Create fibonacci number */
    public static function number(int $start = 0, int $increment = 1): FibonacciNumber
    {
        return new FibonacciNumber($start, $increment);
    }

    final private function __construct()
    {
    }

    final private function __destruct()
    {
    }

    final private function __clone()
    {
    }
}
