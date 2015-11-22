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
    private $possibleValues = [1, 2, 3, 4, 5, 6, 7, 8, 9];

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

    public function resetPossibleValues()
    {
        $this->possibleValues = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    }

    public function removePossibleValues($valuesToRemove)
    {
        $helperArray = array_diff($this->possibleValues, $valuesToRemove);
        $this->possibleValues = array_values($helperArray);
    }

    /**
     * @return array
     */
    public function getPossibleValues()
    {
        return $this->possibleValues;
    }
}