<?php

namespace num2word\Dictionaries;


class ArabicDictionary implements IDictionary
{
    const ZERO = "صفر";
    const SEPARATOR = "و";
    const ONLY = 'فقط';

    private $tokens = ["واحد", "إثنان", "ثلاثة", "أربعة",
        "خمسة", "ستة", "سبعة", "ثمانية", "تسعة", "عشرة", "أحد عشر", "إثنا عشر", "ثلاثة عشر",
        "اربعة عشر", "خمسة عشر", "ستة عشر", "سبعة عشر", "ثمانية عشر", "تسعة عشر"
    ];

    private $tens = ["عشرة", "عشرون", "ثلاثون", "أربعون",
        "خمسون", "ستون", "سبعون", "ثمانون", "تسعون"
    ];

    private $exponents = [
        "2" => ["مئة", "مئتان", "مئات"],
        "3" => ["ألف", "ألفان", "آلاف"],
        "6" => ["مليون", "مليونان", "ملايين"],
        "9" => ["مليار", "ملياران", "مليارات"],
        "12" => ["تريلون", "تريليونان", "تلريليونات"],
        "15" => ["كوادريليون", "كوادريليونان", "كوادريليونات"],
        "18" => ["كوينتليون", "كوينتليونان", "كوينتليونات"],
        "21" => ["سكستليون", "سكستليونان", "سكستليونات"],
        "24" => ["سبتيلليون", "سبتيلليونان", "سبتيلليونات"],
        "27" => ["أوكتيليون", "أوكتيليونان", "أوكتيليونات"],
        "30" => ["نونيلليون", "نونيلليونان", "نونيلليونات"],
        "33" => ["دشيليون", "دشيليونان", "دشيليونات"],
        "36" => ["أوندشيلليون", "أوندشيلليونان", "أوندشيلليونات"],
        "39" => ["دودشيليون", "دودشيليونان", "دودشيليونات"],
        "42" => ["تريدشيليون", "تريدشيليونان", "تريدشيليونات"],
        "45" => ["كواتوردشيليون", "كواتوردشيليونان", "كواتوردشيليونات"],
        "48" => ["كويندشيليون", "كويندشيليونان", "كويندشيليونات"],
        "51" => ["سكسدشيليون", "سكسدشيليونان", "سكسدشيليونات"],
        "54" => ["سبتندشيليون", "سبتندشيليونان", "سبتندشيليونات"],
        "57" => ["أوكتودشيليون", "أوكتودشيليونان", "أوكتودشيليونات"],
        "60" => ["نوفمدشيليون", "نوفمدشيليونان", "نوفمدشيليونات"],
        "63" => ["فجنتليون", "فجنتليونان", "فجنتليونات"]
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
        if ($index == 1 || $index == 2)
            return $this->exponents[$key][$index];
        if ($index > 2 && $index < 11)
            return $this->exponents[$key][2];
        else
            return $this->exponents[$key][0];
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