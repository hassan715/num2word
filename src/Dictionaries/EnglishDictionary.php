<?php

namespace num2word\Dictionaries;


class EnglishDictionary implements IDictionary
{
    const ZERO = "zero";
    const SEPARATOR = "and";
    const ONLY = 'only';

    private $tokens = ["one", "two", "three", "four", "five", "six",
        "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen",
        "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen"
    ];

    private $tens = ["ten", "twenty", "thirty", "forty",
        "fifty", "sixty", "seventy", "eighty", "ninety"
    ];

    private $exponents = [
        "2" => ["hundred"],
        "3" => ["thousand"],
        "6" => ["million"],
        "9" => ["billion"],
        "12" => ["trillion"],
        "15" => ["quadrillion"],
        "18" => ["quintillion"],
        "21" => ["sextillion"],
        "24" => ["septillion"],
        "27" => ["octillion"],
        "30" => ["nonillion"],
        "33" => ["decillion"],
        "36" => ["undecillion"],
        "39" => ["duodecillion"],
        "42" => ["tredecillion"],
        "45" => ["quattuordecillion"],
        "48" => ["quindecillion"],
        "51" => ["sexdecillion"],
        "54" => ["septendecillion"],
        "57" => ["octodecillion"],
        "60" => ["novemdecillion"],
        "63" => ["vigintillion"]
    ];

    /**
     * EnglishDictionary constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param int $index
     *
     * @return string
     */
    public function getToken($index)
    {
        return $this->tokens[$index];
    }

    /**
     * @param int $index
     *
     * @return string
     */
    public function getTens($index)
    {
        return $this->tens[$index];
    }

    /**
     * @param int $key
     * @param int $index
     *
     * @return string
     */
    public function getExponent($key, $index)
    {
        return $this->exponents[$key][$index];
    }

    /**
     * @return string
     */
    public function getEmpty()
    {
        return 'Empty String';
    }

    /**
     * @return string
     */
    public function getZero()
    {
        return self::ZERO;
    }

    /**
     * @return string
     */
    public function getSeparator()
    {
        return self::SEPARATOR;
    }

    /**
     * @return string
     */
    public function getOnly()
    {
        return self::ONLY;
    }
}