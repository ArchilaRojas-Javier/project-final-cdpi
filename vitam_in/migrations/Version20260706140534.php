<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260706140534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE benefit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, content CLOB NOT NULL, is_approuved BOOLEAN NOT NULL, created_at DATETIME NOT NULL, user_id INTEGER NOT NULL, supplement_id INTEGER NOT NULL, CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C7793FA21 FOREIGN KEY (supplement_id) REFERENCES supplement (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');
        $this->addSql('CREATE INDEX IDX_9474526C7793FA21 ON comment (supplement_id)');
        $this->addSql('CREATE TABLE "like" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cerated_at DATETIME NOT NULL, user_id INTEGER NOT NULL, comment_id INTEGER NOT NULL, response_id INTEGER NOT NULL, CONSTRAINT FK_AC6340B3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AC6340B3F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AC6340B3FBF32840 FOREIGN KEY (response_id) REFERENCES response (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_AC6340B3A76ED395 ON "like" (user_id)');
        $this->addSql('CREATE INDEX IDX_AC6340B3F8697D13 ON "like" (comment_id)');
        $this->addSql('CREATE INDEX IDX_AC6340B3FBF32840 ON "like" (response_id)');
        $this->addSql('CREATE TABLE note (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, content CLOB NOT NULL, created_at DATETIME NOT NULL, user_supplement_id INTEGER NOT NULL, CONSTRAINT FK_CFBDFA14991D5771 FOREIGN KEY (user_supplement_id) REFERENCES user_supplement (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14991D5771 ON note (user_supplement_id)');
        $this->addSql('CREATE TABLE reminder (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, google_event_id VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE report (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_at DATETIME NOT NULL, user_id INTEGER NOT NULL, response_id INTEGER NOT NULL, CONSTRAINT FK_C42F7784A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C42F7784FBF32840 FOREIGN KEY (response_id) REFERENCES response (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_C42F7784A76ED395 ON report (user_id)');
        $this->addSql('CREATE INDEX IDX_C42F7784FBF32840 ON report (response_id)');
        $this->addSql('CREATE TABLE response (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, content CLOB NOT NULL, created_at DATETIME NOT NULL, user_id INTEGER NOT NULL, comment_id INTEGER NOT NULL, CONSTRAINT FK_3E7B0BFBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_3E7B0BFBF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_3E7B0BFBA76ED395 ON response (user_id)');
        $this->addSql('CREATE INDEX IDX_3E7B0BFBF8697D13 ON response (comment_id)');
        $this->addSql('CREATE TABLE supplement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, on_duration_days INTEGER NOT NULL, off_duration_days INTEGER NOT NULL, precautions CLOB NOT NULL, dosage_schedule CLOB NOT NULL, supplementtype_id INTEGER NOT NULL, CONSTRAINT FK_15A73C9DB6099AB FOREIGN KEY (supplementtype_id) REFERENCES supplement_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_15A73C9DB6099AB ON supplement (supplementtype_id)');
        $this->addSql('CREATE TABLE supplement_benefit (supplement_id INTEGER NOT NULL, benefit_id INTEGER NOT NULL, PRIMARY KEY (supplement_id, benefit_id), CONSTRAINT FK_DF75E97793FA21 FOREIGN KEY (supplement_id) REFERENCES supplement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_DF75E9B517B89 FOREIGN KEY (benefit_id) REFERENCES benefit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_DF75E97793FA21 ON supplement_benefit (supplement_id)');
        $this->addSql('CREATE INDEX IDX_DF75E9B517B89 ON supplement_benefit (benefit_id)');
        $this->addSql('CREATE TABLE supplement_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL, password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
        $this->addSql('CREATE TABLE user_supplement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, dosage_schedule CLOB NOT NULL, start_date DATETIME NOT NULL, duration_days INTEGER NOT NULL, precautions VARCHAR(255) DEFAULT NULL, user_id INTEGER NOT NULL, supplement_id INTEGER NOT NULL, CONSTRAINT FK_A63DB525A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A63DB5257793FA21 FOREIGN KEY (supplement_id) REFERENCES supplement (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_A63DB525A76ED395 ON user_supplement (user_id)');
        $this->addSql('CREATE INDEX IDX_A63DB5257793FA21 ON user_supplement (supplement_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 ON messenger_messages (queue_name, available_at, delivered_at, id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE benefit');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE "like"');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE reminder');
        $this->addSql('DROP TABLE report');
        $this->addSql('DROP TABLE response');
        $this->addSql('DROP TABLE supplement');
        $this->addSql('DROP TABLE supplement_benefit');
        $this->addSql('DROP TABLE supplement_type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_supplement');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
