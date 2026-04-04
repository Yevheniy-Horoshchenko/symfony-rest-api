<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class LoginController extends AbstractController
{
    #[Route(path: '/api/login', name: 'api_login', methods: [Request::METHOD_POST])]
    public function index(): JsonResponse
    {
        return $this->json([]);
    }
}