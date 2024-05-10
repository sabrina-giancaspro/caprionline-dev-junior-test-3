<?php

namespace App\Controller;

use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GenresController extends AbstractController
{
    public function __construct(
        private GenreRepository $genreRepository,
        private SerializerInterface $serializer
    ) {
    }

    #[Route('/genres', methods: ['GET'])]
    public function list(): JsonResponse
    {
        // ottengo i generi dalla repository
        $genres = $this->genreRepository->findAll();
        
        // serializza i dati dei generi in formato Json
        $data = $this->serializer->serialize($genres, "json");
        
        return new JsonResponse($data, json: true);
    }

}
