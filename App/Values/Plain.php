<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 18.11.15
 * Time: 21:12
 */

namespace DawidDominiak\Sudoku\App\Values;


class Plain
{
    private $array;

    public function __construct($nativeArray = null)
    {
        if(!$nativeArray)
        {
            $nativeArray = $this->createEmptyNativeArray();
        }

        $this->initializeArray($nativeArray);
    }

    private function createEmptyNativeArray()
    {
        $emptyArray = array_fill(0, 9, null);

        array_map(function() {

            return array_fill(0, 9, null);
        }, $emptyArray);

        return $emptyArray;
    }

    private function initializeArray($nativeArray)
    {
        foreach($nativeArray as $x => $row)
        {
            $this->array[$x] = [];

            foreach($row as $y => $value)
            {
                $this->array[$x][$y] = new Grid($value);
            }
        }
    }

    /**
     * @param Coordinates $coordinates
     * @return Grid
     */
    public function getGrid($coordinates)
    {
        $nativeArray = $coordinates->get();
        $x = $nativeArray['x'];
        $y = $nativeArray['y'];

        return $this->array[$x][$y];
    }

    public function toNative()
    {
        $native = [];

        foreach($this->array as $y => $row)
        {
            $native[$y] = [];

            foreach($row as $x => $grid)
            {
                $native[$y][$x] = $grid->getValue();
            }
        }

        return $native;
    }
}