<?php

namespace App\Handler;

use App\DTO\UpdateUserOpeningDto;
use App\Entity\Opening;
use App\Response\SuccessResponse;
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
        $updateUserOpeningDto = $this->serializer->deserialize(
            $request->getContent(),
            UpdateUserOpeningDto::class,
            'json'
        );

        if ($updateUserOpeningDto->name) {
            $opening->setName($updateUserOpeningDto->name);
        }

        if ($updateUserOpeningDto->moves) {
            $opening->setMoves($updateUserOpeningDto->moves);
        }

        $this->entityManager->flush();

        return new SuccessResponse()
            ->setSuccess(true)
            ->toArray();
    }
}