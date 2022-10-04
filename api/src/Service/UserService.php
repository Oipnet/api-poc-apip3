<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EntityManagerInterface $entityManager
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

    public function getAllUsers(): Collection
    {
        return new ArrayCollection($this->userRepository->findAll());
    }

    public function deleteUserById(int $id)
    {
        $user = $this->userRepository->find($id);

        if (! $user) {
            throw new UserNotFoundException('L\'utilisateur n\'existe pas');
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}
