<?php

namespace App\Tests\Entity;

use App\Entity\Matiere;
use App\Entity\Prof;
use PHPUnit\Framework\TestCase;

class MatiereTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $matiere = new Matiere();

        $matiere->setNom('Mathématiques');
        $this->assertSame('Mathématiques', $matiere->getNom());

        $this->assertNull($matiere->getId());

        $prof1 = new Prof();
        $prof2 = new Prof();

        $matiere->addProf($prof1);
        $matiere->addProf($prof2);

        $this->assertCount(2, $matiere->getProf());
        $this->assertTrue($matiere->getProf()->contains($prof1));
        $this->assertTrue($matiere->getProf()->contains($prof2));

        $matiere->removeProf($prof1);

        $this->assertCount(1, $matiere->getProf());
        $this->assertFalse($matiere->getProf()->contains($prof1));
        $this->assertTrue($matiere->getProf()->contains($prof2));
    }

    public function testToString(): void
    {
        $matiere = new Matiere();
        $matiere->setNom('Histoire');

        $this->assertSame('Histoire', (string) $matiere);
    }
}
