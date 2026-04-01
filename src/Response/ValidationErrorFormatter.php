<?php

namespace App\Response;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationErrorFormatter
{
    public static function mapErrors(
        ConstraintViolationListInterface $constraintViolationList
    ): array {
        $formattedErrors = [];

        foreach($constraintViolationList as $error) {
            $formattedErrors[] = [
                'property' => $error->getPropertyPath(),
                'message' => $error->getMessage(),
            ];
        }

        return $formattedErrors;
    }
}