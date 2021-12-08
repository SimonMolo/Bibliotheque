<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208095936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author ADD clear_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE author ADD CONSTRAINT FK_BDAFD8C8D30DEA81 FOREIGN KEY (clear_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_BDAFD8C8D30DEA81 ON author (clear_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author DROP FOREIGN KEY FK_BDAFD8C8D30DEA81');
        $this->addSql('DROP INDEX IDX_BDAFD8C8D30DEA81 ON author');
        $this->addSql('ALTER TABLE author DROP clear_id');
    }
}
