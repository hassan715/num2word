<?php

namespace num2word\NumberTransformer;


abstract class NumberTransformerTest extends \PHPUnit_Framework_TestCase
{
    protected $numberTransformer;

    /**
     * @dataProvider providerTestNumberToWord
     *
     * @param string $number
     * @param string $expectedResult
     */
    public function testNumberToWord($number, $expectedResult)
    {
        if ($this->numberTransformer === null) {
            self::markTestIncomplete('Please initialize $numberTransformer property.');
        }

        self::assertEquals($expectedResult, $this->numberTransformer->toWords($number, false, false));
    }

    abstract public function providerTestNumberToWord();
}
