<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241210120435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contribution RENAME INDEX idx_ea351e15b981c689 TO IDX_EA351E15FB88E14F');
        $this->addSql('ALTER TABLE contribution RENAME INDEX idx_ea351e15d4e271e1 TO IDX_EA351E15C18272');
        $this->addSql('ALTER TABLE projet RENAME INDEX idx_50159ca99d86650f TO IDX_50159CA9A76ED395');
        $this->addSql('ALTER TABLE user CHANGE role role VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contribution RENAME INDEX idx_ea351e15fb88e14f TO IDX_EA351E15B981C689');
        $this->addSql('ALTER TABLE contribution RENAME INDEX idx_ea351e15c18272 TO IDX_EA351E15D4E271E1');
        $this->addSql('ALTER TABLE projet RENAME INDEX idx_50159ca9a76ed395 TO IDX_50159CA99D86650F');
        $this->addSql('ALTER TABLE user CHANGE role role VARCHAR(255) NOT NULL COLLATE `utf8mb4_bin`');
    }
}
