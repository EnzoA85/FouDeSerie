<?php

namespace App\Controller;

use App\Service\PdoFouDeSerie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    #[Route('/serie', name: 'app_serie')]
    public function show(PdoFouDeSerie $pdoFouDeSerie)
    {
        $lesSeries = $pdoFouDeSerie->getLesSeries();
        $nbSeries = $pdoFouDeSerie->countSeries();
        return $this->render('home/serie.html.twig',['lesSeries'=>$lesSeries,'nbSeries'=>$nbSeries]);
    }

    #[Route('/serie/{id}', name:'app_detailSerie')]
    public function showDetailSerie(PdoFouDeSerie $pdoFouDeSerie,$id)
    {
        $detailSerie = $pdoFouDeSerie->getLaSerie($id);
        return $this->render('serie/detail.html.twig',['detailSerie'=>$detailSerie]);
    }

    #[Route('/serie',name:'app_serieDelete')]
    public function delete(PdoFouDeSerie $pdoFouDeSerie,$id)
    {
        $pdoFouDeSerie->deleteSerie($id);
        $lesSeries = $pdoFouDeSerie->getLesSeries();
        $nbSeries = $pdoFouDeSerie->countSeries();
        return $this->render('home/serie.html.twig',['lesSeries'=>$lesSeries,'nbSeries'=>$nbSeries]);
    }
}
