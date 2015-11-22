<?php

namespace DawidDominiak\Sudoku\Tests\Helpers;

class ArrayUtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testAreMatrixEqualOfTwoEqualMatrixShouldBeTrue()
    {
        $this->assertTrue(
            \DawidDominiak\Sudoku\App\Helpers\ArrayUtils::areMatrixEqual(
                [
                    [1,2,3],
                    [4,5,6],
                    [7,8,9]
                ],
                [
                    [1,2,3],
                    [4,5,6],
                    [7,8,9]
                ]
            )
        );
    }

    public function testAreMatrixEqualOfTwoMatrixWithDifferentLengthShouldBeFalse()
    {
        $this->assertFalse(
            \DawidDominiak\Sudoku\App\Helpers\ArrayUtils::areMatrixEqual(
                [
                    [1,2,3],
                    [4,5,6],
                    [7,8,9]
                ],
                [
                    [1,2,3],
                    [4,5,6],
                    [7,8,9],
                    []
                ]
            )
        );
    }

    public function testAreMatrixEqualOfTwoMatrixWithDifferentRowLengthShouldBeFalse()
    {
        $this->assertFalse(
            \DawidDominiak\Sudoku\App\Helpers\ArrayUtils::areMatrixEqual(
                [
                    [1,2,3],
                    [4,5,6],
                    [7,8,9]
                ],
                [
                    [1,2,3],
                    [4,5,6],
                    [7,8,9,10]
                ]
            )
        );
    }

    public function testAreMatrixEqualOfTwoMatrixWithDifferentValuesShouldBeFalse()
    {
        $this->assertFalse(
            \DawidDominiak\Sudoku\App\Helpers\ArrayUtils::areMatrixEqual(
                [
                    [1,2,3],
                    [4,5,6],
                    [7,8,9]
                ],
                [
                    [1,2,3],
                    [4,5,6],
                    [7,9,8]
                ]
            )
        );
    }
}
