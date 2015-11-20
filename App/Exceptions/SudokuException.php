<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 19.11.15
 * Time: 18:21
 */

namespace DawidDominiak\Sudoku\App\Exceptions;


class SudokuException extends \Exception
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