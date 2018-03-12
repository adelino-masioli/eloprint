<?php
/**
 * Created by PhpStorm.
 * User: alfjuniorbh
 * Date: 02/11/16
 * Time: 19:35
 */
namespace App;

class Helpers {
    //helper convert money_br
    public static function  money_br($date)
    {
        return number_format($date, 2, ',', '.');
    }
    //helper convert money_reverse
    public static function  money_reverse($date)
    {
        $price = str_replace('.', '', $date);
        return  str_replace(',', '.', $price);
    }
    //helper convert decial
    public static function  decial($date)
    {
        $price = str_replace('.', '.', $date);
        return  floatval($price);
    }
    //helper generate token application
    public static function  gen_token($size) {
        return substr(md5(uniqid(rand(), true)), 0, $size);
    }
}