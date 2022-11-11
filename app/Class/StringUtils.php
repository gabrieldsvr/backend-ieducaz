<?php

namespace App\Class;

class StringUtils
{

    public static function RemoveSpecialChar($str)
    {
        $res = preg_replace('/[\@\.\-\;\" "]+/', '', $str);
        return $res;
    }
}
