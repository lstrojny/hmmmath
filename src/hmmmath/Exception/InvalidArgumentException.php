<?php
namespace hmmmath\Exception;

use InvalidArgumentException as BaseInvalidArgumentException;

class InvalidArgumentException extends BaseInvalidArgumentException
{
    public static function assertParameterType($parameterPosition, $expectedType, $actualValue, $specialization = null)
    {
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

    private static function validateType($value, $type, $specialization = null)
    {
        if (gettype($value) !== $type) {
            return false;
        }

        if ($specialization === null) {
            return true;
        }

        $validationMethod = 'validate' . $type . $specialization;
        if (is_callable(['static', $validationMethod])) {
            return static::{$validationMethod}($value);
        }
        return false;
    }

    private static function validateIntegerUnsigned($value)
    {
        return $value >= 0;
    }

    private static function getSpecializationOfType($type, $specialization)
    {
        if ($specialization === null) {
            return '';
        }

        return '<' . $specialization . '>';
    }

    private static function getSpecializationOfValue($value, $type)
    {
        if (!is_object($type)) {
            return '';
        }

        return '<' . get_class($value) . '>';
    }
}
