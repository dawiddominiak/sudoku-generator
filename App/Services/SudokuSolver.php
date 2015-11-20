<?php

namespace DawidDominiak\Sudoku\App\Services;


use DawidDominiak\Sudoku\App\Values\Coordinates;
use DawidDominiak\Sudoku\App\Values\Plain;

class SudokuSolver
{
    /**
     * @var Plain
     */
    private $plain;

    /**
     * @var Plain
     */
    private $solution;

    /**
     * Sudoku constructor.
     * @param Plain $plain
     */
    public function __construct(Plain $plain)
    {
        $this->plain = $plain;
    }

    /**
     * @return Plain
     */
    public function findSolution()
    {
        $plain = clone $this->plain;

        //TODO: check correct
        $this->tryFindPartialSolution($plain);

        return $this->solution;
    }

    private function tryFindPartialSolution(Plain $plain)
    {
        $gridCoordinates = $this->findUnassignedLocation($plain);

        if(!$gridCoordinates)
        {
            $this->solution = $plain;

            return true;
        }

        for($number = 1; $number <= 9; $number++)
        {

            if($this->isSafe($plain, $gridCoordinates, $number))
            {
                $grid = $plain->getGrid($gridCoordinates);
                $grid->setValue($number);

                if($this->tryFindPartialSolution($plain))
                {
                    return true;
                }

                $grid->setValue(null);
            }
        }

        return false;
    }

    /**
     * @param Plain|null $plain
     * @return \DawidDominiak\Sudoku\App\Values\Coordinates|null
     */
    private function findUnassignedLocation(Plain $plain = null)
    {
        if(!$plain)
        {
            $plain = $this->plain;
        }

        for($x = 0; $x < 9; $x++)
        {
            for($y = 0; $y < 9; $y++)
            {
                $grid = $plain->getGrid(new Coordinates($x, $y));

                if($grid->isEmpty())
                {
                    return new Coordinates($x, $y);
                }
            }
        }

        return null;
    }

    /**
     * @param Plain $plain
     * @param Coordinates $coordinates
     * @param number $number
     * @return bool
     */
    public function isSafe(Plain $plain, Coordinates $coordinates, $number)
    {
        $coordinatesArray = $coordinates->get();
        $x = $coordinatesArray['x'];
        $y = $coordinatesArray['y'];

        return !$this->usedInRow($plain, $x, $number) &&
            !$this->usedInColumn($plain, $y, $number) &&
            !$this->usedInBox($plain, new Coordinates($x - $x%3, $y - $y%3), $number);
    }

    private function usedInRow(Plain $plain, $x, $number)
    {
        for($y = 0; $y < 9; $y++)
        {
            if($plain
                    ->getGrid(new Coordinates($x, $y))
                    ->getValue() === $number)
            {
                return true;
            }
        }
        return false;
    }

    private function usedInColumn(Plain $plain, $y, $number)
    {
        for($x = 0; $x < 9; $x++)
        {
            if($plain
                    ->getGrid(new Coordinates($x, $y))
                    ->getValue() == $number)
            {
                return true;
            }
        }
        return false;
    }

    private function usedInBox(Plain $plain, Coordinates $boxStartCoordinates, $number)
    {
        $coordinates = $boxStartCoordinates->get();

        for($x = 0; $x < 3; $x++)
        {
            for($y = 0; $y < 3; $y++)
            {
                if($plain
                        ->getGrid(
                            new Coordinates(
                                $x + $coordinates['x'],
                                $y + $coordinates['y']
                            )
                        )
                        ->getValue() === $number)
                {
                    return true;
                }
            }
        }
        return false;
    }
}