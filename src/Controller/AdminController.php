<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class AdminController extends AbstractController
{
    #[Route('/admin/series/all', name:'app_admin_listedeleteSerie')]
    public function listeDeleteSerie(ManagerRegistry $doctrine)
    {
        $lesSeries = $doctrine->getRepository(Serie::class)->findBy([],['titre'=>'ASC']);
        return $this->render('admin/delete.html.twig',['lesSeries'=>$lesSeries]);
    }

    #[Route('/admin/series/{id}', name: 'app_admin_deleteSerie', methods : 'delete')]
    public function deleteSerie($id,ManagerRegistry $doctrine,Request $request)
    {
        $valeurDuToken = $request->get('token');
        if($this->isCsrfTokenValid('leToken', $valeurDuToken))
        {
            $uneSerie =$doctrine->getRepository(Serie::class)->find($id);
            $entityManager = $doctrine->getManager();
            $entityManager->remove($uneSerie);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_admin_listedeleteSerie');
    }

    #[Route('/admin/series', name: 'app_admin_addSerie')]
    public function addSerie(ManagerRegistry $doctrine, Request $request)
    {
        $serie = new Serie();
        $entityManager = $doctrine->getManager();
        $form=$this->createForm(SerieType::class,$serie);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $serie->setLikes(0);
            $entityManager->persist($serie);
            $entityManager->flush();
            return $this->redirectToRoute('app_serie');
        }
        return $this->render('admin/addSerie.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

    #[Route('/admin/series/{id}', name:'app_admin_editSerie')]
    public function modifySerie($id,ManagerRegistry $doctrine, Request $request)
    {
        $serie = $doctrine->getRepository(Serie::class)->find($id);
        $entityManager = $doctrine->getManager();
        $form=$this->createForm(SerieType::class,$serie, ['method'=> 'PUT']);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($serie);
            $entityManager->flush();
            return $this->redirectToRoute('app_serieDelete');
        }
        return $this->render('admin/addSerie.html.twig', [
            'form'=>$form->createView(),
        ]);
    }
}
