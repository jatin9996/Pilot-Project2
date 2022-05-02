<?php

namespace App\Helpers;
/**
 * Class DataTable
 */
class DataTable
{
    /**
     * @param false $sort
     * @return mixed|string
     */
    public static function sorting($sort = false)
    {
        $sortVal = "desc";
        if (isset($sort) && $sort != null) {
            if (in_array($sort, self::sortArr())) {
                $sortVal = $sort;
            }
        }
        return $sortVal;
    }

    /**
     * @return string[]
     */
    private static function sortArr()
    {
        return array(
            'asc',
            'desc'
        );
    }
}
