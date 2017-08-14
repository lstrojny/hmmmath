<?php
namespace hmmmath\Fibonacci;

class FibonacciNumber
{
    private $start;
    private $increment;

    public function __construct(int $start, int $increment)
    {
        $this->start = $start;
        $this->increment = $increment;
    }

    /** Get current number in fibonacci sequence */
    public function getCurrent(): int
    {
        return $this->start;
    }

    /** Get next in fibonacci sequence */
    public function getNext(): self
    {
        return new self($this->start + $this->increment, $this->start);
    }
}
