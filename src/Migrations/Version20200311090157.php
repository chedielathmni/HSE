<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200311090157 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491ED93D47');
        $this->addSql('DROP TABLE user_group');
        $this->addSql('DROP INDEX IDX_8D93D6491ED93D47 ON user');
        $this->addSql('ALTER TABLE user DROP user_group_id');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8AE7B68477153098 ON conseil_prudence (code)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_group (id INT AUTO_INCREMENT NOT NULL, group_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, can_manage_users TINYINT(1) NOT NULL, can_manage_products TINYINT(1) NOT NULL, can_manage_groups TINYINT(1) NOT NULL, can_manage_stock TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP INDEX UNIQ_8AE7B68477153098 ON conseil_prudence');
        $this->addSql('ALTER TABLE user ADD user_group_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491ED93D47 FOREIGN KEY (user_group_id) REFERENCES user_group (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6491ED93D47 ON user (user_group_id)');
    }
}
