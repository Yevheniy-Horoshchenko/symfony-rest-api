<?php

namespace App\Handler;

use App\DTO\RegisterUserDto;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Response\ValidationErrorFormatter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterUserHandler
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface $validator,
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $enitityManager,
        private UserRepository $userRepository
    ) {
    }

    public function __invoke(Request $request): array
    {
        try {
            $registerUserDto = $this->serializer->deserialize(
                $request->getContent(),
                RegisterUserDto::class,
                'json'
            );
        } catch (\Throwable $e) {
            return ValidationErrorFormatter::mapErrors(
                message: 'Invalid JSON body'
            );
        }

        $errors = $this->validator->validate($registerUserDto);
    
        $formattedErrors = ValidationErrorFormatter::mapErrors($errors);

        if ($formattedErrors) {
            return $formattedErrors;
        }

        $user = $this->userRepository->findOneBy(['email' => $registerUserDto->email]);

        if ($user) {
            return ValidationErrorFormatter::mapErrors(
                message: 'User with this email already exists'
            );
        }

        $user = new User();

        $hashedPassword = $this->passwordHasher->hashPassword($user, $registerUserDto->password);

        $user->setEmail($registerUserDto->email)
            ->setPassword($hashedPassword);

        $this->enitityManager->persist($user);
        $this->enitityManager->flush();

        return ['success' => true];
    }
}