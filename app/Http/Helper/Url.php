<?php

namespace App\Http\Helper;

class Url
{
    public static function addParamToEndOfUrl(String $param, String $value)
    {
        return url()->current() . '?' . http_build_query(array_merge(request()->except($param), [$param => $value]));
    }
}
