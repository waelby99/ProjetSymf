<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200629143552 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etape_circuit ADD code_circuit_id INT NOT NULL');
        $this->addSql('ALTER TABLE etape_circuit ADD CONSTRAINT FK_484C507DE78F7F2E FOREIGN KEY (code_circuit_id) REFERENCES circuit (id)');
        $this->addSql('CREATE INDEX IDX_484C507DE78F7F2E ON etape_circuit (code_circuit_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etape_circuit DROP FOREIGN KEY FK_484C507DE78F7F2E');
        $this->addSql('DROP INDEX IDX_484C507DE78F7F2E ON etape_circuit');
        $this->addSql('ALTER TABLE etape_circuit DROP code_circuit_id');
    }
}
