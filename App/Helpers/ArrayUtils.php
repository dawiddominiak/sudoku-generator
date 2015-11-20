<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 20.11.15
 * Time: 00:45
 */

namespace DawidDominiak\Sudoku\App\Helpers;


class ArrayUtils
{
    public static function areMatrixEqual($matrix1, $matrix2)
    {
        if(count($matrix1) !== count($matrix2))
        {
            return false;
        }

        foreach($matrix1 as $y => $row) {

            if(count($row) !== count($matrix2[$y]))
            {
                return false;
            }

            foreach($row as $x => $value)
            {
                if($value !== $matrix2[$y][$x])
                {
                    return false;
                }
            }
        }

        return true;
    }
}