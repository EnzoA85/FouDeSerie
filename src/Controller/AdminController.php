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
    #[Route('/admin/series', name: 'app_admin_addSerie')]
    public function addSerie(ManagerRegistry $doctrine, Request $request)
    {
        $serie = new Serie();
        $entityManager = $doctrine->getManager();
        $form=$this->createForm(SerieType::class,$serie);
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
