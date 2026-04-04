<?php

namespace App\Handler;

use App\Repository\OpeningRepository;
use App\Response\OpeningResponse;
use App\Response\SuccessResponse;

class GetOpeningsHandler
{
    public function __construct(
        protected OpeningRepository $openingRepository
    ) {
    }

    public function __invoke(): array
    {
        $openings = $this->openingRepository->findBy(['user' => null]);

        return new SuccessResponse()
            ->setSuccess(true)
            ->setData(OpeningResponse::collection($openings))
            ->toArray();
    }
}