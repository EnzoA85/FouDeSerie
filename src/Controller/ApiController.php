<?php

namespace App\Controller;

use App\Service\PdoFouDeSerie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{

    #[Route('/api/series', name: 'app_apiSerie',methods:['GET'])]
    public function getListeSeries(PdoFouDeSerie $pdoFouDeSerie)
    {
        $listeSeries = $pdoFouDeSerie->getLesSeries();
        if($listeSeries!=null)
        {
            $tableauSeries=[];
            foreach($listeSeries as $uneSerie)
            {
                $tableauSeries[]=['id'=>$uneSerie['id'],'titre'=>$uneSerie['titre'],'resume'=>$uneSerie['resume'],'duree'=>$uneSerie['duree'],'premiereDiffusion'=>$uneSerie['premiereDiffusion'],'image'=>$uneSerie['image'],];
            }
            return new JsonResponse($tableauSeries);
        }
        else
        {
            return new JsonResponse(['message'=>'Serie not found'], Response::HTTP_NOT_FOUND);
        }
    }

    #[Route('/api/series/{id}', name:'app_apiUneSerie',methods:['GET'])]
    public function getLaSerie(PdoFouDeSerie $pdoFouDeSerie,$id)
    {
        $laSerie = $pdoFouDeSerie->getLaSerie($id);
        if($laSerie!=null)
        {
            $tableauLaSerie=[];
            $tableauLaSerie[]=['id'=>$laSerie['id'],'titre'=>$laSerie['titre'],'resume'=>$laSerie['resume'],'duree'=>$laSerie['duree'],'premiereDiffusion'=>$laSerie['premiereDiffusion'],'image'=>$laSerie['image'],];
            return new JsonResponse($tableauLaSerie);
        }
        else
        {
            return new JsonResponse(['message'=>'Serie not found'], Response::HTTP_NOT_FOUND);
        }
    }

    #[Route('/api/series', name:'app_addUneSerie',methods:['POST'])]
    public function newSerie(Request $request, PdoFouDeSerie $pdoFouDeSerie)
    {
        $reponse = $pdoFouDeSerie->setLaSerie(json_decode($request->getContent(),true));
        return new JsonResponse(['message'=>'Serie a été ajouté','id'=>$reponse['id'] ,'titre'=>$reponse['titre'], 'resume'=>$reponse['resume'], 'duree'=>$reponse['duree'], 'premiereDiffusion'=>$reponse['premiereDiffusion'], 'image'=>$reponse['image']], Response::HTTP_CREATED);
    }

    #[Route('/api/series/{id}', name:'app_deleteUneSerie',methods:['DELETE'])]
    public function deleteSerie($id, PdoFouDeSerie $pdoFouDeSerie)
    {
        if($pdoFouDeSerie->getLaSerie($id)!=null)
        {
            $pdoFouDeSerie->deleteSerie($id);
            return new JsonResponse(['message'=>'Serie as deleted'], Response::HTTP_ACCEPTED);
        }
        else
        {
            return new JsonResponse(['message'=>'Serie not found'], Response::HTTP_NOT_FOUND);
        }
    }

    #[Route('/api/series/{id}', name:'app_editUneSerie',methods:['PUT'])]
    public function editSerie($id, PdoFouDeSerie $pdoFouDeSerie, Request $request)
    {
        if($pdoFouDeSerie->getLaSerie($id)!=null)
        {
            $laSerie = $pdoFouDeSerie->getLaSerie($id);
            $pdoFouDeSerie->updateSerieComplete($laSerie, $id, json_decode($request->getContent(),true));
            return new JsonResponse(['message'=>'Serie as modified'], Response::HTTP_ACCEPTED);
        }
        else
        {
            return new JsonResponse(['message'=>'Serie not found'], Response::HTTP_NOT_FOUND);
        }
    }
}
