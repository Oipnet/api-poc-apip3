<?php

namespace App\Dto\Role;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\State\RoleProvider;

#[Get(
    uriTemplate: '/roles/{id}',
    provider: RoleProvider::class
)]
#[GetCollection(
    uriTemplate: '/roles',
    provider: RoleProvider::class
)]
class GetRole
{
    #[ApiProperty(identifier: true)]
    public int $id;

    #[ApiProperty]
    public string $role;

    public function __construct(int $id, string $role)
    {
        $this->id = $id;
        $this->role = $role;
    }
}
