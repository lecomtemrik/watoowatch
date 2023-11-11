<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Service\ApiMoviesDatabase;

class HomeController extends AbstractController
{
    public function __construct(
        private HttpClientInterface $client,
    ) {
    }
    #[Route('/', name: 'app_home')]
    public function index(ApiMoviesDatabase $apiMoviesDatabase): Response
    {

        $randomMovies = $apiMoviesDatabase->getRandomMovies("most_pop_movies");

//        var_dump($randomMovies->results);
//        dd();

        return $this->render('home/index.html.twig', [
            'randomMovies' => $randomMovies->results,
        ]);
    }
}
