<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 18.11.15
 * Time: 20:06
 */

namespace DawidDominiak\Sudoku\Tests\Values;


use DawidDominiak\Sudoku\App\Values\Grid;

class GridTest extends \PHPUnit_Framework_TestCase
{
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
}
