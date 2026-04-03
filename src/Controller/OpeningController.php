<?php

namespace App\Controller;

use App\Handler\GetOpeningsHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class OpeningController extends AbstractController
{
    #[Route(path: '/api/openings', name: 'api_openings', methods: [Request::METHOD_GET])]
    public function getOpenings(GetOpeningsHandler $getOpeningsHandler): JsonResponse
    {
        return $this->json($getOpeningsHandler());
    }
}