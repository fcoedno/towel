<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180812202730 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shipping_address DROP FOREIGN KEY shipping_address_person_FK');
        $this->addSql('DROP INDEX shipping_address_person_FK ON shipping_address');
        $this->addSql('ALTER TABLE shipping_address DROP person_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shipping_address ADD person_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE shipping_address ADD CONSTRAINT shipping_address_person_FK FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX shipping_address_person_FK ON shipping_address (person_id)');
    }
}
