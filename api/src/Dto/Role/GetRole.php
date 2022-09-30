<?php

namespace App\Dto\Role;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\State\RoleProvider;

#[Get(
    uriTemplate: '/roles/{id}',
    security: "is_granted('ROLE_ADMIN')",
    provider: RoleProvider::class
)]
#[GetCollection(
    uriTemplate: '/roles',
    security: "is_granted('ROLE_ADMIN')",
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
