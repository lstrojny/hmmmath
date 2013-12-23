<?php
namespace hmmmath\Tests\Percentile;

use hmmmath\Percentile\Percentile;
use InterNations\Component\Testing\AbstractTestCase;

class PercentileTest extends AbstractTestCase
{
    public static function getNearestRankData()
    {
        return array(
            array(15.0, 0.0, array(50, 15, 20, 35, 40)),
            array(15.0, 0.01, array(50, 15, 20, 35, 40)),
            array(15.0, 0.1, array(50, 15, 20, 35, 40)),
            array(20.0, 0.2, array(50, 15, 20, 35, 40)),
            array(20.0, 0.3, array(50, 15, 20, 35, 40)),
            array(35.0, 0.4, array(50, 15, 20, 35, 40)),
            array(35.0, 0.5, array(50, 15, 20, 35, 40)),
            array(40.0, 0.6, array(50, 15, 20, 35, 40)),
            array(40.0, 0.7, array(50, 15, 20, 35, 40)),
            array(50.0, 0.8, array(50, 15, 20, 35, 40)),
            array(50.0, 0.9, array(50, 15, 20, 35, 40)),
            array(50.0, 0.99, array(50, 15, 20, 35, 40)),
            array(50.0, 1.0, array(50, 15, 20, 35, 40)),
            array(20.0, 0.5, array(-1, 10, 50, 15, 20, 35, 40)),
        );
    }

    /** @dataProvider getNearestRankData */
    public function testNearestRankDefaultMode($expectation, $percentile, $data)
    {
        $result= Percentile::percentile($data, $percentile);
        $this->assertInternalType('float', $result);
        $this->assertSame($expectation, $result);
    }

    /** @dataProvider getNearestRankData */
    public function testNearestRangeExplicit($expectation, $percentile, $data)
    {
        $result= Percentile::percentile($data, $percentile, Percentile::NEAREST_RANK);
        $this->assertInternalType('float', $result);
        $this->assertSame($expectation, $result);
    }

    public static function getGoogleDocsSample()
    {
        return array(
            array(15.0, 0.0, array(50, 15, 20, 35, 40)),
            array(15.2, 0.01, array(50, 15, 20, 35, 40)),
            array(17.0, 0.1, array(50, 15, 20, 35, 40)),
            array(19.0, 0.2, array(50, 15, 20, 35, 40)),
            array(23.0, 0.3, array(50, 15, 20, 35, 40)),
            array(29.0, 0.4, array(50, 15, 20, 35, 40)),
            array(35.0, 0.5, array(50, 15, 20, 35, 40)),
            array(37.0, 0.6, array(50, 15, 20, 35, 40)),
            array(39.0, 0.7, array(50, 15, 20, 35, 40)),
            array(42.0, 0.8, array(50, 15, 20, 35, 40)),
            array(46.0, 0.9, array(50, 15, 20, 35, 40)),
            array(49.6, 0.99, array(50, 15, 20, 35, 40)),
            array(50.0, 1, array(50, 15, 20, 35, 40)),
        );
    }

    public static function getLinearInterpolationData()
    {
        return array(
            array(15.0, 0.0, array(50, 15, 20, 35, 40)),
            array(15.0, 0.01, array(50, 15, 20, 35, 40)),
            array(15.0, 0.1, array(50, 15, 20, 35, 40)),
            array(17.5, 0.2, array(50, 15, 20, 35, 40)),
            array(20.0, 0.3, array(50, 15, 20, 35, 40)),
            array(27.5, 0.4, array(50, 15, 20, 35, 40)),
            array(35.0, 0.5, array(50, 15, 20, 35, 40)),
            array(37.5, 0.6, array(50, 15, 20, 35, 40)),
            array(40.0, 0.7, array(50, 15, 20, 35, 40)),
            array(45.0, 0.8, array(50, 15, 20, 35, 40)),
            array(50.0, 0.9, array(50, 15, 20, 35, 40)),
            array(50.0, 0.99, array(50, 15, 20, 35, 40)),
            array(50.0, 1.0, array(50, 15, 20, 35, 40)),
        );
    }

    /** @dataProvider getLinearInterpolationData */
    public function testLinearInterpolation($expectation, $percentile, $data)
    {
        $result = Percentile::percentile($data, $percentile, Percentile::LINEAR_INTERPOLATION);
        $this->assertSame($expectation, $result);
        $this->assertInternalType('float', $result);
    }

    public static function getErrorDataSet()
    {
        return array(
            array(-1),
            array(-1.0),
            array(-0.01),
            array(1.01),
            array(100),
            array(100.0),
        );
    }

    /** @dataProvider getErrorDataSet */
    public function testPercentileError($percentile)
    {
        $this->setExpectedException(
            'hmmmath\Exception\InvalidArgumentException',
            'Expected parameter #2 to be of type "double<0..1>"'
        );

        Percentile::percentile(array(), $percentile);
    }
}
