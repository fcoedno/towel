<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180811154847 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('
        CREATE TABLE order_item (
            id BIGINT NOT NULL AUTO_INCREMENT,
            order_id BIGINT NOT NULL,
            title varchar(255) NOT NULL,
            note TEXT NOT NULL,
            quantity INT NOT NULL,
            price FLOAT NOT NULL,
            CONSTRAINT order_item_PK PRIMARY KEY (id),
            CONSTRAINT order_item_order_FK FOREIGN KEY (order_id) REFERENCES `order`(id)
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
        $this->addSql('DROP TABLE order_item;');
    }
}
