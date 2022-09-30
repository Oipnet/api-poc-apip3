<?php
namespace App\Constraint;

use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueDtoValidator extends ConstraintValidator
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly PropertyAccessorInterface $accessor)
    {
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof UniqueDTO) {
            throw new UnexpectedTypeException($constraint, UniqueDTO::class);
        }

        if(!$constraint->entityClass) {
            throw new InvalidArgumentException('Entity class is required.');
        }

        $repository = $this->em->getRepository($constraint->entityClass);

        $fields = (array) $constraint->fields;
        $criteria = [];

        foreach ($fields as $from => $to) {
            $criteria[$to] = $this->accessor->getValue($value, $from);
        }

        if ($repository->count($criteria)) {
            $cvb = $this->context->buildViolation($constraint->message);

            if ($constraint->atPath) {
                $cvb->atPath($constraint->atPath);
            }

            $cvb->addViolation();
        }
    }
}
