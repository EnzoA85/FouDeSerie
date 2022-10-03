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
        $req = PdoFouDeSerie::$monPdo->prepare("SELECT * FROM serie where id=$id");
        $req->execute();
        return $req->fetch();
    }
}
