<?php

namespace App\Controller;

use App\Handler\RegisterUserHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route(path: '/register', name: 'registration', methods: [Request::METHOD_POST])]
    public function register(Request $request, RegisterUserHandler $registerUserHandler): JsonResponse
    {
        return $this->json($registerUserHandler($request));
    }
}