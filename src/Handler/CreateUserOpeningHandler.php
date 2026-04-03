<?php

namespace App\Handler;

use App\DTO\CreateUserOpeningDto;
use App\Entity\Opening;
use App\Response\ValidationErrorFormatter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateUserOpeningHandler
{
    public function __construct(
        private Security $security,
        private SerializerInterface $serializer,
        private ValidatorInterface $validator,
        private EntityManagerInterface $entityManager
    ) {
    }

    public function __invoke(Request $request): array
    {
        $createUserOpeningDto = $this->serializer->deserialize(
            $request->getContent(), 
            CreateUserOpeningDto::class, 
            'json'
        );

        $errors = $this->validator->validate($createUserOpeningDto);

        $formattedErrors = ValidationErrorFormatter::mapErrors($errors);

        if ($formattedErrors) {
            return $formattedErrors;
        }

        $opening = new Opening()
            ->setName($createUserOpeningDto->name)
            ->setMoves($createUserOpeningDto->moves)
            ->setUser($this->security->getUser());

        $this->entityManager->persist($opening);
        $this->entityManager->flush();

        return ['success' => true];
    }
}