<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220409230123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin ADD team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_880E0D76296CD8AE ON admin (team_id)');
        $this->addSql('ALTER TABLE portfolio ADD boss_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE portfolio ADD CONSTRAINT FK_A9ED1062261FB672 FOREIGN KEY (boss_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_A9ED1062261FB672 ON portfolio (boss_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76296CD8AE');
        $this->addSql('DROP INDEX IDX_880E0D76296CD8AE ON admin');
        $this->addSql('ALTER TABLE admin DROP team_id');
        $this->addSql('ALTER TABLE portfolio DROP FOREIGN KEY FK_A9ED1062261FB672');
        $this->addSql('DROP INDEX IDX_A9ED1062261FB672 ON portfolio');
        $this->addSql('ALTER TABLE portfolio DROP boss_id');
    }
}
