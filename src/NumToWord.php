<?php

namespace num2word;

use num2word\Languages\LanguageTransformer;

class NumToWord
{
    /**
     * Spells out the given number as words.
     *
     * @param $number
     * @param bool $addOnly
     * @param bool $addPeriod
     * @param bool $isCurrency
     * @param string $language
     *
     * @return string
     */
    public function spellOut($number, $addOnly = false, $addPeriod = false, $isCurrency = false, $language = 'en')
    {
        //call language transformer
        return (new LanguageTransformer($language))
            ->toWords($number, $addOnly, $addPeriod, $isCurrency);

    }

}