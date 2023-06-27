<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230627081543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe_prof (classe_id INT NOT NULL, prof_id INT NOT NULL, INDEX IDX_45A9055D8F5EA509 (classe_id), INDEX IDX_45A9055DABC1F7FE (prof_id), PRIMARY KEY(classe_id, prof_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, naissance DATE NOT NULL, INDEX IDX_ECA105F78F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve_interro (eleve_id INT NOT NULL, interro_id INT NOT NULL, INDEX IDX_CADD19C3A6CC7B2 (eleve_id), INDEX IDX_CADD19C394F005C0 (interro_id), PRIMARY KEY(eleve_id, interro_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interro (id INT AUTO_INCREMENT NOT NULL, matiere_id INT NOT NULL, libelle_interro VARCHAR(255) NOT NULL, note NUMERIC(4, 2) NOT NULL, coefficient NUMERIC(3, 2) NOT NULL, INDEX IDX_266722DFF46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interro_eleve (interro_id INT NOT NULL, eleve_id INT NOT NULL, INDEX IDX_A4C1CE1D94F005C0 (interro_id), INDEX IDX_A4C1CE1DA6CC7B2 (eleve_id), PRIMARY KEY(interro_id, eleve_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere_interro (matiere_id INT NOT NULL, interro_id INT NOT NULL, INDEX IDX_4541AD23F46CD258 (matiere_id), INDEX IDX_4541AD2394F005C0 (interro_id), PRIMARY KEY(matiere_id, interro_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere_prof (matiere_id INT NOT NULL, prof_id INT NOT NULL, INDEX IDX_2868F6E5F46CD258 (matiere_id), INDEX IDX_2868F6E5ABC1F7FE (prof_id), PRIMARY KEY(matiere_id, prof_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prof (id INT AUTO_INCREMENT NOT NULL, nom_prof VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prof_classe (prof_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_199FD698ABC1F7FE (prof_id), INDEX IDX_199FD6988F5EA509 (classe_id), PRIMARY KEY(prof_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prof_matiere (prof_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_773A6224ABC1F7FE (prof_id), INDEX IDX_773A6224F46CD258 (matiere_id), PRIMARY KEY(prof_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe_prof ADD CONSTRAINT FK_45A9055D8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe_prof ADD CONSTRAINT FK_45A9055DABC1F7FE FOREIGN KEY (prof_id) REFERENCES prof (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F78F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE eleve_interro ADD CONSTRAINT FK_CADD19C3A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_interro ADD CONSTRAINT FK_CADD19C394F005C0 FOREIGN KEY (interro_id) REFERENCES interro (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE interro ADD CONSTRAINT FK_266722DFF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE interro_eleve ADD CONSTRAINT FK_A4C1CE1D94F005C0 FOREIGN KEY (interro_id) REFERENCES interro (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE interro_eleve ADD CONSTRAINT FK_A4C1CE1DA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matiere_interro ADD CONSTRAINT FK_4541AD23F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matiere_interro ADD CONSTRAINT FK_4541AD2394F005C0 FOREIGN KEY (interro_id) REFERENCES interro (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matiere_prof ADD CONSTRAINT FK_2868F6E5F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matiere_prof ADD CONSTRAINT FK_2868F6E5ABC1F7FE FOREIGN KEY (prof_id) REFERENCES prof (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_classe ADD CONSTRAINT FK_199FD698ABC1F7FE FOREIGN KEY (prof_id) REFERENCES prof (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_classe ADD CONSTRAINT FK_199FD6988F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_matiere ADD CONSTRAINT FK_773A6224ABC1F7FE FOREIGN KEY (prof_id) REFERENCES prof (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_matiere ADD CONSTRAINT FK_773A6224F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe_prof DROP FOREIGN KEY FK_45A9055D8F5EA509');
        $this->addSql('ALTER TABLE classe_prof DROP FOREIGN KEY FK_45A9055DABC1F7FE');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F78F5EA509');
        $this->addSql('ALTER TABLE eleve_interro DROP FOREIGN KEY FK_CADD19C3A6CC7B2');
        $this->addSql('ALTER TABLE eleve_interro DROP FOREIGN KEY FK_CADD19C394F005C0');
        $this->addSql('ALTER TABLE interro DROP FOREIGN KEY FK_266722DFF46CD258');
        $this->addSql('ALTER TABLE interro_eleve DROP FOREIGN KEY FK_A4C1CE1D94F005C0');
        $this->addSql('ALTER TABLE interro_eleve DROP FOREIGN KEY FK_A4C1CE1DA6CC7B2');
        $this->addSql('ALTER TABLE matiere_interro DROP FOREIGN KEY FK_4541AD23F46CD258');
        $this->addSql('ALTER TABLE matiere_interro DROP FOREIGN KEY FK_4541AD2394F005C0');
        $this->addSql('ALTER TABLE matiere_prof DROP FOREIGN KEY FK_2868F6E5F46CD258');
        $this->addSql('ALTER TABLE matiere_prof DROP FOREIGN KEY FK_2868F6E5ABC1F7FE');
        $this->addSql('ALTER TABLE prof_classe DROP FOREIGN KEY FK_199FD698ABC1F7FE');
        $this->addSql('ALTER TABLE prof_classe DROP FOREIGN KEY FK_199FD6988F5EA509');
        $this->addSql('ALTER TABLE prof_matiere DROP FOREIGN KEY FK_773A6224ABC1F7FE');
        $this->addSql('ALTER TABLE prof_matiere DROP FOREIGN KEY FK_773A6224F46CD258');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE classe_prof');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE eleve_interro');
        $this->addSql('DROP TABLE interro');
        $this->addSql('DROP TABLE interro_eleve');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE matiere_interro');
        $this->addSql('DROP TABLE matiere_prof');
        $this->addSql('DROP TABLE prof');
        $this->addSql('DROP TABLE prof_classe');
        $this->addSql('DROP TABLE prof_matiere');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
