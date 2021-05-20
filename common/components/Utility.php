<?php

namespace common\components;

class Utility
{
    const MYSQL_DATE_FORMAT = 'Y-m-d H:i:s';

    public static function getDateNow()
    {
        return gmdate(self::MYSQL_DATE_FORMAT);
    }
}
