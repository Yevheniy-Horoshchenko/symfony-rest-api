<?php

namespace App\Controller;

use App\Entity\Opening;
use App\Handler\CreateUserOpeningHandler;
use App\Handler\GetUserOpeningsHandler;
use App\Handler\UpdateUserOpeningHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/my-openings')]
class UserOpeningController extends AbstractController
{
    #[Route(path: '', name: 'get_api_openings', methods: [Request::METHOD_GET])]
    public function getUserOpenings(GetUserOpeningsHandler $getUserOpeningsHandler): JsonResponse
    {
        return $this->json($getUserOpeningsHandler());
    }

    #[Route(path: '', name: 'create_api_opening', methods: [Request::METHOD_POST])]
    public function createUserOpening(
        Request $request,
        CreateUserOpeningHandler $createUserOpeningHandler
    ): JsonResponse {
        return $this->json($createUserOpeningHandler($request));
    }

    #[Route(path: '/{opening}', name: 'update_api_opening', methods: [Request::METHOD_PATCH])]
    public function updateUserOpening(
        Request $request,
        Opening $opening,
        UpdateUserOpeningHandler $updateUserOpeningHandler
    ): JsonResponse {
        return $this->json($updateUserOpeningHandler($request, $opening));
    }
}