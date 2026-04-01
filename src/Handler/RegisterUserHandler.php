<?php

namespace App\Handler;

use App\DTO\RegisterUserDto;
use App\Entity\User;
use App\Response\ValidationErrorFormatter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterUserHandler
{
    public function __construct(
        protected SerializerInterface $serializer,
        protected ValidatorInterface $validator,
        protected UserPasswordHasherInterface $passwordHasher,
        protected EntityManagerInterface $enitityManager
    ) {
    }

    public function __invoke(Request $request): array
    {
        $registrationData = $this->serializer->deserialize($request->getContent(), RegisterUserDto::class, 'json');

        $errors = $this->validator->validate($registrationData);
    
        $formattedErrors = ValidationErrorFormatter::mapErrors($errors);

        if ($formattedErrors) {
            $formattedErrors['success'] = false;
            
            return $formattedErrors;
        }

        $user = new User();

        $hashedPassword = $this->passwordHasher->hashPassword($user, $registrationData->password);

        $user->setEmail($registrationData->email)
            ->setPassword($hashedPassword);

        $this->enitityManager->persist($user);
        $this->enitityManager->flush();

        return ['success' => true];
    }
}