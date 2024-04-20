<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220716000914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create database table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE data_module_iot (id INT AUTO_INCREMENT NOT NULL, module_id INT NOT NULL, data1 DOUBLE PRECISION DEFAULT NULL, data2 DOUBLE PRECISION DEFAULT NULL, data3 DOUBLE PRECISION DEFAULT NULL, data4 DOUBLE PRECISION DEFAULT NULL, data5 DOUBLE PRECISION DEFAULT NULL, INDEX IDX_2E0CD8DDAFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_iot (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_E139E204C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_module_iot (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, data_name1 VARCHAR(255) DEFAULT NULL, data_name2 VARCHAR(255) DEFAULT NULL, data_name3 VARCHAR(255) DEFAULT NULL, data_name4 VARCHAR(255) DEFAULT NULL, data_name5 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE data_module_iot ADD CONSTRAINT FK_2E0CD8DDAFC2B591 FOREIGN KEY (module_id) REFERENCES module_iot (id)');
        $this->addSql('ALTER TABLE module_iot ADD CONSTRAINT FK_E139E204C54C8C93 FOREIGN KEY (type_id) REFERENCES type_module_iot (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE data_module_iot DROP FOREIGN KEY FK_2E0CD8DDAFC2B591');
        $this->addSql('ALTER TABLE module_iot DROP FOREIGN KEY FK_E139E204C54C8C93');
        $this->addSql('DROP TABLE data_module_iot');
        $this->addSql('DROP TABLE module_iot');
        $this->addSql('DROP TABLE type_module_iot');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
