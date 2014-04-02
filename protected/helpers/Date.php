<?php

namespace helpers;

class Date {
    protected static $timeZone = 1;
    
    public static function getCurrent() {
        return self::unixToDbDate(time() - self::$timeZone*3600);
    }
    
    public static function unixToDbDate($time) {
        return date('Y-m-d H:i:s', $time);
    }
    
}