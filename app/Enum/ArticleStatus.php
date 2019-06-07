<?php
/**
 * Created by PhpStorm.
 * User: qamar
 * Date: 5/15/19
 * Time: 2:45 PM
 */

namespace App\Enum;


class ArticleStatus
{
    const OUTSTANDING = 0;
    const ACCEPT      = 1;
    const REJECT      = 2;


    public static function  getStatus ($status) {
        switch ($status) {
            case self::OUTSTANDING; return "معلقة";  break;
            case self::ACCEPT;      return "مقبولة"; break;
            case self::REJECT;      return "مرفوضة"; break;
        }
        return "";
    }

    public static function  getColorOfStatus ($status) {
        switch ($status) {
            case self::OUTSTANDING; return "sandybrown";  break;
            case self::ACCEPT;      return "lightgreen"; break;
            case self::REJECT;      return "red"; break;
        }
        return "";
    }

}