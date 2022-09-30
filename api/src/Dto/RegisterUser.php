<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

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
