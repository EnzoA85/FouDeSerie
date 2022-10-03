<?php

namespace App\Controller;

use App\Service\PdoFouDeSerie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{

    #[Route('/api/series', name: 'app_apiSerie')]
    public function getListeSeries(PdoFouDeSerie $pdoFouDeSerie)
    {
        $listeSeries = $pdoFouDeSerie->getLesSeries();
        $tableauSeries=[];
        foreach($listeSeries as $uneSerie)
        {
            $tableauSeries[]=['id'=>$uneSerie['id'],'titre'=>$uneSerie['titre'],'resume'=>$uneSerie['resume'],'duree'=>$uneSerie['duree'],'premiereDiffusion'=>$uneSerie['premiereDiffusion'],'image'=>$uneSerie['image'],];
        }
        return new JsonResponse($tableauSeries);
    }

    #[Route('/api/series/{id}', name:'app_apiUneSerie')]
    public function getLaSerie(PdoFouDeSerie $pdoFouDeSerie,$id)
    {
        $laSerie = $pdoFouDeSerie->getLaSerie($id);
        $tableauLaSerie=[];
        $tableauLaSerie[]=['id'=>$laSerie['id'],'titre'=>$laSerie['titre'],'resume'=>$laSerie['resume'],'duree'=>$laSerie['duree'],'premiereDiffusion'=>$laSerie['premiereDiffusion'],'image'=>$laSerie['image'],];
        return new JsonResponse($tableauLaSerie);
    }
}
