<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 19.11.15
 * Time: 22:22
 */

namespace DawidDominiak\Sudoku\App\Exceptions;


class ManySolutionsException extends SudokuException
{
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}