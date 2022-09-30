<?php

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\Role\GetRole;
use App\Entity\Role;
use App\Exception\UserNotFoundException;
use App\Service\RoleService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoleProvider implements ProviderInterface
{
    public function __construct(
        private readonly RoleService $roleService,
    )
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|iterable|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            $roles = $this->roleService->getAllRoles();

            return $roles->map(function (Role $role) {
                return new GetRole(
                    id: $role->getId(), role:
                    $role->getRole()->value);
            });
        }

        try {
            $role = $this->roleService->getRoleById($uriVariables['id']);

            return new GetRole(
                id: $role->getId(),
                role: $role->getRole()->value,
            );
        } catch (UserNotFoundException) {
            throw new NotFoundHttpException();
        }
    }
}
