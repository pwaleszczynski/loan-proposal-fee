<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Strategy;

use PragmaGoTech\Interview\Model\LinearInterpolationMatrix;

class FeeCalculatorLinearInterpolationStrategyFactory
{
    private function __construct()
    {
    }

    public static function create(): FeeCalculatorLinearInterpolationStrategy
    {
        return new FeeCalculatorLinearInterpolationStrategy(
            self::getMatrix(),
        );
    }

    public static function getMatrix(): LinearInterpolationMatrix
    {   $confPath = dirname(dirname(__DIR__)).'/conf/linear_interpolation_matrix.php';
        $matrixConf = include($confPath);

        return LinearInterpolationMatrix::createFrom($matrixConf);
    }
}
