<?php

namespace App\Handler;

use App\Dto\RegisterUser;
use App\Entity\Role;
use App\Entity\User;
use App\Enum\Roles;
use App\Service\RoleService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class RegisterUserHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly RoleService $roleService,
        private readonly UserPasswordHasherInterface $hasher,
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    public function __invoke(RegisterUser $registerUser)
    {
        $roleUser = $this->roleService->getRoleByEnum(Roles::ROLE_USER);

        $user = new User(
            email: $registerUser->email,
            roles: [$roleUser]
        );

        $user->setPassword(
            $this->hasher->hashPassword($user, $registerUser->password)
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
