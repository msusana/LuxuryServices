<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210531144156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate ADD info_candidate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44BC605026 FOREIGN KEY (info_candidate_id) REFERENCES info_admin_candidate (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C8B28E44BC605026 ON candidate (info_candidate_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44BC605026');
        $this->addSql('DROP INDEX UNIQ_C8B28E44BC605026 ON candidate');
        $this->addSql('ALTER TABLE candidate DROP info_candidate_id');
    }
}
