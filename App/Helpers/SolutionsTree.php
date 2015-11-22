<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 22.11.15
 * Time: 14:36
 */

namespace DawidDominiak\Sudoku\App\Helpers;

/**
 * Class SolutionsTree represents routes to find solutions of given quasi sudoku.
 * @package DawidDominiak\Sudoku\App\Helpers
 */
class SolutionsTree
{
    /**
     * @var SolutionRoot
     */
    private $root;

    public function __construct()
    {
        $this->root = new SolutionRoot();
    }

    /**
     * @return SolutionRoot
     */
    public function getRoot()
    {
        return $this->root;
    }
}