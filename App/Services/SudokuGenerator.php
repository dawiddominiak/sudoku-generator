<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 22.11.15
 * Time: 23:55
 */

namespace DawidDominiak\Sudoku\App\Services;


use DawidDominiak\Sudoku\App\Exceptions\ManySolutionsException;
use DawidDominiak\Sudoku\App\Values\Coordinates;
use DawidDominiak\Sudoku\App\Values\Plain;

class SudokuGenerator
{
    private $randomCoordinates;

    public function generate()
    {
        $plain = new Plain();
        $this->initShuffledCoordinates();

        $coordinatesGenerator = $this->getNextRandomCoordinates();
        $i = 0;

        foreach($coordinatesGenerator as $coordinates)
        {
            if($i < 17) //The minimal number to ate unique sudoku is 17 follow the: http://www.nature.com/news/mathematician-claims-breakthrough-in-sudoku-puzzle-1.9751
            {
                $plain = SudokuSolver::updateGridPossibleValues($plain);
                $grid = $plain->getGrid($coordinates);
                $possibleValues = $grid->getPossibleValues();
                $grid->setValue($possibleValues[array_rand($possibleValues)]);
            }
            else
            {
                try
                {
                    $plain = new Plain($plain->toNative());
                    $solver = new SudokuSolver($plain);
                    $solver->findSolutions(1);

                    return $plain;
                }
                catch(ManySolutionsException $e)
                {
                    $solutions = $solver->getFoundSolutions();
                    $tempSolution = $solutions[0];

                    $grid = $plain->getGrid($coordinates);
                    $grid->setValue(
                        $tempSolution
                            ->getGrid($coordinates)
                            ->getValue()
                    );
                }
            }

            $i++;
        }
    }

    private function initShuffledCoordinates()
    {
        $coordinates = [];

        for($x = 0; $x < 9; $x++)
        {
            for($y = 0; $y < 9; $y++)
            {
                array_push($coordinates, new Coordinates($x, $y));
            }
        }

        shuffle($coordinates);

        $this->randomCoordinates = $coordinates;
    }

    /**
     * @return \Generator/Coordinates
     */
    private function getNextRandomCoordinates()
    {
        foreach($this->randomCoordinates as $coordinates)
        {
            yield $coordinates;
        }
    }
}