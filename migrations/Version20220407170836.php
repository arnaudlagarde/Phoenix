<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407170836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE portfolio ADD responsible_id INT NOT NULL');
        $this->addSql('ALTER TABLE portfolio ADD CONSTRAINT FK_A9ED1062602AD315 FOREIGN KEY (responsible_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A9ED1062602AD315 ON portfolio (responsible_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE portfolio DROP FOREIGN KEY FK_A9ED1062602AD315');
        $this->addSql('DROP INDEX IDX_A9ED1062602AD315 ON portfolio');
        $this->addSql('ALTER TABLE portfolio DROP responsible_id');
    }
}
