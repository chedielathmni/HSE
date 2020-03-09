<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200309142615 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_pictogramme (product_id INT NOT NULL, pictogramme_id INT NOT NULL, INDEX IDX_9C8F88D84584665A (product_id), INDEX IDX_9C8F88D838EF53FA (pictogramme_id), PRIMARY KEY(product_id, pictogramme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pictogramme (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_pictogramme ADD CONSTRAINT FK_9C8F88D84584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_pictogramme ADD CONSTRAINT FK_9C8F88D838EF53FA FOREIGN KEY (pictogramme_id) REFERENCES pictogramme (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_pictogramme DROP FOREIGN KEY FK_9C8F88D838EF53FA');
        $this->addSql('DROP TABLE product_pictogramme');
        $this->addSql('DROP TABLE pictogramme');
    }
}
