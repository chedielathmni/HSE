<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200526124116 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gas_purchase ADD driver_id INT NOT NULL');
        $this->addSql('ALTER TABLE gas_purchase ADD CONSTRAINT FK_2E5B47EC3423909 FOREIGN KEY (driver_id) REFERENCES transporter (id)');
        $this->addSql('CREATE INDEX IDX_2E5B47EC3423909 ON gas_purchase (driver_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gas_purchase DROP FOREIGN KEY FK_2E5B47EC3423909');
        $this->addSql('DROP INDEX IDX_2E5B47EC3423909 ON gas_purchase');
        $this->addSql('ALTER TABLE gas_purchase DROP driver_id');
    }
}
