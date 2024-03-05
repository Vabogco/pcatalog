<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305213720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE item (id INT NOT NULL, category_name VARCHAR(255) DEFAULT NULL, entity_id INT DEFAULT NULL, sku VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, shortdesc TEXT DEFAULT NULL, brand VARCHAR(255) DEFAULT NULL, price NUMERIC(12, 4) DEFAULT NULL, rating SMALLINT DEFAULT NULL, caffeine_type VARCHAR(255) DEFAULT NULL, count INT DEFAULT NULL, flavored BOOLEAN DEFAULT NULL, seasonal BOOLEAN DEFAULT NULL, in_stock BOOLEAN NOT NULL, facebook BOOLEAN NOT NULL, is_kcup BOOLEAN NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE item_id_seq CASCADE');
        $this->addSql('DROP TABLE item');
    }
}
