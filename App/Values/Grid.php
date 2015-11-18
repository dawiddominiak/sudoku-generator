<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 18.11.15
 * Time: 20:02
 */

namespace DawidDominiak\Sudoku\App\Values;


class Grid
{
    private $value = null;

    /**
     * @return number
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param number $value
     */
    public function setValue($value)
    {
        if($value != null)
        {
            $this->value = $value;
        }
    }
}