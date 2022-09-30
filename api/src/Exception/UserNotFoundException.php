<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserNotFoundException extends BadRequestException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
