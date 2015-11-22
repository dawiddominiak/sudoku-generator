<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 19.11.15
 * Time: 22:57
 */

namespace DawidDominiak\Sudoku\App\Values;


use DawidDominiak\Sudoku\App\Helpers\EquatableInterface;

class Coordinates implements EquatableInterface
{
    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * Coordinates constructor.
     * @param int $x
     * @param int $y
     */
    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return array
     */
    public function get()
    {
        return [
            'x' => $this->x,
            'y' => $this->y
        ];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'x: ' . $this->x . ', y: ' . $this->y;
    }

    /**
     * @param Coordinates $other
     * @return bool
     */
    public function equals($other)
    {
        $otherNative = $other->get();

        return $this->x === $otherNative['x'] &&
            $this->y === $otherNative['y'];
    }
}