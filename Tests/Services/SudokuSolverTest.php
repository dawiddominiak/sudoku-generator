<?php

namespace DawidDominiak\Sudoku\Tests\Values;


use DawidDominiak\Sudoku\App\Helpers\ArrayUtils;
use DawidDominiak\Sudoku\App\Services\SudokuSolver;
use DawidDominiak\Sudoku\App\Values\Plain;

class SudokuTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SudokuSolver
     */
    private $solvableSudoku;
    private $sudokuWithMultipleSolutions;

    protected function setUp()
    {
        $solvablePlain = new Plain([
            [null, null,    4, null,    9,    5,    7, null, null],
            [7   , null, null, null, null, null, null,    5, null],
            [null, null,    5, null,    3, null,    4, null,    8],
            [null,    3, null, null, null, null, null, null, null],
            [null, null,    9, null, null,    1, null,    6,    3],
            [null, null, null, null, null, null, null, null, null],
            [null,    1, null,    6, null, null, null,    8, null],
            [null, null,    6,    8,    7,    4, null, null, null],
            [   4,    9, null, null,    5, null, null, null, null]
        ]);

        $sudokuWithMultipleSolutions = new Plain([
            [null, null,    4, null, null,    5,    7, null, null],
            [7   , null, null, null, null, null, null,    5, null],
            [null, null,    5, null,    3, null,    4, null,    8],
            [null,    3, null, null, null, null, null, null, null],
            [null, null,    9, null, null,    1, null,    6,    3],
            [null, null, null, null, null, null, null, null, null],
            [null,    1, null,    6, null, null, null,    8, null],
            [null, null,    6,    8,    7,    4, null, null, null],
            [   4,    9, null, null,    5, null, null, null, null]
        ]);

        $this->solvableSudoku = new SudokuSolver($solvablePlain);
        $this->sudokuWithMultipleSolutions = new SudokuSolver($sudokuWithMultipleSolutions);
    }

    public function testFindSolutionOfSolvableSudokuShouldFindSolution()
    {
        $algorithmSolutions = null;

        $algorithmSolutions = $this->solvableSudoku
            ->findSolutions(100);

        $algorithmSolution = $algorithmSolutions[0]
            ->toNative();

        $realSolution = [
            [1, 8, 4, 2, 9, 5, 7, 3, 6],
            [7, 6, 3, 4, 1, 8, 9, 5, 2],
            [9, 2, 5, 7, 3, 6, 4, 1, 8],
            [6, 3, 2, 9, 8, 7, 1, 4, 5],
            [8, 7, 9, 5, 4, 1, 2, 6, 3],
            [5, 4, 1, 3, 6, 2, 8, 7, 9],
            [3, 1, 7, 6, 2, 9, 5, 8, 4],
            [2, 5, 6, 8, 7, 4, 3, 9, 1],
            [4, 9, 8, 1, 5, 3, 6, 2, 7]
        ];

        $this->assertTrue(
            ArrayUtils::areMatrixEqual($algorithmSolution, $realSolution)
        );
    }

    /**
     * @expectedException DawidDominiak\Sudoku\App\Exceptions\ManySolutionsException
     */
    public function testSolvingSudokuWithMultipleSolutions()
    {
        $algorithmSolutions = $this->sudokuWithMultipleSolutions
            ->findSolutions(1);
    }
}
