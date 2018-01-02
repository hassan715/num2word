<?php

namespace num2word\Processors;

class DefaultProcessor
{
    private $decimalValue = null;
    private $integerValue = null;
    private $negative = false;
    private $decimalDigits;
    private $integerDigits;

    public function getFractional()
    {
        return $this->decimalValue;
    }

    public function getInteger()
    {
        return $this->integerValue;
    }

    public function getFractionalDigits()
    {
        return $this->decimalDigits;
    }

    public function getIntegerDigits()
    {
        return $this->integerDigits;
    }

    public function isNegative()
    {
        return $this->negative;
    }

    /**
     * Returns an array of digits after processing.
     *
     * @param string $value
     *
     */
    public function processString($value)
    {
        // checks if current value is negative
        if (strpos($value, '-') === 0) {
            $this->negative = true;
            // set $value without negative sign
            $value = substr($value, 1);
        }
        $this->integerValue = $value;

        // checks if current value has decimal point
        $decimals = strpos($value, '.');
        // holds the fractional part of the $value
        if ($decimals !== false) {
            // retrieve the fractional part
            $this->decimalValue = substr($value, $decimals + 1);
            // retrieve the integer part
            $this->integerValue = substr($value, 0, $decimals);
        }

        if (!($this->decimalValue == null && $this->decimalValue == "")) {
            $zeroDecimalValue = "";
            for ($i = 0; $i < strlen($this->decimalValue); $i++) {
                $zeroDecimalValue .= "0";
            }
        }

        $this->integerDigits = $this->processValues($this->integerValue);
        $this->decimalDigits = $this->processValues($this->decimalValue);
    }

    /**
     * Process the given value string and returns an array of digits
     * with corresponding exponents.
     *
     * @param string $value
     *
     * @return array
     */
    private function processValues($value)
    {
        // holds all digits with corresponding exponent
        $values = array();
        // holds the right and left parts of the value
        $high = $low = '';

        while ($value >= 1) {
            // get the highest exponent of the value
            $exponent = $this->getExponent($value);
            if (strlen($value) < $exponent) {
                $high = "";
                $low = $value;
            } else {
                $index = strlen($value) - $exponent;
                $high = ltrim(substr($value, 0, $index), '0');
                $low = substr($value, $index);
            }

            if ($high != "") {
                $high = $this->processHundreds($high);
                $digits = array('digits' => $high, 'exponent' => $exponent);
                // push the digits into the array with corresponding exponent
                array_push($values, $digits);
            }

            $value = $low;
            //$value = $low % 1000;
        }

        //print("<pre>".print_r($values,true)."</pre>");
        return $values;
    }

    /**
     * Returns the exponent of a given number thousand, millions, etc..
     *
     * @param string $value
     *
     * @return int
     */
    private function getExponent($value)
    {
        $exponent = 0;
        while (strlen($value) > 3) {
            $value = substr($value, 3, strlen($value));
            $exponent++;
        }

        return $exponent * 3;
    }

    /**
     * Returns the hundreds part.
     *
     * @param string $value
     *
     * @return array
     */
    private function processHundreds($value)
    {
        $exponent = 2;
        $number = 0;
        $digits = $hundreds = array();

        if (strlen($value) > 4) {
            $number = substr($value, strlen($value) - 4);
        } else {
            $number = $value;
        }

        if ($number >= 100) {
            $hundreds['d'] = (int)($number / 100);
            $hundreds['e'] = $exponent;
            $digits[] = $hundreds;
        }

        $tens = $this->processTens($value % 100);
        for ($i = 0; $i < count($tens); $i++) {
            array_push($digits, $tens[$i]);
        }

        return $digits;
    }

    /**
     * Returns the tens and ones parts.
     *
     * @param string $value
     *
     * @return array
     */
    private function processTens($value)
    {
        $exponent = 1;
        $number = 0;
        $digits = array();

        if (strlen($value) > 3) {
            $number = substr($value, strlen($value) - 3);
        } else {
            $number = $value;
        }

        if ($number >= 20) {
            array_push($digits, ['d' => (int)($number / 10), 'e' => $exponent]);
            $number %= 10;
        }

        if ($number != 0) {
            array_push($digits, ['d' => $number, 'e' => 0]);
        }

        return $digits;
    }

    /**
     * Returns each digit of a given number.
     *
     * @param string $value
     *
     * @return array
     */
    private function getDigits($value)
    {
        $digits = array();

        while (strlen($value) >= 1) {
            $digits[] = substr($value, 0, 1);
            $value = substr($value, 1, strlen($value));
        }

        return $digits;
    }
} 