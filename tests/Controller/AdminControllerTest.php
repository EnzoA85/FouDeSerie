<?php
namespace App\Tests\Controller;

use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AdminControllerTest extends WebTestCase
{
  

    public function testAddSerie(){

        $client = static::createClient();
        //récuperation du nombre de séries avant l'ajout
        $nb1 = self::getContainer()->get(SerieRepository::class)->count([]);
        dump("nbseries", $nb1);
        //récupération du crawler qui liste les séries (ds la page dans laquelle on est redirigé)
        //récupération du nombre de p avec Test Titre modif1 avant l'ajout
        $crawlerListe=$client->request('GET','/admin/series/all');
        $nbPAvant=$crawlerListe->filter('h4:contains("TEST TITRE MODIF1")')->count();

        $crawler=$client->request('GET', '/admin/series');
        $form = $crawler->selectButton('add')->form();
        // Les contrôles graphiques du formulaire ont été automatiquement générées par symfony grâce à twig. Il est donc utile d'aller voir le code source pour trouver le nom des contrôles graphiques
        $form['serie[titre]']='Test Titre modif1';
        $form['serie[resume]']='Test resume modif1';
        $client->submit($form);
        // on s'attend à ce qu'il y ait une redirection vers la page /admin/series
        $this->assertResponseRedirects('/serie');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND); 
        //on demande à suivre la redirection et on récupère le nouveau crawler correspondant à la nouvelle page
        $crawler= $client->followRedirect();
        // on s'attend qu'il y ait une balise p supplémentaire par rapport au départ avec le titre
        $this->assertEquals($nbPAvant+1, $crawler->filter('h4:contains("TEST TITRE MODIF1")')->count());
        $nb2 = self::getContainer()->get(SerieRepository::class)->count([]);
        dump("nbseriesApres", $nb2);
        $this->assertEquals($nb1+1, $nb2);
        } 
 


}
