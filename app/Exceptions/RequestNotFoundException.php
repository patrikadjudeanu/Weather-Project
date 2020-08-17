<?php

namespace App\Exceptions;

use Exception;

class RequestNotFoundException extends Exception
{
    public function errorMessage() 
    {
        return 'Could not find any temperature request with given parameters.';
    }
}
