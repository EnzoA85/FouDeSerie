<?php

namespace app\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\SerieRepository;
use phpDocumentor\Reflection\PseudoTypes\False_;

class SerieRepositoryTest extends KernelTestCase
{
    // Test qu'il y a bien X série dans la BDD

    // public function testCountSerie()
    // {
    //     self::bootKernel();
    //     $nb = self::getContainer()->get(SerieRepository::class)->count([]);
    //     $this->assertEquals(10, $nb);
    // }


    // Test si une série a moins de 1 an (true = moins de 1 an sinon false)

    // public function testIsNewSerie()
    // {
    //     self::bootKernel();
    //     $repository = self::getContainer()->get(SerieRepository::class);
    //     $Serie = $repository->findOneBy(['id'=> 36])->isNewSerie();
    //     $this->assertEquals(true, $Serie);
    // }

    
    
}