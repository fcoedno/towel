<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180811154100 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('
        CREATE TABLE `order` (
            id BIGINT NOT NULL AUTO_INCREMENT,
            person_id BIGINT NOT NULL,
            shipping_address_id BIGINT NOT NULL,
            CONSTRAINT order_PK PRIMARY KEY (id),
            CONSTRAINT order_person_FK FOREIGN KEY (person_id) REFERENCES person(id),
            CONSTRAINT order_shipping_address_FK FOREIGN KEY (shipping_address_id) REFERENCES shipping_address(id)
        )
        ENGINE=InnoDB
        DEFAULT CHARSET=utf8
        COLLATE=utf8_general_ci;
        ');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE `order`;');
    }
}
