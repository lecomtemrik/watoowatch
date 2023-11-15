<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiMoviesDatabase
{
    private $apiMoviesRandomBase;
    public function __construct(private HttpClientInterface $client, string $apiMoviesRandomBase) {
        $this->apiMoviesRandomBase = $apiMoviesRandomBase;
    }

    public function getRandomMovies()
    {
        //https://rapidapi.com/movie-of-the-night-movie-of-the-night-default/api/streaming-availability
        $response = $this->client->request(
            'GET',
//            $this->apiMoviesRandomBase.'?limit=5&year=2022&list='.$list
            $this->apiMoviesRandomBase.'?change_type=new&services=netflix&target_type=series&country=fr&output_language=fr'
            , [
                'headers' => [
                    'X-RapidAPI-Key' => $_ENV['RAPIDAPI_KEY'],
                    'X-RapidAPI-Host' => $_ENV['RAPIDAPI_HOST']
                ]
            ]
        );

        $content = json_decode($response->getContent());

        return $content;
    }
}
