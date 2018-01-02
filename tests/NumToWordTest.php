<?php


use num2word\NumToWord;

class NumToWordTest extends PHPUnit_Framework_TestCase
{

    public function testSpellOut()
    {
        $aj = new NumToWord();
        print $aj->spellOut('1812233416', true, true, false, 'ar');
    }
}
