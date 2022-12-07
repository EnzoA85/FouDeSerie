<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class GenreController extends AbstractController
{
    #[Route('/testGenre/{id}', name: 'app_testGenre')]
    public function testGenre(ManagerRegistry $doctrine,$id)
    {
        $genre = new Genre();
        if($doctrine->getRepository(Genre::class)->findBy(["libelle" => $genre->getLibelle('Drame')])!= null)
        {
            $genre->setLibelle('Drame');
            $entityManager = $doctrine->getManager();
            $serie = $doctrine->getRepository(Serie::class)->find($id);
            $serie->addGenre($genre);
            $entityManager->persist($genre);
            $entityManager->flush();
            return $this->render('genre/addGenre.html.twig',['serie'=>$serie]);
        }
        $entityManager = $doctrine->getManager();
        $serie = $doctrine->getRepository(Serie::class)->find($id);
        $serie->addGenre($genre);
        $entityManager->persist($genre);
        $entityManager->flush();
        return $this->render('genre/addGenre.html.twig',['serie'=>$serie]);
    }
}
