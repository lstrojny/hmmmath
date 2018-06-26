<?php
namespace hmmmath\Percentile;

use hmmmath\Exception\InvalidArgumentException;

final class Percentile
{
    public const NEAREST_RANK = 'nearestRank';
    public const LINEAR_INTERPOLATION = 'linearInterpolation';

    /**
     * Calculate nth percentile of a list of numbers
     *
     * @param float[] $numbers
     */
    public static function percentile(
        array $numbers,
        float $percentile,
        string $mode = self::NEAREST_RANK,
        bool $sort = true
    ): float {
        InvalidArgumentException::assertParameterType('2', 'double', $percentile, '0..1');

        if ($sort) {
            sort($numbers);
        }

        switch ($mode) {
            case static::LINEAR_INTERPOLATION:
                $result = static::linearInterpolation($numbers, $percentile);
                break;

            case static::NEAREST_RANK:
            default:
                $result = static::nearestRank($numbers, $percentile);
                break;
        }

        return $result;
    }

    /** @param float[] $numbers */
    private static function nearestRank(array $numbers, float $percentile): float
    {
        $nearestRank = static::getNearestRank($numbers, $percentile);

        return static::getValue($numbers, $nearestRank, 'end');
    }

    /** @param float[] $numbers */
    private static function linearInterpolation(array $numbers, float $percentile): float
    {
        $nearestRank = static::getNearestRank($numbers, $percentile);

        $count = count($numbers);

        $leftRank = (int) floor($nearestRank);

        $p = 100 / $count * ($leftRank - 0.5);

        $left = static::getValue($numbers, $leftRank, 'reset');
        $right = static::getValue($numbers, $leftRank + 1, 'end');

        return $left + $count * ($percentile * 100 - $p) / 100 * ($right - $left);
    }

    /** @param float[] $numbers */
    private static function getValue(array $numbers, float $key, callable $fallback): float
    {
        $key = (int) round($key) -  1;
        $value = isset($numbers[$key]) ? $numbers[$key] : $fallback($numbers);

        return (float) $value;
    }

    /** @param number[] $numbers */
    private static function getNearestRank(array $numbers, float $percentile): float
    {
        return $percentile * count($numbers) + 1 / 2;
    }
}
