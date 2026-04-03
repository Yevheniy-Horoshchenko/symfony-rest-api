<?php

namespace App\Handler;

use App\Repository\OpeningRepository;

class GetOpeningsHandler
{
    public function __construct(
        protected OpeningRepository $openingRepository
    ) {
    }

    public function __invoke(): array
    {
        return $this->openingRepository->findAll();
    }
}