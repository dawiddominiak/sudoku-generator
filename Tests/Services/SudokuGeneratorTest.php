<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 23.11.15
 * Time: 01:28
 */

namespace DawidDominiak\Sudoku\Tests\Values;


use DawidDominiak\Sudoku\App\Services\SudokuGenerator;
use DawidDominiak\Sudoku\App\Services\SudokuSolver;

class SudokuGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SudokuGenerator
     */
    private $generator;

    protected function setUp()
    {
        $this->generator = new SudokuGenerator();
    }

    //TODO: optimization - human strategies
    //TODO: random function injection - tests not depending on random factor.
    public function testGenerateShouldGenerateUniqueSudoku()
    {
        $plain = $this->generator->generate();
        $solver = new SudokuSolver($plain);
        $solutions = $solver->findSolutions(1); //No exceptions = proper solution

        $this->assertNotNull($plain);
        $this->assertNotNull($solutions);
    }
}
