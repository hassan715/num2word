<?php

namespace num2word\Languages;


interface ILanguage
{
    /**
     * @param string $number
     * @param bool $addOnly
     * @param bool $addPeriod
     *
     * @return string
     */
    public function toWords($number, $addOnly, $addPeriod);

}