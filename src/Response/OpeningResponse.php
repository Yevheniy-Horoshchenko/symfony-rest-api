<?php

namespace App\Response;

class OpeningResponse
{
    public static function collection(array $openings): array
    {
        $response = [];

        foreach($openings as $opening) {
            $response[] = [
                $opening->getName(),
                $opening->getMoves()
            ];
        }

        return $response;
    }
}