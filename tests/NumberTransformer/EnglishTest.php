<?php

namespace num2word\NumberTransformer;


use num2word\Languages\English;

class EnglishTest extends NumberTransformerTest
{
    public function setUp()
    {
        $this->numberTransformer = new English();
    }

    public function providerTestNumberToWord()
    {
        return [
            ['0', 'zero'],
            ['1', 'one'],
            ['8', 'eight'],
            ['10', 'ten'],
            ['11', 'eleven'],
            ['12', 'twelve'],
            ['16', 'sixteen'],
            ['19', 'nineteen'],
            ['20', 'twenty'],
            ['21', 'twenty one'],
            ['26', 'twenty six'],
            ['30', 'thirty'],
            ['31', 'thirty one'],
            ['39', 'thirty nine'],
            ['40', 'forty'],
            ['41', 'forty one'],
            ['45', 'forty five'],
            ['50', 'fifty'],
            ['53', 'fifty three'],
            ['57', 'fifty seven'],
            ['60', 'sixty'],
            ['61', 'sixty one'],
            ['70', 'seventy'],
            ['71', 'seventy one'],
            ['80', 'eighty'],
            ['81', 'eighty one'],
            ['90', 'ninety'],
            ['91', 'ninety one'],
            ['100', 'one hundred'],
            ['101', 'one hundred one'],
            ['112', 'one hundred twelve'],
            ['120', 'one hundred twenty'],
            ['200', 'two hundred'],
            ['1000', 'one thousand'],
            ['1010', 'one thousand and ten'],
            ['1102', 'one thousand and one hundred two'],
            ['2134', 'two thousand and one hundred thirty four'],
            ['10305', 'ten thousand and three hundred five'],
            ['81912', 'eighty one thousand and nine hundred twelve'],
            ['312005', 'three hundred twelve thousand and five'],
            ['1000000', 'one million'],
            ['20134013', 'twenty million one hundred thirty four thousand and thirteen'],
            ['1700000001', 'one billion seven hundred million and one'],
            ['23450400123', 'twenty three billion four hundred fifty million four hundred thousand and one hundred twenty three'],
            ['988100467899', 'nine hundred eighty eight billion one hundred million four hundred sixty seven thousand and eight hundred ninety nine']
        ];
    }
}
