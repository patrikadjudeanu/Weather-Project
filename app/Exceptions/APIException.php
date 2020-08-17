<?php

namespace App\Exceptions;

use Exception;

class APIException extends Exception
{
    public function errorMessage() 
    {
        return 'The requested API is not working properly.';
    }
}
