<?php

namespace App\Model;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Dto\ProfileUser;
use App\Dto\RegisterUser;
use ApiPlatform\Symfony\Messenger\Processor as MessengerProcessor;
use App\State\UserProfileProvider;
use Symfony\Component\HttpFoundation\Response;


#[Post(
    status: Response::HTTP_ACCEPTED, input: RegisterUser::class, output: false, processor: MessengerProcessor::class)]
#[Get(
    //uriTemplate: '/users/{id}',
    output: ProfileUser::class,
    provider: UserProfileProvider::class
)]
final class User
{
    public int $id;
}
