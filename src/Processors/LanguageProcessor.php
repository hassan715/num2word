<?php

namespace num2word\Processors;

use num2word\Dictionaries\IDictionary;

class LanguageProcessor
{
    /**
     * @var DefaultProcessor
     */
    private $processor;
    /**
     * @var IDictionary
     */
    private $dictionary;
    /**
     * @var bool
     */
    private $withSeparator;

    /**
     * LanguageProcessor constructor.
     */
    public function __construct()
    {
        $this->processor = new DefaultProcessor();
    }

    /**
     * @return DefaultProcessor
     */
    public function getProcessor()
    {
        return $this->processor;
    }

    /**
     * @return IDictionary
     */
    public function getDictionary()
    {
        return $this->dictionary;
    }

    /**
     * @param IDictionary $dictionary
     */
    public function setDictionary(IDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    /**
     * Builds a string from words array.
     *
     * @param string $number
     * @param bool $addOnly
     * @param bool $addPeriod
     *
     * @return string
     */
    public function buildString($number, $addOnly, $addPeriod, $withSeparator = false)
    {
        if ($number == '')
            return $this->dictionary->getEmpty();

        if ($number == '0')
            return $this->dictionary->getZero();

        $this->withSeparator = $withSeparator;
        $words = $this->parseValues($number);
        return $this->getString($words, $addOnly, $addPeriod);
    }

    /**
     * Parses given number string into digits with corresponding exponents.
     *
     * @param string $value
     *
     * @return array
     */
    public function parseValues($value)
    {
        $this->processor->processString($value);
        $integers = $this->processor->getIntegerDigits();

        return $this->parseIntegers($integers);
    }

    /**
     * Parses the integer part of the given number string and returns an
     * array of words.
     * This can be overridden for more functionality.
     *
     * @param array $integers
     *
     * @return array
     */
    public function parseIntegers($integers)
    {
        $words = [];
        for ($i = 0; $i < count($integers); $i++) {
            $high_exponent = $integers[$i]['exponent'];
            for ($j = 0; $j < count($integers[$i]['digits']); $j++) {
                $low_exponent = $integers[$i]['digits'][$j]['e'];
                $low_digit = $integers[$i]['digits'][$j]['d'];
                if ($low_exponent > 1) {
                    $words[] = $this->dictionary->getToken($low_digit - 1) . " " . $this->dictionary->getExponent($low_exponent, 0);
                }
                if ($low_exponent == 0) {
                    $words[] = $this->dictionary->getToken($low_digit - 1);
                }
                if ($low_exponent == 1) {
                    $words[] = $this->dictionary->getTens($low_digit - 1);
                }
            }
            if ($high_exponent > 2) {
                $words[] = $this->dictionary->getExponent($high_exponent, 0);
                if ($i == count($integers) - 2 && $this->addSeparator()) {
                    $words[] = $this->dictionary->getSeparator();
                }
            }
        }

        return $words;
    }

    public function addSeparator()
    {
        return $this->withSeparator;
    }

    /**
     * Returns a string of words.
     *
     * @param array $words
     * @param bool $addOnly
     * @param bool $addPeriod
     *
     * @return string
     */
    public function getString($words, $addOnly, $addPeriod)
    {
        $str = "";
        for ($i = 0; $i < count($words); $i++) {
            $str .= $words[$i];
            if ($i < count($words) - 1) {
                $str .= " ";
            }
        }

        if ($addOnly)
            $str .= " " . $this->dictionary->getOnly();
        if ($addPeriod)
            $str .= ".";

        return $str;

    }

    /**
     * Returns the exponent of the corresponding value,
     * where value is an array of digits, maximum 3 digits.
     *
     * @param array $values
     * @param int $index
     *
     * @return int
     */
    public function getHighExponent($values, $index)
    {
        return $values[$index]['exponent'];
    }

    /**
     * Returns the exponent of the corresponding digit.
     *
     * @param array $values
     * @param int $index
     * @param int $order
     *
     * @return int
     */
    public function getLowExponent($values, $index, $order)
    {
        return $values[$index]['value'][$order]['e'];
    }

    /**
     * Returns the corresponding value array. digits with exponents.
     *
     * @param array $values
     * @param int $index
     *
     * @return array
     */
    public function getHighDigits($values, $index)
    {
        return $values[$index]['digits'];
    }

    /**
     * Returns the digit in inner array.
     *
     * @param array $values
     * @param int $index
     * @param int $order
     *
     * @return int
     */
    public function getLowValue($values, $index, $order)
    {
        return $values[$index]['value'][$order]['d'];
    }
}