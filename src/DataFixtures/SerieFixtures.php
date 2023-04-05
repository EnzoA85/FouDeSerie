<?php
namespace App\DataFixtures;

use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class SerieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //  for ($i=0;$i<5;$i++){
        //     $uneSerie= new Serie();
        //     $uneSerie->setTitre("titre$i");
        //     $uneSerie->setResume("resume$i");
        //     $uneSerie->setImage("image$i");
        //     $uneSerie->setLikes(0);
        //     $manager->persist($uneSerie);
        //     $manager->flush();
		//  }

        //choix de la langue des données
        $faker = Faker\Factory::create('fr_FR');
        //on créé 10 séries
        for ($i=0;$i<10;$i++) {
            $uneSerie=new Serie();
            $uneSerie->setTitre($faker->sentence(3,true));
            //valoriser les autres propriétés en utilisant la documentation
            $uneSerie->setResume($faker->sentence(20,true));
            $uneSerie->setImage($faker->imageUrl(640, 480, 'animals', true));
            $uneSerie->setLikes(0);
            $uneSerie->setPremiereDiffusion($faker->dateTime());
            $manager->persist($uneSerie);
            $manager->flush();
        }
    }
}