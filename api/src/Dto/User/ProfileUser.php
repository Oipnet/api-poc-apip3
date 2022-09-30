<?php

namespace App\Dto\User;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Get;
use App\State\UserProfileProvider;

#[Get(
    uriTemplate: '/users/{id}',
    output: ProfileUser::class,
    provider: UserProfileProvider::class
)]
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
