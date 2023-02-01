<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $response = $this->forward('App\Controller\MediasController::mediaFilm');
        $dataFilms = json_decode($response->getContent(), true);
        $dataFilms = $dataFilms['data'];

        $response = $this->forward('App\Controller\MediasController::mediaSerie');
        $dataSeries = json_decode($response->getContent(), true);
        $dataSeries = $dataSeries['data'];

        return $this->render('home/index.html.twig', [
            'films' => $dataFilms,
            'series' => $dataSeries
        ]);
    }
}
