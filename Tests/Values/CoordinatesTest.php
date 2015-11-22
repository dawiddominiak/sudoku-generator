<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 22.11.15
 * Time: 11:34
 */

namespace DawidDominiak\Sudoku\Tests\Values;


use DawidDominiak\Sudoku\App\Values\Coordinates;

class CoordinatesTest extends \PHPUnit_Framework_TestCase
{
    private $coordinates;

    protected function setUp()
    {
        $this->coordinates = new Coordinates(4, 5);
    }

    public function testGet()
    {
        $this->assertEquals([
            'x' => 4,
            'y' => 5
        ], $this->coordinates->get());
    }
}
