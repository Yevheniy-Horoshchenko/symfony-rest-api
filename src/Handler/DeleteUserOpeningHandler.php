<?php

namespace App\Handler;

use App\Entity\Opening;
use App\Response\SuccessResponse;
use Doctrine\ORM\EntityManagerInterface;

class DeleteUserOpeningHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {  
    }

    public function __invoke(Opening $opening): array
    {
        $this->entityManager->remove($opening);
        $this->entityManager->flush();

        return new SuccessResponse()
            ->setSuccess(true)
            ->toArray();
    }
}