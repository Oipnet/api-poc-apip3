<?php

namespace App\Dto;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Get;
use App\State\UserProfileProvider;
use Doctrine\ORM\Mapping\GeneratedValue;

class ProfileUser
{
    #[ApiProperty(identifier: true)]
    public int $id;

    #[ApiProperty]
    public string $email;
    public array $roles;

    public function __construct(int $id, string $email, array $roles = [])
    {
        $this->id = $id;
        $this->email = $email;
        $this->roles = $roles;
    }
}
