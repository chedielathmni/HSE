<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529135417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transporter ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transporter ADD CONSTRAINT FK_A036E2D4C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A036E2D4C3C6F69F ON transporter (car_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transporter DROP FOREIGN KEY FK_A036E2D4C3C6F69F');
        $this->addSql('DROP INDEX UNIQ_A036E2D4C3C6F69F ON transporter');
        $this->addSql('ALTER TABLE transporter DROP car_id');
    }
}
