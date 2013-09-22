<?php
namespace hmmmath\Percentile;

use hmmmath\Exception\InvalidArgumentException;

final class Percentile
{
    const NEAREST_RANK = 'nearestRank';

    const LINEAR_INTERPOLATION = 'linearInterpolation';

    /**
     * Calculate nth percentile of a list of numbers
     *
     * @param number[] $numbers
     * @param double $percentile
     * @param string $mode
     * @param boolean $sort
     * @return double
     */
    public static function percentile(array $numbers, $percentile, $mode = self::NEAREST_RANK, $sort = true)
    {
        InvalidArgumentException::assertParameterType('2', 'double', $percentile, '0..1');

        if ($sort) {
            sort($numbers);
        }

        switch ($mode) {
            case static::NEAREST_RANK:
                return static::nearestRank($numbers, $percentile);

            case static::LINEAR_INTERPOLATION:
                return static::linearInterpolation($numbers, $percentile);
        }
    }

    /**
     * @param number[] $numbers
     * @param double $percentile
     * @return double
     */
    private static function nearestRank(array $numbers, $percentile)
    {
        $nearestRank = static::getNearestRank($numbers, $percentile);

        return static::getValue($numbers, $nearestRank, 'end');
    }

    /**
     * @param number[] $numbers
     * @param double $percentile
     * @return double
     */
    private static function linearInterpolation(array $numbers, $percentile)
    {
        $nearestRank = static::getNearestRank($numbers, $percentile);

        $count = count($numbers);

        $leftRank = (int) floor($nearestRank);

        $p1 = 100 / $count * ($leftRank - 0.5);

        $left = static::getValue($numbers, $leftRank, 'reset');
        $right = static::getValue($numbers, $leftRank + 1, 'end');

        return $left + $count * ($percentile * 100 - $p1) / 100 * ($right - $left);
    }

    /**
     * @param number[] $numbers
     * @param double $key
     * @param callable $fallback
     * @return double
     */
    private static function getValue(array $numbers, $key, callable $fallback)
    {
        $key = (integer) round($key) -  1;
        $value = isset($numbers[$key]) ? $numbers[$key] : $fallback($numbers);

        return (double) $value;
    }

    /**
     * @param number[] $numbers
     * @param double $percentile
     * @return double
     */
    private static function getNearestRank(array $numbers, $percentile)
    {
        return $percentile * count($numbers) + 1 / 2;
    }
}
