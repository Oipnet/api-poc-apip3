<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class RoleNotFoundException extends BadRequestException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
