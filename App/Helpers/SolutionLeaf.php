<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 22.11.15
 * Time: 14:45
 */

namespace DawidDominiak\Sudoku\App\Helpers;


use DawidDominiak\Sudoku\App\Values\Coordinates;

class SolutionLeaf implements EquatableInterface
{
    private $coordinates;
    private $value;
    private $branches = [];
    private $parent;

    /**
     * SolutionLeaf constructor.
     * @param Coordinates/null $coordinates
     * @param int $value
     */
    public function __construct($coordinates, $value)
    {
        $this->coordinates = $coordinates;
        $this->value = $value;
    }

    public function addBranch(SolutionLeaf $leaf)
    {
        array_push($this->branches, $leaf);
    }

    public function removeBranch(SolutionLeaf $leaf)
    {
        $helperArray = array_filter($this->branches, function($element) use ($leaf) {

            return !$element->equals($leaf);
        });

        $this->branches = array_values($helperArray);
    }

    public function getBranches()
    {
        return $this->branches;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @param SolutionLeaf $other
     * @return bool
     */
    public function equals($other)
    {
        return $this->getValue() === $other->getValue() &&
            $this
                ->getCoordinates()
                ->equals(
                    $other->getCoordinates()
                );
    }
}
