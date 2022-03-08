<?php

namespace App\Service\Api;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiService{
    public function __construct(private HttpClientInterface $client){}

    public function callApiAddress($query)
    {
        try {
            $response = $this->client->request(
                'GET',
                "https://api-adresse.data.gouv.fr/search/?" . http_build_query($query)
            );
        } catch (\Throwable $e) {
            // return $response;
            return $e->getMessage();
        }

        return $response;
    }
}