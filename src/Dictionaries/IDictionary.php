<?php

namespace num2word\Dictionaries;


interface IDictionary
{
    /**
     * @param int $index
     *
     * @return string
     */
    public function getToken($index);

    /**
     * @param int $index
     *
     * @return string
     */
    public function getTens($index);

    /**
     * @param int $key
     * @param int $index
     *
     * @return string
     */
    public function getExponent($key, $index);

    /**
     * @return string
     */
    public function getEmpty();

    /**
     * @return string
     */
    public function getZero();

    /**
     * @return string
     */
    public function getSeparator();

    /**
     * @return string
     */
    public function getOnly();
}