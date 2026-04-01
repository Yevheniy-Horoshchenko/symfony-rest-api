<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
    #[Route('/', name: 'get_openings', methods: [Request::METHOD_GET])]
    public function getOpenings(): Response
    {
        return new Response('Hello');
    }
}