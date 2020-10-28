<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201020232410 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resiliation DROP FOREIGN KEY FK_D0060BC76BF700BD');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP INDEX IDX_D0060BC76BF700BD ON resiliation');
        $this->addSql('ALTER TABLE resiliation ADD status VARCHAR(255) NOT NULL, DROP status_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE resiliation ADD status_id INT NOT NULL, DROP status');
        $this->addSql('ALTER TABLE resiliation ADD CONSTRAINT FK_D0060BC76BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_D0060BC76BF700BD ON resiliation (status_id)');
    }
}
