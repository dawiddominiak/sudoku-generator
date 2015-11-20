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
    private $value;

    public function __construct($value = null)
    {
        $this->value = $value;
    }

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
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return !$this->value;
    }
}