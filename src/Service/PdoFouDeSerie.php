<?php

namespace App\Service;

use PDO;

class PdoFouDeSerie
{
    private static $monPdo;
    public function __construct($serveur, $bdd, $user, $mdp)
    {
        PdoFouDeSerie::$monPdo = new PDO(
            $serveur . ';' . $bdd,
            $user,
            $mdp
        );
        PdoFouDeSerie::$monPdo->query("SET CHARACTER SET utf8");
    }

    function getLesSeries()
    {
        $req =PdoFouDeSerie::$monPdo-> prepare("SELECT id,titre as titre,duree,resume,DATE_FORMAT(premiereDiffusion,'%d/%m/%Y') as premiereDiffusion,image FROM serie ORDER BY duree");
        $req->execute();
        return $req->fetchAll();
    }

    function countSeries()
    {
        $req = PdoFouDeSerie::$monPdo->prepare("SELECT COUNT(*) AS nbSerie FROM serie ");
        $req->execute();
        return $req->fetch();
    }

    function getLaSerie($id)
    {
        $req = PdoFouDeSerie::$monPdo->prepare("SELECT * FROM serie where id=:id");
        $req->bindParam(':id',$id, PDO::PARAM_STR);
        $req->execute();
        return $req->fetch();
    }

    function setLaSerie($laSerie)
    {
        $req = PdoFouDeSerie::$monPdo->prepare("INSERT INTO `serie`(`titre`, `resume`, `duree`, `premiereDiffusion`, `image`) VALUES (:titre,:resume,:duree,:premiereDiffusion,:image)");
        /*Check voir si chaque élement existe, sinon remplacer par null dans la BDD*/
        if(isset($laSerie['titre'])){$req->bindValue(':titre',$laSerie['titre'], PDO::PARAM_STR);}else{$req->bindValue(':titre',null, PDO::PARAM_NULL);}
        if(isset($laSerie['resume'])){$req->bindValue(':resume',$laSerie['resume'], PDO::PARAM_STR);}else{$req->bindValue(':resume',null, PDO::PARAM_NULL);}
        if(isset($laSerie['duree'])){$req->bindValue(':duree',$laSerie['duree'], PDO::PARAM_STR);}else{$req->bindValue(':duree',null, PDO::PARAM_NULL);}
        if(isset($laSerie['premiereDiffusion'])){$req->bindValue(':premiereDiffusion',$laSerie['premiereDiffusion'], PDO::PARAM_STR);}else{$req->bindValue(':premiereDiffusion',null, PDO::PARAM_NULL);}
        if(isset($laSerie['image'])){$req->bindValue(':image',$laSerie['image'], PDO::PARAM_STR);}else{$req->bindValue(':image',null, PDO::PARAM_NULL);}
        $req->execute();
        $req= PdoFouDeSerie::$monPdo->prepare("SELECT LAST_INSERT_ID() as id");
        $req->execute();
        $res=$req->fetch();
        $req = "SELECT * from serie where id=".$res['id'];
        $req = PdoFouDeSerie::$monPdo->query($req);
        return $req->fetch();
    }

    function deleteSerie($id)
    {
        $req = PdoFouDeSerie::$monPdo->prepare("DELETE FROM serie WHERE id=:id");
        $req->bindParam(':id',$id, PDO::PARAM_STR);
        $req->execute();
    }

    function updateSerieComplete($laSerie,$id,$json)
    {
        $req = PdoFouDeSerie::$monPdo->prepare("UPDATE `serie` SET `titre`=:titre,`resume`=:resume,`duree`=:duree,`premiereDiffusion`=:premiereDiffusion,`image`=:image WHERE id=:id");
        $req->bindParam(':id',$id, PDO::PARAM_STR);
        if(isset($json['titre'])){$req->bindValue(':titre',$json['titre'],PDO::PARAM_STR);}else{$req->bindValue(':titre',$laSerie['titre'],PDO::PARAM_STR);}
        if(isset($json['resume'])){$req->bindValue(':resume',$json['resume'],PDO::PARAM_STR);}else{$req->bindValue(':resume',$laSerie['resume'],PDO::PARAM_STR);}
        if(isset($json['duree'])){$req->bindValue(':duree',$json['duree'],PDO::PARAM_STR);}else{$req->bindValue(':duree',$laSerie['duree'],PDO::PARAM_STR);}
        if(isset($json['premiereDiffusion'])){$req->bindValue(':premiereDiffusion',$json['premiereDiffusion'],PDO::PARAM_STR);}else{$req->bindValue(':premiereDiffusion',$laSerie['premiereDiffusion'],PDO::PARAM_STR);}
        if(isset($json['image'])){$req->bindValue(':image',$json['image'],PDO::PARAM_STR);}else{$req->bindValue(':image',$laSerie['image'],PDO::PARAM_STR);}
        $req->execute();
    }
}
