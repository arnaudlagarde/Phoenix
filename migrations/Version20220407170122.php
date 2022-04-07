<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407170122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE milestone ADD projet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE milestone ADD CONSTRAINT FK_4FAC8382C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_4FAC8382C18272 ON milestone (projet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE milestone DROP FOREIGN KEY FK_4FAC8382C18272');
        $this->addSql('DROP INDEX IDX_4FAC8382C18272 ON milestone');
        $this->addSql('ALTER TABLE milestone DROP projet_id');
    }
}
