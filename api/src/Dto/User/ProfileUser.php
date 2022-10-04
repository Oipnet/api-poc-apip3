<?php

namespace App\Dto\User;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Symfony\Messenger\Processor as MessengerProcessor;
use App\State\UserProfileProvider;

#[Get(
    uriTemplate: '/users/{id}',
    security: "is_granted('ROLE_ADMIN') or object.id == user.getId()",
    output: ProfileUser::class,
    provider: UserProfileProvider::class
)]
#[GetCollection(
    uriTemplate: '/users',
    security: "is_granted('ROLE_ADMIN')",
    output: ProfileUser::class,
    provider: UserProfileProvider::class
)]
#[Delete(
    uriTemplate: '/users/{id}',
    security: "is_granted('ROLE_ADMIN')  or object.id == user.getId()",
    input: ProfileUser::class,
    output: false,
    provider: UserProfileProvider::class,
    processor: MessengerProcessor::class
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
