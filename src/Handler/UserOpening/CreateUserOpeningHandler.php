<?php

namespace App\Handler\UserOpening;

use App\DTO\CreateUserOpeningDto;
use App\Entity\Opening;
use App\Repository\OpeningRepository;
use App\Response\ErrorResponseFormatter;
use App\Response\SuccessResponse;
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
        private OpeningRepository $openingRepository,
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

        $formattedErrors = ErrorResponseFormatter::form($errors);

        if ($formattedErrors) {
            return $formattedErrors;
        }

        $name = $createUserOpeningDto->name;

        $existOpening = $this->openingRepository->findOneBy(['name' => $name]);

        if ($existOpening) {
            return ErrorResponseFormatter::form(
                message: "Opening with name {$name} already exists"
            );
        }

        $opening = new Opening()
            ->setName($createUserOpeningDto->name)
            ->setMoves($createUserOpeningDto->moves)
            ->setUser($this->security->getUser());

        $this->entityManager->persist($opening);
        $this->entityManager->flush();

        return new SuccessResponse()
            ->setSuccess(true)
            ->toArray();
    }
}