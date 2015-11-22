<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 19.11.15
 * Time: 22:57
 */

namespace DawidDominiak\Sudoku\App\Values;


class Coordinates
{
    private $x;
    private $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function get()
    {
        return [
            'x' => $this->x,
            'y' => $this->y
        ];
    }

    public function __toString()
    {
        return 'x: ' . $this->x . ', y: ' . $this->y;
    }
}