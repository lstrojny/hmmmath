<?php
namespace hmmmath\Exception;

use InvalidArgumentException as BaseBadMethodCallException;

class BadMethodCallException extends BaseBadMethodCallException
{
    public static function invalidMethod(string $className, string $methodName): self
    {
        return new static(sprintf('Bad method call to %s::%s()', $className, $methodName));
    }
}
