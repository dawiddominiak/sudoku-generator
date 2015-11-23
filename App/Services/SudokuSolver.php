<?php

namespace DawidDominiak\Sudoku\App\Services;


use DawidDominiak\Sudoku\App\Exceptions\BadHypothesisException;
use DawidDominiak\Sudoku\App\Exceptions\ManySolutionsException;
use DawidDominiak\Sudoku\App\Values\Coordinates;
use DawidDominiak\Sudoku\App\Values\Plain;

class SudokuSolver
{
    /**
     * @var Plain
     */
    private $plain;

    /**
     * @var int
     */
    private $maxSolutionsCount;

    /**
     * @var array
     */
    private $solutions = [];

    /**
     * Sudoku constructor.
     * @param Plain $plain
     */
    public function __construct(Plain $plain)
    {
        $this->plain = $plain;
    }

    /**
     * @param int $maxSolutionsCount
     * @return Plain
     */
    public function findSolutions($maxSolutionsCount = 1, $plain = null)
    {
        if($plain === null)
        {
            $plain = $this->plain;
        }

        $this->maxSolutionsCount = $maxSolutionsCount;
        $this->solutions = [];
        //TODO: check correct
        $this->tryFindPartialSolution($plain);

        return $this->solutions;
    }

    private function tryFindPartialSolution(Plain $plain)
    {
        $plain = $this->updateGridPossibleValues($plain);
        $gridCoordinates = $this->findCurrentlyBestLocation($plain);

        if(!$gridCoordinates)
        {
            if(count($this->solutions) > $this->maxSolutionsCount)
            {
                throw new ManySolutionsException("There are too many solutions of given sudoku. Max number: " . $this->maxSolutionsCount);
            }

            array_push($this->solutions, new Plain($plain->toNative()));
        } else {
            $grid = $plain->getGrid($gridCoordinates);
            $possibleValues = $grid->getPossibleValues();

            foreach($possibleValues as $key => $number)
            {
                $grid->setValue($number);

                try
                {
                    $this->tryFindPartialSolution($plain);
                }
                catch(BadHypothesisException $e)
                {
                    continue;
                }
                finally
                {
                    $grid->setValue(null);
                }
            }
        }
    }

    /**
     * @param Plain|null $plain
     * @return Coordinates|null
     * @throws BadHypothesisException
     */
    private function findCurrentlyBestLocation(Plain $plain = null)
    {
        $countPossibleValues = [
            1 => [],
            2 => [],
            3 => [],
            4 => [],
            5 => [],
            6 => [],
            7 => [],
            8 => [],
            9 => []
        ];

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
                    $count = count($grid->getPossibleValues());
                    $coordinates = new Coordinates($x, $y);

                    if($count === 1)
                    {
                        return $coordinates;
                    }

                    if($count === 0)
                    {
                        throw new BadHypothesisException('There is no good solution for founded hypothesis.');
                    }

                    array_push($countPossibleValues[$count], $coordinates);
                }
            }
        }

        foreach($countPossibleValues as $possibleValues)
        {
            if(count($possibleValues) > 0)
            {
                return $possibleValues[0];
            }
        }
        return null;
    }

    public static function updateGridPossibleValues(Plain $plain)
    {

        $plain = new Plain($plain->toNative()); //TODO: find better cloning method

        $valuesInRows = [];
        $valuesInColumns = [];
        $valuesInSquares = [];

        for($y = 0; $y < 9; $y++)
        {
            array_push($valuesInRows, self::getValuesFromRow($plain, $y));
        }

        for($x = 0; $x < 9; $x++)
        {
            array_push($valuesInColumns, self::getValuesFromColumn($plain, $x));
        }

        for($y = 0; $y < 9; $y += 3)
        {
            for($x = 0; $x < 9; $x += 3)
            {
                $hash = (new Coordinates($x, $y))->__toString();

                $valuesInSquares[$hash] = self::getValuesFromSquare($plain, $x, $y);
            }
        }

        for($y = 0; $y < 9; $y++)
        {
            for($x = 0; $x < 9; $x++)
            {
                $coordinates = new Coordinates($x, $y);
                $grid = $plain
                    ->getGrid(
                        $coordinates
                    );

                $grid->removePossibleValues($valuesInRows[$y]);
                $grid->removePossibleValues($valuesInColumns[$x]);
                $grid->removePossibleValues(
                    $valuesInSquares[
                    (new Coordinates(
                        $x - $x%3,
                        $y - $y%3
                    ))
                        ->__toString()
                    ]
                );
            }
        }

        return $plain;
    }

    private static function getValuesFromRow(Plain $plain, $y)
    {
        $values = [];

        for($x = 0; $x < 9; $x++)
        {
            self::pushValueEventually($values, $plain, new Coordinates($x, $y));
        }

        return $values;
    }

    private static function getValuesFromColumn(Plain $plain, $x)
    {
        $values = [];

        for($y = 0; $y < 9; $y++)
        {
            self::pushValueEventually($values, $plain, new Coordinates($x, $y));
        }

        return $values;
    }

    private static function getValuesFromSquare(Plain $plain, $startX, $startY)
    {
        $values = [];

        for($y = $startY; $y < $startY + 3; $y++)
        {
            for($x = $startX; $x < $startX + 3; $x++)
            {
                self::pushValueEventually($values, $plain, new Coordinates($x, $y));
            }
        }

        return $values;
    }

    private static function pushValueEventually(&$valuesArray, Plain $plain, Coordinates $coordinates)
    {
        $currentGrid = $plain
            ->getGrid($coordinates)
        ;

        if(!$currentGrid->isEmpty())
        {
            array_push($valuesArray, $currentGrid->getValue());
        }
    }

    public function getFoundSolutions()
    {
        return $this->solutions;
    }
}