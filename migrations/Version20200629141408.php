<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200629141408 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ville ADD code_des_id INT NOT NULL');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3EC795F20 FOREIGN KEY (code_des_id) REFERENCES destination (id)');
        $this->addSql('CREATE INDEX IDX_43C3D9C3EC795F20 ON ville (code_des_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3EC795F20');
        $this->addSql('DROP INDEX IDX_43C3D9C3EC795F20 ON ville');
        $this->addSql('ALTER TABLE ville DROP code_des_id');
    }
}
