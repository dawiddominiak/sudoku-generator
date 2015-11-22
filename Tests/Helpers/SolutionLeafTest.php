<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 22.11.15
 * Time: 15:53
 */

namespace DawidDominiak\Sudoku\Tests\Helpers;


use DawidDominiak\Sudoku\App\Helpers\SolutionLeaf;
use DawidDominiak\Sudoku\App\Values\Coordinates;

class SolutionLeafTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SolutionLeaf
     */
    private $leaf;

    protected function setUp()
    {
        $this->leaf = new SolutionLeaf(
            new Coordinates(3, 6),
            5
        );
    }

    public function testAddBranch()
    {
        $newLeaf = new SolutionLeaf(
            new Coordinates(4, 4),
            9
        );

        $this->leaf->addBranch(
            $newLeaf
        );

        $branches = $this->leaf->getBranches();

        /**
         * @var SolutionLeaf
         */
        $leaf = $branches[0];

        $this->assertInstanceOf('DawidDominiak\\Sudoku\\App\\Helpers\\SolutionLeaf', $leaf);
        $this->assertEquals(
            ['x' => 4, 'y' => 4],
            $leaf
                ->getCoordinates()
                ->get()
        );

        $this->assertTrue(
            $newLeaf->equals($leaf)
        );
    }

    public function testRemoveBranch()
    {
        $newLeaf = new SolutionLeaf(
            new Coordinates(4, 4),
            9
        );

        $this->leaf->addBranch($newLeaf);
        $this->leaf->removeBranch($newLeaf);

        $this->assertEquals([], $this->leaf->getBranches());
    }
}
