<?php

namespace App\Handler;

use App\Dto\User\ProfileUser;
use App\Exception\UserNotFoundException;
use App\Service\UserService;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeleteUserHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly UserService $userService,
        private readonly LoggerInterface $logger
    )
    {
    }

    public function __invoke(ProfileUser $user)
    {
        try {
            $this->userService->deleteUserById($user->id);
        } catch (UserNotFoundException) {
            $this->logger->error('Utilisateur '.$user->id.' non trouvé');
        }
    }
}
