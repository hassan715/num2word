<?php

namespace num2word\Languages;

use num2word\Services\Registrar;

class LanguageTransformer
{
    /**
     * @var ILanguage
     */
    private $languageTransformer;

    /**
     * LanguageTransformer constructor.
     *
     * @param string $language
     */
    public function __construct($language)
    {
        //get all registered languages and return current language instance
        $this->languageTransformer = (new Registrar($language))->getLanguage();

    }

    /**
     * Returns number as words.
     *
     * @param $number
     * @param bool $addOnly
     * @param bool $addPeriod
     * @param bool $isCurrency
     *
     * @return string
     */
    public function toWords($number, $addOnly, $addPeriod, $isCurrency)
    {
        return (new $this->languageTransformer)->toWords($number, $addOnly, $addPeriod);
    }
}