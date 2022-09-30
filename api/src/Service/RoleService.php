<?php

namespace App\Service;

use App\Entity\Role;
use App\Enum\Roles;
use App\Exception\RoleNotFoundException;
use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class RoleService
{
    public function __construct(
        private readonly RoleRepository $roleRepository,
    )
    {
    }

    public function getRoleByEnum(Roles $role): Role
    {
        $roleEntity = $this->roleRepository->findOneBy(['role' => $role->value]);

        if (! $roleEntity) {
            throw new RoleNotFoundException('Le role n\'a pas été trouvé');
        }

        return $roleEntity;
    }

    public function getRoleById(int $id): Role
    {
        $roleEntity = $this->roleRepository->find($id);

        if (! $roleEntity) {
            throw new RoleNotFoundException('Le role n\'a pas été trouvé');
        }

        return $roleEntity;
    }

    public function getAllRoles(): Collection
    {
        return new ArrayCollection($this->roleRepository->findAll());
    }
}
