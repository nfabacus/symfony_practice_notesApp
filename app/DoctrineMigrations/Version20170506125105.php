<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170506125105 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE food CHANGE popularity_count popularity_count INT NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE is_published is_published TINYINT(1) NOT NULL, CHANGE type type VARCHAR(255) NOT NULL, CHANGE published_on published_on DATETIME NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE food CHANGE popularity_count popularity_count INT DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE is_published is_published TINYINT(1) DEFAULT NULL, CHANGE type type VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE published_on published_on DATETIME DEFAULT NULL');
    }
}
