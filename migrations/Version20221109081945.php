<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109081945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_genre (serie_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_4B5C076CD94388BD (serie_id), INDEX IDX_4B5C076C4296D31F (genre_id), PRIMARY KEY(serie_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE serie_genre ADD CONSTRAINT FK_4B5C076CD94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_genre ADD CONSTRAINT FK_4B5C076C4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie CHANGE duree duree TIME DEFAULT NULL, CHANGE premiereDiffusion premiereDiffusion DATE DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE serie_genre DROP FOREIGN KEY FK_4B5C076CD94388BD');
        $this->addSql('ALTER TABLE serie_genre DROP FOREIGN KEY FK_4B5C076C4296D31F');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE serie_genre');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE serie CHANGE duree duree TIME DEFAULT \'NULL\', CHANGE premiereDiffusion premiereDiffusion DATE DEFAULT \'NULL\', CHANGE image image VARCHAR(255) DEFAULT \'NULL\'');
    }
}
