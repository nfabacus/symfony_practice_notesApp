<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170506083809 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE food_note ADD food_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE food_note ADD CONSTRAINT FK_7A9A52C5BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id)');
        $this->addSql('CREATE INDEX IDX_7A9A52C5BA8E87C4 ON food_note (food_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE food_note DROP FOREIGN KEY FK_7A9A52C5BA8E87C4');
        $this->addSql('DROP INDEX IDX_7A9A52C5BA8E87C4 ON food_note');
        $this->addSql('ALTER TABLE food_note DROP food_id');
    }
}
