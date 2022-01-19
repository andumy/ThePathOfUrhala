<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119082530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE combo (id INT AUTO_INCREMENT NOT NULL, first_ingredient_id INT NOT NULL, second_ingredient_id INT NOT NULL, result_id INT NOT NULL, effect VARCHAR(255) DEFAULT NULL, is_capped TINYINT(1) NOT NULL, deto INT NOT NULL, mozo INT NOT NULL, ruto INT NOT NULL, crylo INT NOT NULL, INDEX IDX_B13C304A1442B708 (first_ingredient_id), INDEX IDX_B13C304ABEC769D9 (second_ingredient_id), INDEX IDX_B13C304A7A7B643 (result_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE element (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rune (id INT AUTO_INCREMENT NOT NULL, hash VARCHAR(255) NOT NULL, was_used TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE combo ADD CONSTRAINT FK_B13C304A1442B708 FOREIGN KEY (first_ingredient_id) REFERENCES element (id)');
        $this->addSql('ALTER TABLE combo ADD CONSTRAINT FK_B13C304ABEC769D9 FOREIGN KEY (second_ingredient_id) REFERENCES element (id)');
        $this->addSql('ALTER TABLE combo ADD CONSTRAINT FK_B13C304A7A7B643 FOREIGN KEY (result_id) REFERENCES element (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE combo DROP FOREIGN KEY FK_B13C304A1442B708');
        $this->addSql('ALTER TABLE combo DROP FOREIGN KEY FK_B13C304ABEC769D9');
        $this->addSql('ALTER TABLE combo DROP FOREIGN KEY FK_B13C304A7A7B643');
        $this->addSql('DROP TABLE combo');
        $this->addSql('DROP TABLE element');
        $this->addSql('DROP TABLE rune');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
