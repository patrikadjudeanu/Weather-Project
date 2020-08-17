<?php

namespace App\Exceptions;

use Exception;

class InvalidDataException extends Exception
{
    public function errorMessage() 
    {
        return 'The data you entered is not valid.';
    }
}
