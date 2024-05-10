<?php

namespace App\Controller;

use App\Repository\GenreRepository;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MoviesController extends AbstractController
{
    public function __construct(
        private MovieRepository $movieRepository,
        private SerializerInterface $serializer,
        private GenreRepository $genreRepository,

    ) {
    }

    #[Route('/movies', methods: ['GET'])]
    public function list(Request $request): JsonResponse
    {
        // ottendo parametro orderBy dalla richiesta GET
        $orderBy = $request->query->get('orderBy');

        // ottengo parametro genre dalla richiesta GET 
        $genre = $request->query->get('genre');

        // verifica se genre è specificato
        if ($genre) {
            // ottengo elenco film con il genere specificato 
            $movies = $this->genreRepository->getMoviesByGenre($genre, $orderBy);
        } else {
            // altrimenti, elenco tutti i film senza ordinamento
            $movies = $this->movieRepository->findAll($orderBy);
        }

        // serializzare i dati dei film in formato JSON
        $data = $this->serializer->serialize($movies, 'json', ['groups' => 'default']);
        // restituisce risposta JSON
        return new JsonResponse($data, json: true);
    }
}
