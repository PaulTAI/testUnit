<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200615115105 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE items_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE to_do_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE items (id INT NOT NULL, content VARCHAR(255) NOT NULL, name_item VARCHAR(255) NOT NULL, create_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE items_todolist (items_id INT NOT NULL, todolist_id INT NOT NULL, PRIMARY KEY(items_id, todolist_id))');
        $this->addSql('CREATE INDEX IDX_AA3646156BB0AE84 ON items_todolist (items_id)');
        $this->addSql('CREATE INDEX IDX_AA364615AD16642A ON items_todolist (todolist_id)');
        $this->addSql('CREATE TABLE to_do_list (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, to_do_list_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, age INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D93D649B3AB48EB ON "user" (to_do_list_id)');
        $this->addSql('ALTER TABLE items_todolist ADD CONSTRAINT FK_AA3646156BB0AE84 FOREIGN KEY (items_id) REFERENCES items (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE items_todolist ADD CONSTRAINT FK_AA364615AD16642A FOREIGN KEY (todolist_id) REFERENCES to_do_list (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649B3AB48EB FOREIGN KEY (to_do_list_id) REFERENCES to_do_list (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE items_todolist DROP CONSTRAINT FK_AA3646156BB0AE84');
        $this->addSql('ALTER TABLE items_todolist DROP CONSTRAINT FK_AA364615AD16642A');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649B3AB48EB');
        $this->addSql('DROP SEQUENCE items_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE to_do_list_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE items_todolist');
        $this->addSql('DROP TABLE to_do_list');
        $this->addSql('DROP TABLE "user"');
    }
}
