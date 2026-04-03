<?php

namespace App\DataFixtures;

use App\Entity\Opening;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OpeningFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $openings = [
            [
                'name' => 'Alekhine',
                'moves' => ['e4', 'Kf6']
            ],
            [
                'name' => 'Benoni',
                'moves' => ['d4', 'Nf6', 'c4', 'c5']
            ],
            [
                'name' => 'Caro-Kann',
                'moves' => ['e4', 'c6']
            ],
            [
                'name' => 'Sicilian',
                'moves' => ['e4', 'c5']
            ]
        ];

        foreach($openings as $data) {
            $opening = new Opening();

            $opening->setName($data['name'])
                ->setMoves($data['moves']);

            $manager->persist($opening);
        }

        $manager->flush();
    }
}
