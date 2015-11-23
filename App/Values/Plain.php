<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 18.11.15
 * Time: 21:12
 */

namespace DawidDominiak\Sudoku\App\Values;


use DawidDominiak\Sudoku\App\Helpers\EquatableInterface;

class Plain implements EquatableInterface
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

        $emptyArray = array_map(function() {

            return array_fill(0, 9, null);
        }, $emptyArray);

        return $emptyArray;
    }

    private function initializeArray($nativeArray)
    {
        foreach($nativeArray as $y => $row)
        {
            $this->array[$y] = [];

            foreach($row as $x => $value)
            {
                $this->array[$y][$x] = new Grid($value);
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

        return $this->array[$y][$x];
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

    public function __clone()
    {
        $this->array = (new \ArrayObject($this->array))->getArrayCopy();
    }

    /**
     * @param Plain $other
     * @return bool
     */
    public function equals($other)
    {
        for($x = 0; $x < 9; $x++)
        {
            for($y = 0; $y < 9; $y++)
            {
                $coordinates = new Coordinates($x, $y);

                if($this->getGrid($coordinates) !== $other->getGrid($coordinates))
                {
                    return false;
                }
            }
        }

        return true;
    }
}