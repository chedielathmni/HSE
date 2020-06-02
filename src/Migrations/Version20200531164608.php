<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200531164608 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE car ADD carte_grise VARCHAR(255) NOT NULL, ADD airbag TINYINT(1) NOT NULL, ADD oil_date DATE DEFAULT NULL, ADD kilometrage INT NOT NULL, ADD updated_at DATETIME NOT NULL, ADD fr_wheel_change_date DATE DEFAULT NULL, ADD fl_wheel_chage_date DATE DEFAULT NULL, ADD br_wheel_change_date DATE DEFAULT NULL, ADD bl_wheel_change_date DATE DEFAULT NULL, ADD front_brakes_change_date DATE DEFAULT NULL, ADD back_brakes_change_date DATE DEFAULT NULL, ADD last_inspection_date DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE car DROP carte_grise, DROP airbag, DROP oil_date, DROP kilometrage, DROP updated_at, DROP fr_wheel_change_date, DROP fl_wheel_chage_date, DROP br_wheel_change_date, DROP bl_wheel_change_date, DROP front_brakes_change_date, DROP back_brakes_change_date, DROP last_inspection_date');
    }
}
