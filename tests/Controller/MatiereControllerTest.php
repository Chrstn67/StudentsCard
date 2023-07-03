<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MatiereControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/matiere');

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h1', 'Liste des matières');
    }
    public function testCreate(): void
    {
        $client = static::createClient();
        $client->request('GET', '/matiere/create');

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h1', 'Créer une matière');
    }
    public function testEdit(): void
    {
        $client = static::createClient();
        $client->request('GET', '/matiere/edit/1'); // Remplacez 1 par l'ID d'une matière existante

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h1', 'Modifier une matière');
    }
    public function testDelete(): void
    {
        $client = static::createClient();
        $client->request('GET', '/matiere/delete/1'); // Remplacez 1 par l'ID d'une matière existante

        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
        $this->assertResponseRedirects('/matiere');
    }
}
