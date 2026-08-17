<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260817130602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE benefit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, is_approuved TINYINT NOT NULL, created_at DATETIME NOT NULL, user_id INT NOT NULL, supplement_id INT NOT NULL, INDEX IDX_9474526CA76ED395 (user_id), INDEX IDX_9474526C7793FA21 (supplement_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `like` (id INT AUTO_INCREMENT NOT NULL, cerated_at DATETIME NOT NULL, user_id INT NOT NULL, comment_id INT NOT NULL, response_id INT NOT NULL, INDEX IDX_AC6340B3A76ED395 (user_id), INDEX IDX_AC6340B3F8697D13 (comment_id), INDEX IDX_AC6340B3FBF32840 (response_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, user_supplement_id INT NOT NULL, INDEX IDX_CFBDFA14991D5771 (user_supplement_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE reminder (id INT AUTO_INCREMENT NOT NULL, google_event_id VARCHAR(255) NOT NULL, is_active TINYINT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, user_id INT NOT NULL, response_id INT NOT NULL, INDEX IDX_C42F7784A76ED395 (user_id), INDEX IDX_C42F7784FBF32840 (response_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL, expires_at DATETIME NOT NULL, user_id INT NOT NULL, INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE response (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, user_id INT NOT NULL, comment_id INT NOT NULL, INDEX IDX_3E7B0BFBA76ED395 (user_id), INDEX IDX_3E7B0BFBF8697D13 (comment_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE supplement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, on_duration_days INT NOT NULL, off_duration_days INT NOT NULL, precautions LONGTEXT NOT NULL, dosage_schedule JSON NOT NULL, supplementtype_id INT NOT NULL, INDEX IDX_15A73C9DB6099AB (supplementtype_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE supplement_benefit (supplement_id INT NOT NULL, benefit_id INT NOT NULL, INDEX IDX_DF75E97793FA21 (supplement_id), INDEX IDX_DF75E9B517B89 (benefit_id), PRIMARY KEY (supplement_id, benefit_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE supplement_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT NOT NULL, google_id VARCHAR(255) DEFAULT NULL, avatar_url VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_supplement (id INT AUTO_INCREMENT NOT NULL, dosage_schedule JSON NOT NULL, start_date DATETIME NOT NULL, duration_days INT NOT NULL, precautions VARCHAR(255) DEFAULT NULL, user_id INT NOT NULL, supplement_id INT NOT NULL, INDEX IDX_A63DB525A76ED395 (user_id), INDEX IDX_A63DB5257793FA21 (supplement_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7793FA21 FOREIGN KEY (supplement_id) REFERENCES supplement (id)');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3FBF32840 FOREIGN KEY (response_id) REFERENCES response (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14991D5771 FOREIGN KEY (user_supplement_id) REFERENCES user_supplement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784FBF32840 FOREIGN KEY (response_id) REFERENCES response (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFBF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE supplement ADD CONSTRAINT FK_15A73C9DB6099AB FOREIGN KEY (supplementtype_id) REFERENCES supplement_type (id)');
        $this->addSql('ALTER TABLE supplement_benefit ADD CONSTRAINT FK_DF75E97793FA21 FOREIGN KEY (supplement_id) REFERENCES supplement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE supplement_benefit ADD CONSTRAINT FK_DF75E9B517B89 FOREIGN KEY (benefit_id) REFERENCES benefit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_supplement ADD CONSTRAINT FK_A63DB525A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_supplement ADD CONSTRAINT FK_A63DB5257793FA21 FOREIGN KEY (supplement_id) REFERENCES supplement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7793FA21');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3A76ED395');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3F8697D13');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3FBF32840');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14991D5771');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784A76ED395');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784FBF32840');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFBA76ED395');
        $this->addSql('ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFBF8697D13');
        $this->addSql('ALTER TABLE supplement DROP FOREIGN KEY FK_15A73C9DB6099AB');
        $this->addSql('ALTER TABLE supplement_benefit DROP FOREIGN KEY FK_DF75E97793FA21');
        $this->addSql('ALTER TABLE supplement_benefit DROP FOREIGN KEY FK_DF75E9B517B89');
        $this->addSql('ALTER TABLE user_supplement DROP FOREIGN KEY FK_A63DB525A76ED395');
        $this->addSql('ALTER TABLE user_supplement DROP FOREIGN KEY FK_A63DB5257793FA21');
        $this->addSql('DROP TABLE benefit');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE `like`');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE reminder');
        $this->addSql('DROP TABLE report');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE response');
        $this->addSql('DROP TABLE supplement');
        $this->addSql('DROP TABLE supplement_benefit');
        $this->addSql('DROP TABLE supplement_type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_supplement');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
