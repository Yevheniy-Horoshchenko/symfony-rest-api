<?php

namespace App\Handler;

use App\Entity\User;
use App\Repository\OpeningRepository;
use App\Response\OpeningResponse;
use Symfony\Bundle\SecurityBundle\Security;

class GetUserOpeningsHandler
{
    public function __construct(
        private Security $security,
        private OpeningRepository $openingRepository
    ) {
    }

    public function __invoke(): array
    {
        /** @var ?User $user */
        $user = $this->security->getUser();
        
        $openings = $this->openingRepository->findBy(['user' => $user]);

        return $openings ? OpeningResponse::collection($openings) : [];
    }
}