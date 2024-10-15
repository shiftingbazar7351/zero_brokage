<?php

namespace App\Services;

use GuzzleHttp\Client;

class OlaMapService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://ola.map.api.endpoint/', // Replace with the actual Ola API base URI
            'timeout'  => 5.0,
        ]);
    }

    public function getMapData($parameters)
    {
        $apiKey = env('OLA_MAP_API_KEY');

        // Add API key to the request parameters
        $parameters['api_key'] = $apiKey;

        try {
            $response = $this->client->get('map-endpoint', [ // Replace 'map-endpoint' with actual endpoint
                'query' => $parameters
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // Handle the error appropriately
            return ['error' => $e->getMessage()];
        }
    }
}
