<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250423120059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gigastore.commentaires (id SERIAL NOT NULL, livre_id_id VARCHAR(10) DEFAULT NULL, date_commentaire TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, pseudonyme VARCHAR(30) NOT NULL, titre VARCHAR(50) NOT NULL, commentaire TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EAA01133EC470631 ON gigastore.commentaires (livre_id_id)');
        $this->addSql('ALTER TABLE gigastore.commentaires ADD CONSTRAINT FK_EAA01133EC470631 FOREIGN KEY (livre_id_id) REFERENCES gigastore.livre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SCHEMA demo');
        $this->addSql('ALTER TABLE gigastore.commentaires DROP CONSTRAINT FK_EAA01133EC470631');
        $this->addSql('DROP TABLE gigastore.commentaires');
    }
}
