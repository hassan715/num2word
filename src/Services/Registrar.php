<?php

namespace num2word\Services;

use num2word\Languages\Arabic;
use num2word\Languages\English;

class Registrar
{
    private $language;

    /**
     * Registrar constructor.
     *
     * @param string $language
     */
    public function __construct($language)
    {
        $this->language = $language;
    }

    /**
     * Returns current language class.
     *
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->register()[$this->language];
    }

    /**
     * Registers all language classes.
     * Add here all language classes to be used.
     *
     * @return array
     */
    private function register()
    {
        return [
            'en' => English::class,
            'ar' => Arabic::class
        ];
    }
}