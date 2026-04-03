<?php

namespace App\Handler;

use App\DTO\UpdateUserOpeningDto;
use App\Entity\Opening;
use App\Response\ValidationErrorFormatter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateUserOpeningHandler
{
    public function __construct(
        private SerializerInterface $serializer,
        private EntityManagerInterface $entityManager
    ) {
    }

    public function __invoke(Request $request, Opening $opening): array
    {
        try {
            $updateUserOpeningDto = $this->serializer->deserialize(
                $request->getContent(),
                UpdateUserOpeningDto::class,
                'json'
            );
        } catch (\Throwable $e) {
            return ValidationErrorFormatter::mapErrors(
                message: 'Invalid JSON body'
            );
        }

        if ($updateUserOpeningDto->name) {
            $opening->setName($updateUserOpeningDto->name);
        }

        if ($updateUserOpeningDto->moves) {
            $opening->setMoves($updateUserOpeningDto->moves);
        }

        $this->entityManager->flush();

        return ['success' => true];
    }
}