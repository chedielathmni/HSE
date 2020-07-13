<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200713012825 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C13D0049C3');
        $this->addSql('DROP TABLE coords');
        $this->addSql('DROP INDEX UNIQ_17FD46C13D0049C3 ON alert');
        $this->addSql('ALTER TABLE alert ADD coords LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', DROP coords_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE coords (id INT AUTO_INCREMENT NOT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE alert ADD coords_id INT DEFAULT NULL, DROP coords');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C13D0049C3 FOREIGN KEY (coords_id) REFERENCES coords (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_17FD46C13D0049C3 ON alert (coords_id)');
    }
}
