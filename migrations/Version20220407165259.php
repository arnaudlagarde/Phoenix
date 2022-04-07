<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407165259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fact ADD projet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fact ADD CONSTRAINT FK_6FA45B95C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_6FA45B95C18272 ON fact (projet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fact DROP FOREIGN KEY FK_6FA45B95C18272');
        $this->addSql('DROP INDEX IDX_6FA45B95C18272 ON fact');
        $this->addSql('ALTER TABLE fact DROP projet_id');
    }
}
