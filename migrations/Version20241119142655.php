<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119142655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posts DROP CONSTRAINT fk_885dbafac54c8c93');
        $this->addSql('DROP INDEX uniq_885dbafac54c8c93');
        $this->addSql('ALTER TABLE posts DROP type_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE posts ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT fk_885dbafac54c8c93 FOREIGN KEY (type_id) REFERENCES type_posts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_885dbafac54c8c93 ON posts (type_id)');
    }
}
