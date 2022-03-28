<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328075912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fact ADD milestone_id INT NOT NULL');
        $this->addSql('ALTER TABLE fact ADD CONSTRAINT FK_6FA45B954B3E2EDA FOREIGN KEY (milestone_id) REFERENCES milestone (id)');
        $this->addSql('CREATE INDEX IDX_6FA45B954B3E2EDA ON fact (milestone_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fact DROP FOREIGN KEY FK_6FA45B954B3E2EDA');
        $this->addSql('DROP INDEX IDX_6FA45B954B3E2EDA ON fact');
        $this->addSql('ALTER TABLE fact DROP milestone_id');
    }
}
