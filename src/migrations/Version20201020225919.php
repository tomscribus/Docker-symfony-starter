<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201020225919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, insurer_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, siret VARCHAR(255) DEFAULT NULL, legal_name VARCHAR(255) DEFAULT NULL, INDEX IDX_C7440455895854C7 (insurer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE insurer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mandat (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, broker_id INT NOT NULL, resiliation_id INT DEFAULT NULL, creation_date DATETIME NOT NULL, document VARCHAR(255) NOT NULL, is_signed TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1E53EFD519EB6921 (client_id), INDEX IDX_1E53EFD56CC064FC (broker_id), UNIQUE INDEX UNIQ_1E53EFD5F83639DB (resiliation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resiliation (id INT AUTO_INCREMENT NOT NULL, mandat_id INT DEFAULT NULL, resiliation_type_id INT NOT NULL, status_id INT NOT NULL, start_date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D0060BC7C687DD98 (mandat_id), INDEX IDX_D0060BC79CCCEB7E (resiliation_type_id), INDEX IDX_D0060BC76BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resiliation_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455895854C7 FOREIGN KEY (insurer_id) REFERENCES insurer (id)');
        $this->addSql('ALTER TABLE mandat ADD CONSTRAINT FK_1E53EFD519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE mandat ADD CONSTRAINT FK_1E53EFD56CC064FC FOREIGN KEY (broker_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mandat ADD CONSTRAINT FK_1E53EFD5F83639DB FOREIGN KEY (resiliation_id) REFERENCES resiliation (id)');
        $this->addSql('ALTER TABLE resiliation ADD CONSTRAINT FK_D0060BC7C687DD98 FOREIGN KEY (mandat_id) REFERENCES mandat (id)');
        $this->addSql('ALTER TABLE resiliation ADD CONSTRAINT FK_D0060BC79CCCEB7E FOREIGN KEY (resiliation_type_id) REFERENCES resiliation_type (id)');
        $this->addSql('ALTER TABLE resiliation ADD CONSTRAINT FK_D0060BC76BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mandat DROP FOREIGN KEY FK_1E53EFD519EB6921');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455895854C7');
        $this->addSql('ALTER TABLE resiliation DROP FOREIGN KEY FK_D0060BC7C687DD98');
        $this->addSql('ALTER TABLE mandat DROP FOREIGN KEY FK_1E53EFD5F83639DB');
        $this->addSql('ALTER TABLE resiliation DROP FOREIGN KEY FK_D0060BC79CCCEB7E');
        $this->addSql('ALTER TABLE resiliation DROP FOREIGN KEY FK_D0060BC76BF700BD');
        $this->addSql('ALTER TABLE mandat DROP FOREIGN KEY FK_1E53EFD56CC064FC');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE insurer');
        $this->addSql('DROP TABLE mandat');
        $this->addSql('DROP TABLE resiliation');
        $this->addSql('DROP TABLE resiliation_type');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE user');
    }
}
