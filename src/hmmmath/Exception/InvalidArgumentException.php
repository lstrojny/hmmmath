<?php
namespace hmmmath\Exception;

use InvalidArgumentException as BaseInvalidArgumentException;

class InvalidArgumentException extends BaseInvalidArgumentException
{
    /**
     * @param mixed $actualValue
     * @return mixed
     */
    public static function assertParameterType(
        int $parameterPosition,
        string $expectedType,
        $actualValue,
        ?string $specialization = null
    ) {
        if (static::validateType($actualValue, $expectedType, $specialization)) {
            return $actualValue;
        }

        throw new static(
            sprintf(
                'Expected parameter #%d to be of type "%s%s", "%s%s" given',
                $parameterPosition,
                $expectedType,
                static::getSpecializationOfType($expectedType, $specialization),
                gettype($actualValue),
                static::getSpecializationOfValue($actualValue, gettype($actualValue))
            )
        );
    }

    /** @param mixed $value */
    private static function validateType($value, string $type, ?string $specialization = null): bool
    {
        if (gettype($value) !== $type) {
            return false;
        }

        if ($specialization === null) {
            return true;
        }

        $validationMethod = 'validate' . $type . strtr($specialization, ['.' => '']);

        if (!is_callable([static::class, $validationMethod])) {
            return false;
        }

        return static::{$validationMethod}($value);
    }

    private static function validateIntegerUnsigned(int $value): bool
    {
        return $value >= 0;
    }

    private static function validateDouble01(float $value): bool
    {
        return $value >= 0 && $value <= 1;
    }

    private static function getSpecializationOfType(string $type, ?string $specialization): string
    {
        if ($specialization === null) {
            return '';
        }

        return '<' . $specialization . '>';
    }

    /** @param object $value */
    private static function getSpecializationOfValue($value, string $type): string
    {
        if ($type !== 'object') {
            return '';
        }

        return '<' . get_class($value) . '>';
    }
}
