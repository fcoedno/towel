<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180811152449 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('
        CREATE TABLE person_phone (
            id BIGINT NOT NULL AUTO_INCREMENT,
            person_id BIGINT NOT NULL,
            phone varchar(20) NOT NULL,
            CONSTRAINT person_phone_PK PRIMARY KEY (id),
            CONSTRAINT person_phone_person_FK FOREIGN KEY (person_id) REFERENCES towel.person(id)
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
        $this->addSql('DROP TABLE person_phone;');
    }
}
