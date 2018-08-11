<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180811153429 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('
        CREATE TABLE shipping_address (
            id BIGINT NOT NULL AUTO_INCREMENT,
            person_id BIGINT NOT NULL,
            name varchar(100) NOT NULL,
            address varchar(100) NOT NULL,
            city varchar(100) NOT NULL,
            country varchar(100) NOT NULL,
            CONSTRAINT shipping_address_PK PRIMARY KEY (id),
            CONSTRAINT shipping_address_person_FK FOREIGN KEY (person_id) REFERENCES towel.person(id)
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
        $this->addSql('DROP TABLE shipping_address;');
    }
}
