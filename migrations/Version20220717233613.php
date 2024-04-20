<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220717233613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add created_at and updated_at trait';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE data_module_iot ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE module_iot ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE type_module_iot ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE data_module_iot DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE module_iot DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE type_module_iot DROP created_at, DROP updated_at');
    }
}
