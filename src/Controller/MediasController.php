<?php

namespace App\Controller;

use App\Entity\Medias;
use App\Form\MediasType;
use App\Repository\MediasRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MediasController extends AbstractController
{
    #[Route('/medias/create', name: 'app_medias_create')]
    public function index(Request $request, ManagerRegistry $em): Response
    {
        $form = $this->createForm(MediasType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medias = new Medias();
            $medias = $form->getData();
            $em= $em->getManager();
            $em->persist($medias);
            $em->flush();
            $this->addFlash('success', 'Le média a bien été ajouté');
            

            return $this->json([
                'code' => 201,
                'message' => 'Le média a bien été ajouté',
            ], Response::HTTP_CREATED );
            
        }


        return $this->render('medias/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/medias/list', name: 'app_medias_list')]
    public function mediaList(MediasRepository $mediasRepository): Response
    {   
        $medias = [];
        foreach ($mediasRepository->findAll() as $media) {
            $medias[] = $media->getInfos();
        }


        return $this->json([
            'code' => 200,
            'message' => 'Voici la liste des médias',
            'data' => $medias
        ], Response::HTTP_OK );
    }

    #[Route('/medias/film', name: 'app_medias_film')]
    public function mediaFilm(MediasRepository $mediasRepository): Response
    {   
        $medias = [];
        foreach ($mediasRepository->findBy(['type' => 'Film']) as $media) {
            $medias[] = $media->getInfos();
        }
        
        return $this->json([
            'code' => 200,
            'message' => 'Voici la liste des films',
            'data' => $medias
        ], Response::HTTP_OK );
    }

    #[Route('/medias/serie', name: 'app_medias_serie')]
    public function mediaSerie(MediasRepository $mediasRepository): Response
    {   
        $medias = [];
        foreach ($mediasRepository->findBy(['type' => 'Serie']) as $media) {
            $medias[] = $media->getInfos();
        }
        
        return $this->json([
            'code' => 200,
            'message' => 'Voici la liste des séries',
            'data' => $medias
        ], Response::HTTP_OK );
    }



    #[Route('/medias/details/{id}', name: 'app_medias_details')]
    public function mediaDetails(MediasRepository $mediasRepository, $id): Response
    {

        $media = $mediasRepository->findOneBy(['id' => $id]);
        $media = $media->getInfos();

        return $this->render('medias/details.html.twig', [
            'media' => $media
        ]);
        
    }

    #[Route('/medias/delete/{id}', name: 'app_medias_delete')]
    public function deleteMedia(MediasRepository $mediasRepository, $id, ManagerRegistry $em): Response
    {
        $media = $mediasRepository->findOneBy(['id' => $id]);
        $em = $em->getManager();
        $em->remove($media);
        $em->flush();
        return $this->json([
            'code' => 200,
            'message' => 'Le média a bien été supprimé',
        ], Response::HTTP_OK );
    }

}
