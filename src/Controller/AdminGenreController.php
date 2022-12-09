<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Form\GenreType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminGenreController extends AbstractController
{
    #[Route('/admin/genre', name: 'app_admin_addGenre')]
    public function addSerie(ManagerRegistry $doctrine, Request $request)
    {
        $lesGenres = $doctrine->getRepository(Genre::class)->findAll();
        $genre = new Genre();
        $entityManager = $doctrine->getManager();
        $form=$this->createForm(GenreType::class,$genre);
        $form->handleRequest($request);
        $a = 1;
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($genre);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_addGenre');
        }
        return $this->render('admin_genre/addGenre.html.twig', [
            'form'=>$form->createView(),'lesGenres'=>$lesGenres, 'a'=>$a,
        ]);
    }

    #[Route('/admin/genre/{id}', name:'app_admin_editGenre')]
    public function modifySerie($id,ManagerRegistry $doctrine, Request $request)
    {
        $lesGenres = $doctrine->getRepository(Genre::class)->findAll();
        $genre = $doctrine->getRepository(Genre::class)->find($id);
        $entityManager = $doctrine->getManager();
        $form=$this->createForm(GenreType::class,$genre, ['method'=> 'PUT']);
        $form->handleRequest($request);
        $a = 0;
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($genre);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_addGenre');
        }
        return $this->render('admin_genre/addGenre.html.twig', [
            'form'=>$form->createView(),'lesGenres'=>$lesGenres, 'a'=>$a,
        ]);
    }
}
