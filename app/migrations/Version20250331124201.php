<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250331124201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA gigastore');
        $this->addSql('CREATE TABLE gigastore.genre (code VARCHAR(10) NOT NULL, intitule VARCHAR(255) NOT NULL, PRIMARY KEY(code))');
        $this->addSql('CREATE TABLE gigastore.livre (id INT NOT NULL, code_genre VARCHAR(10) NOT NULL, titre VARCHAR(100) NOT NULL, auteur VARCHAR(100) NOT NULL, editeur VARCHAR(100) NOT NULL, collection VARCHAR(100) NOT NULL, annee INT NOT NULL, support VARCHAR(8) NOT NULL, format VARCHAR(15) NOT NULL, description TEXT NOT NULL, pages INT NOT NULL, poids NUMERIC(5, 3) NOT NULL, prix NUMERIC(5, 2) NOT NULL, port NUMERIC(5, 2) NOT NULL, delai_de_livraison INT NOT NULL, photo VARCHAR(50) NOT NULL, nouveaute INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_97B4B31E6F052AB4 ON gigastore.livre (code_genre)');
        $this->addSql('ALTER TABLE gigastore.livre ADD CONSTRAINT FK_97B4B31E6F052AB4 FOREIGN KEY (code_genre) REFERENCES gigastore.genre (code) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SCHEMA demo');
        $this->addSql('ALTER TABLE gigastore.livre DROP CONSTRAINT FK_97B4B31E6F052AB4');
        $this->addSql('DROP TABLE gigastore.genre');
        $this->addSql('DROP TABLE gigastore.livre');
    }
}
