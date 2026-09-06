<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260825134148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reminder ADD user_supplement_id INT NOT NULL');
        $this->addSql('ALTER TABLE reminder ADD CONSTRAINT FK_40374F40991D5771 FOREIGN KEY (user_supplement_id) REFERENCES user_supplement (id)');
        $this->addSql('CREATE INDEX IDX_40374F40991D5771 ON reminder (user_supplement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reminder DROP FOREIGN KEY FK_40374F40991D5771');
        $this->addSql('DROP INDEX IDX_40374F40991D5771 ON reminder');
        $this->addSql('ALTER TABLE reminder DROP user_supplement_id');
    }
}
