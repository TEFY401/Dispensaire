<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210426054101 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicament ADD reference VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723AB4B1C397 FOREIGN KEY (maladie_id) REFERENCES maladie (id)');
        $this->addSql('CREATE INDEX IDX_9A9C723AB4B1C397 ON medicament (maladie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723AB4B1C397');
        $this->addSql('DROP INDEX IDX_9A9C723AB4B1C397 ON medicament');
        $this->addSql('ALTER TABLE medicament DROP reference');
    }
}
