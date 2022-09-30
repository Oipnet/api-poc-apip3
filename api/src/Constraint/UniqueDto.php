<?php

namespace App\Constraint;

use Attribute;
use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_CLASS)]
class UniqueDto extends Constraint
{
    public ?string $atPath = null;
    public string $entityClass;
    public array $fields;
    public string $message = 'This Dto is not unique';

    #[HasNamedArguments]
    public function __construct(array $fields, string $entityClass, array $groups = null, mixed $payload = null)
    {
        parent::__construct([], $groups, $payload);

        $this->fields = $fields;
        $this->entityClass = $entityClass;
    }

    public function getTargets(): string
    {
        return parent::CLASS_CONSTRAINT;
    }
}
