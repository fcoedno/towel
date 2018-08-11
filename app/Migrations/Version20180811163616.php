<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180811163616 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE person_phone CHANGE person_id person_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_item CHANGE order_id order_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE person_id person_id BIGINT DEFAULT NULL, CHANGE shipping_address_id shipping_address_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE shipping_address CHANGE person_id person_id BIGINT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` CHANGE person_id person_id BIGINT NOT NULL, CHANGE shipping_address_id shipping_address_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE order_item CHANGE order_id order_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE person_phone CHANGE person_id person_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE shipping_address CHANGE person_id person_id BIGINT NOT NULL');
    }
}
