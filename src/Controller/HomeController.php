<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Serie;
use App\Service\PdoFouDeSerie;
use Doctrine\Persistence\ManagerRegistry;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

class HomeController extends AbstractController
{
    #[Route('', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig',);
    }

    #[Route('/news', name: 'app_news')]
    public function new(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Serie::class);
        $lesSeriesRecentes = $repository->find4Serie();
        return $this->render('home/news.html.twig',['lesSeriesRecentes'=>$lesSeriesRecentes]);
    }

    #[Route('/testEntity',name:'app_testEntity')]
    public function testEntity(ManagerRegistry $doctrine)
    {
        $serie = new Serie();
        $serie->setTitre('testEntity');
        $serie->setResume('Resume du testEntity');
        $serie->setPremiereDiffusion(new \DateTime("20-01-2020"));
        $serie->setDuree(new \DateTime("00:30:25"));
        $serie->setImage("http://img.over-blog-kiwi.com/1/97/82/35/20181020/ob_eac3b5_cartebro.jpg");
        $entityManager = $doctrine->getManager();
        $entityManager->persist($serie);
        $entityManager->flush();
        return $this->render('home/testEntity.html.twig',['laSerie'=>$serie]);
    }
}