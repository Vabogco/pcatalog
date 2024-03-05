<?php

namespace App\Exception;

use App\Exception\CollectionException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends CollectionException
{
    public function __construct(string $message, ConstraintViolationListInterface $violationList)
    {
        parent::__construct($message, $this->formatErrors($violationList));
    }

    protected function formatErrors(ConstraintViolationListInterface $violationList): array
    {
        $errors = [];

        /** @var \Symfony\Component\Validator\ConstraintViolationInterface $violation */
        foreach ($violationList as $violation) {
            $errors[] = [
                'tag'   => $violation->getPropertyPath(),
                'message' => $violation->getMessage(),
            ];
        }

        return $errors;
    }
}
