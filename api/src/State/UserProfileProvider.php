<?php

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\ProfileUser;
use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Service\UserService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserProfileProvider implements ProviderInterface
{
    public function __construct(
        private readonly UserService $userService,
    )
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|iterable|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            $users = new ArrayCollection($this->userService->getAllUsers());

            return $users->map(function (User $entityUser) {
              return new ProfileUser(
                  id: $entityUser->getId(),
                  email: $entityUser->getEmail(),
                  roles: $entityUser->getRoles()
              );
            });
        }

        try {
            $user = $this->userService->getUserById($uriVariables['id']);

            return new ProfileUser(
                id: $user->getId(),
                email: $user->getEmail(),
                roles: $user->getRoles()
            );
        } catch (UserNotFoundException) {
            throw new NotFoundHttpException();
        }
    }
}
