<?php

namespace App\Service;

use App\Enum\Roles;
use App\Repository\RoleRepository;

class RoleService
{
    public function __construct(
        private readonly RoleRepository $roleRepository,
    )
    {
    }

    public function getRoleByEnum(Roles $role)
    {
        $roleEntity = $this->roleRepository->findOneBy(['role' => $role->value]);

        if (! $roleEntity) {
            throw new RoleNotFoundException('Le role n\'a pas été trouvé');
        }

        return $roleEntity;
    }
}
