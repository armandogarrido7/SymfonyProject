<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230305200012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE flight (id INT AUTO_INCREMENT NOT NULL, date VARCHAR(64) NOT NULL, time VARCHAR(64) NOT NULL, origin VARCHAR(64) NOT NULL, arrival VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plane (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, max_passengers INT NOT NULL, company VARCHAR(64) NOT NULL, type VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, traveller_id INT DEFAULT NULL, flight_id INT NOT NULL, type VARCHAR(64) NOT NULL, price VARCHAR(64) NOT NULL, INDEX IDX_97A0ADA3E58489A0 (traveller_id), INDEX IDX_97A0ADA391F478C5 (flight_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traveller (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, surnames VARCHAR(64) NOT NULL, dni VARCHAR(9) NOT NULL, phone VARCHAR(9) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3E58489A0 FOREIGN KEY (traveller_id) REFERENCES traveller (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA391F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3E58489A0');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA391F478C5');
        $this->addSql('DROP TABLE flight');
        $this->addSql('DROP TABLE plane');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE traveller');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
