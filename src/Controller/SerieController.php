<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Service\PdoFouDeSerie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    /*#[Route('/serie', name: 'app_serie')]
    public function show(PdoFouDeSerie $pdoFouDeSerie)
    {
        $lesSeries = $pdoFouDeSerie->getLesSeries();
        $nbSeries = $pdoFouDeSerie->countSeries();
        return $this->render('home/serie.html.twig',['lesSeries'=>$lesSeries,'nbSeries'=>$nbSeries]);
    }*/

    #[Route('/serie', name: 'app_serie')]
    public function show(ManagerRegistry $doctrine)
    {
        $lesSeries = $doctrine->getRepository(Serie::class)->findBy([],['titre'=>'ASC']);
        return $this->render('serie/serie.html.twig',['lesSeries'=>$lesSeries]);
    }

    /*#[Route('/serie/{id}', name:'app_detailSerie')]
    public function showDetailSerie(PdoFouDeSerie $pdoFouDeSerie,$id)
    {
        $detailSerie = $pdoFouDeSerie->getLaSerie($id);
        return $this->render('serie/detail.html.twig',['detailSerie'=>$detailSerie]);
    }*/

    #[Route('/serie/{id}', name:'app_detailSerie')]
    public function showDetailSerie(ManagerRegistry $doctrine,$id)
    {
        $detailSerie = $doctrine->getRepository(Serie::class)->find($id);
        return $this->render('serie/detail.html.twig',['detailSerie'=>$detailSerie]);
    }

    #[Route('/serie',name:'app_serieDelete')]
    public function delete(PdoFouDeSerie $pdoFouDeSerie,$id)
    {
        $lesSeries = $pdoFouDeSerie->getLesSeries();
        $nbSeries = $pdoFouDeSerie->countSeries();
        return $this->render('home/serie.html.twig',['lesSeries'=>$lesSeries,'nbSeries'=>$nbSeries]);
    }

    #[Route('serie/{id}/like', name:'app_addLike')]
    public function getLikeOneSerie(ManagerRegistry $doctrine,$id)
    {
        $repository = $doctrine->getRepository(Serie::class)->find($id);
        $nbLike = $repository->getLikes();
        $repository->setLikes($nbLike+1);
        $entityManager = $doctrine->getManager();
        $entityManager->persist($repository);
        $entityManager->flush();
        $nbLike = $repository->getLikes();
        $tabLike = ['idSerie'=>$id,'nbLike'=>$nbLike];
        return new JsonResponse($tabLike);
    }
}