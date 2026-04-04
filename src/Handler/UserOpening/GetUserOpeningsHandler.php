<?php

namespace App\Handler\UserOpening;

use App\Entity\User;
use App\Repository\OpeningRepository;
use App\Response\OpeningResponse;
use App\Response\SuccessResponse;
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

        return new SuccessResponse()
            ->setSuccess(true)
            ->setData(OpeningResponse::collection($openings))
            ->toArray();
    }
}