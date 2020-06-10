<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200609225345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE working_zone (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE working_zone_product (working_zone_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_99A50E93415C9DEB (working_zone_id), INDEX IDX_99A50E934584665A (product_id), PRIMARY KEY(working_zone_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE working_zone_product ADD CONSTRAINT FK_99A50E93415C9DEB FOREIGN KEY (working_zone_id) REFERENCES working_zone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE working_zone_product ADD CONSTRAINT FK_99A50E934584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD working_zone_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649415C9DEB FOREIGN KEY (working_zone_id) REFERENCES working_zone (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649415C9DEB ON user (working_zone_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649415C9DEB');
        $this->addSql('ALTER TABLE working_zone_product DROP FOREIGN KEY FK_99A50E93415C9DEB');
        $this->addSql('DROP TABLE working_zone');
        $this->addSql('DROP TABLE working_zone_product');
        $this->addSql('DROP INDEX IDX_8D93D649415C9DEB ON user');
        $this->addSql('ALTER TABLE user DROP working_zone_id');
    }
}
