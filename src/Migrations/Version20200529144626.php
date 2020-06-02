<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529144626 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gas_purchase ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gas_purchase ADD CONSTRAINT FK_2E5B47EC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_2E5B47EC3C6F69F ON gas_purchase (car_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gas_purchase DROP FOREIGN KEY FK_2E5B47EC3C6F69F');
        $this->addSql('DROP INDEX IDX_2E5B47EC3C6F69F ON gas_purchase');
        $this->addSql('ALTER TABLE gas_purchase DROP car_id');
    }
}
