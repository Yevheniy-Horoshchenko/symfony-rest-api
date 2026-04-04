<?php

namespace App\Response;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ErrorResponseFormatter
{
    public static function form(
        ?ConstraintViolationListInterface $errors = null,
        ?string $message = null
    ): array {
        $formattedErrors = [];

        if ($errors instanceof ConstraintViolationListInterface) {
            foreach($errors as $error) {
                $formattedErrors[] = [
                    'property' => $error->getPropertyPath(),
                    'message' => $error->getMessage(),
                ];
            }
        }

        if ($message) {
            $formattedErrors['message'] = $message;
        }

        return $formattedErrors ? array_merge(['success' => false], $formattedErrors) : [];
    }
}