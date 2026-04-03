<?php

namespace App\Handler;

use App\Entity\Opening;
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

        return ['success' => true];
    }
}