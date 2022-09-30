<?php

namespace App\Dto\User;

use ApiPlatform\Metadata\Post;
use ApiPlatform\Symfony\Messenger\Processor as MessengerProcessor;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use App\Constraint\UniqueDto;

#[Post(
    uriTemplate: '/users',
    status: Response::HTTP_ACCEPTED,
    input: RegisterUser::class,
    output: false,
    processor: MessengerProcessor::class
)]
#[UniqueDto(fields: ['email' => 'email'], entityClass: User::class)]
class RegisterUser
{
    #[Assert\Email]
    #[Assert\NotBlank]
    public string $email;

    #[Assert\EqualTo(propertyPath: "confirmPassword", message: "Invalid confirm password")]
    #[Assert\NotBlank]
    #[Assert\Length(min: 8)]
    public string $password;

    #[Assert\NotBlank]
    public string $confirmPassword = '';

}
