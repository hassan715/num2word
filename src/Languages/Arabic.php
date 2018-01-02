<?php

namespace num2word\Languages;

use num2word\Dictionaries\ArabicDictionary;
use num2word\Dictionaries\IDictionary;
use num2word\Processors\LanguageProcessor;

class Arabic extends LanguageProcessor implements ILanguage
{

    const NAME = 'Arabic';
    const SHORT_NAME = 'ar';
    /**
     * @var IDictionary
     */
    private $dictionary;

    /**
     * Changes the value at index1 with value at index2.
     *
     * @param array $a
     * @param int $index1
     * @param int $index2
     *
     * @return mixed
     */
    public function array_swap($a, $index1, $index2)
    {
        $temp = $a[$index1];
        $a[$index1] = $a[$index2];
        $a[$index2] = $temp;

        return $a;
    }

    public function parseIntegers($integers)
    {
        $words = [];
        $exponent_added = false;
        $last_number = 0;

        for ($i = 0; $i < count($integers); $i++) {
            $high_exponent = $integers[$i]['exponent'];
            for ($j = 0; $j < count($integers[$i]['digits']); $j++) {
                $exponent_added = false;
                $number = $integers[$i]['digits'][$j]['d'];
                $exponent = $integers[$i]['digits'][$j]['e'];
                if ($exponent == 2) {
                    $last_number = $number * 100;
                    if ($number < 3) {
                        $words[] = $this->dictionary->getExponent($exponent, $number - 1);
                    } else {
                        $words[] = $this->dictionary->getToken($number - 1) . " " . $this->dictionary->getExponent($exponent, 0);
                    }
                }
                if ($exponent == 1) {
                    $last_number = $number * 10;
                    $words[] = $this->dictionary->getTens($number - 1);
                }
                if ($exponent == 0) {
                    $last_number = $last_number + $number;
                    if (count($integers[$i]['digits']) == 1 && $number < 3 && $high_exponent > 1) {
                        $words[] = $this->dictionary->getExponent($high_exponent, $number - 1);
                        $exponent_added = true;
                    } else {
                        $words[] = $this->dictionary->getToken($number - 1);
                    }
                    if (count($integers[$i]['digits']) > 1 && $exponent = $integers[$i]['digits'][$j - 1]['e'] == 1) {
                        $words = $this->array_swap($words, count($words) - 1, count($words) - 2);
                    }
                }
            }
            if (!$exponent_added && $high_exponent > 2) {
                $last_element = $words[count($words) - 1];
                $exp = $this->dictionary->getExponent($high_exponent, $last_number);
                $words[count($words) - 1] = $last_element . " " . $exp;
            }
        }

        return $words;
    }

    public function getString($words, $addOnly, $addPeriod)
    {
        $str = "";
        for ($i = 0; $i < count($words); $i++) {
            $str .= $words[$i];
            if ($i < count($words) - 1) {
                $str .= " " . $this->dictionary->getSeparator();
            }
        }

        if ($addOnly)
            $str .= " " . $this->dictionary->getOnly();
        if ($addPeriod)
            $str .= ".";

        return $str;

    }

    /**
     * @param string $number
     * @param bool $addOnly
     * @param bool $addPeriod
     *
     * @return string
     */
    public function toWords($number, $addOnly, $addPeriod)
    {
        $this->setDictionary(new ArabicDictionary());
        $this->dictionary = $this->getDictionary();
        return $this->buildString($number, $addOnly, $addPeriod);
    }

}