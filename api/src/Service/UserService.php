<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public function getUserById(int $id): User
    {
        $user = $this->userRepository->find($id);

        if (! $user) {
            throw new UserNotFoundException('L\'utilisateur n\'existe pas');
        }
        return $user;
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->findAll();
    }
}
