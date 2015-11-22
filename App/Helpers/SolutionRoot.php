<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 22.11.15
 * Time: 14:45
 */

namespace DawidDominiak\Sudoku\App\Helpers;


class SolutionRoot extends SolutionLeaf
{
    public function __construct()
    {
        parent::__construct(null, null); //Root don't have coordinates and/or values.
    }
}