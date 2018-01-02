<?php

namespace num2word\Languages;

use num2word\Dictionaries\EnglishDictionary;
use num2word\Processors\LanguageProcessor;

class English extends LanguageProcessor implements ILanguage
{

    const NAME = 'English';
    const SHORT_NAME = 'en';

    /**
     * @param string $number
     * @param bool $addOnly
     * @param bool $addPeriod
     *
     * @return string
     */
    public function toWords($number, $addOnly, $addPeriod)
    {
        $this->setDictionary(new EnglishDictionary());
        return $this->buildString($number, $addOnly, $addPeriod, true);
    }

}