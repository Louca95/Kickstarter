<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241210095451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contribution (id INT AUTO_INCREMENT NOT NULL, utilisateur_id_id INT NOT NULL, projet_id_id INT NOT NULL, montant NUMERIC(10, 2) NOT NULL, date DATETIME NOT NULL, INDEX IDX_EA351E15B981C689 (utilisateur_id_id), INDEX IDX_EA351E15D4E271E1 (projet_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contribution ADD CONSTRAINT FK_EA351E15B981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contribution ADD CONSTRAINT FK_EA351E15D4E271E1 FOREIGN KEY (projet_id_id) REFERENCES projet (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contribution DROP FOREIGN KEY FK_EA351E15B981C689');
        $this->addSql('ALTER TABLE contribution DROP FOREIGN KEY FK_EA351E15D4E271E1');
        $this->addSql('DROP TABLE contribution');
    }
}
