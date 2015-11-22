<?php

namespace DawidDominiak\Sudoku\Tests\Values;


use DawidDominiak\Sudoku\App\Values\Grid;

class GridTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Grid
     */
    private $grid;

    protected function setUp()
    {
        $this->grid = new Grid();
    }

    public function testSetGetValue()
    {
        $this->grid->setValue(4);
        $this->assertEquals(4, $this->grid->getValue());
    }

    public function testIsEmptyShouldBeTrue()
    {
        $this->assertTrue($this->grid->isEmpty());
    }

    public function testIsEmptyShouldBeFalse()
    {
        $this->grid->setValue(5);
        $this->assertFalse($this->grid->isEmpty());
    }

    public function testGetPossibleValues()
    {
        $this->assertEquals(
            [1, 2, 3, 4, 5, 6, 7, 8, 9],
            $this->grid->getPossibleValues()
        );
    }

    public function testRemovePossibleValue()
    {
        $this->grid->removePossibleValues([5, 7]);

        $this->assertEquals(
            [1, 2, 3, 4, 6, 8, 9],
            $this->grid->getPossibleValues()
        );
    }

    public function testResetPossibleValues()
    {
        $this->grid->removePossibleValues([5]);
        $this->grid->resetPossibleValues();

        $this->assertEquals(
            [1, 2, 3, 4, 5, 6, 7, 8, 9],
            $this->grid->getPossibleValues()
        );
    }
}
