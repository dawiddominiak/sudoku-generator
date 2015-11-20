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
}
