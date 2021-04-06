<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210406053400 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE generaliste ADD temperature VARCHAR(255) NOT NULL, ADD pression_arterielle VARCHAR(255) NOT NULL, ADD gorge VARCHAR(255) NOT NULL, ADD tympans VARCHAR(255) NOT NULL, ADD palpation VARCHAR(255) NOT NULL, ADD auscultation VARCHAR(255) NOT NULL, ADD percussion VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE generaliste DROP temperature, DROP pression_arterielle, DROP gorge, DROP tympans, DROP palpation, DROP auscultation, DROP percussion');
    }
}
