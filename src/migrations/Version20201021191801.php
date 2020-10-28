<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201021191801 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mandat DROP FOREIGN KEY mandat_ibfk_1');
        $this->addSql('ALTER TABLE mandat DROP FOREIGN KEY mandat_ibfk_2');
        $this->addSql('ALTER TABLE mandat ADD CONSTRAINT FK_1E53EFD519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE mandat ADD CONSTRAINT FK_1E53EFD5F83639DB FOREIGN KEY (resiliation_id) REFERENCES resiliation (id)');
        $this->addSql('ALTER TABLE resiliation DROP FOREIGN KEY resiliation_ibfk_1');
        $this->addSql('ALTER TABLE resiliation ADD CONSTRAINT FK_D0060BC7C687DD98 FOREIGN KEY (mandat_id) REFERENCES mandat (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE notification');
        $this->addSql('ALTER TABLE mandat DROP FOREIGN KEY FK_1E53EFD519EB6921');
        $this->addSql('ALTER TABLE mandat DROP FOREIGN KEY FK_1E53EFD5F83639DB');
        $this->addSql('ALTER TABLE mandat ADD CONSTRAINT mandat_ibfk_1 FOREIGN KEY (resiliation_id) REFERENCES resiliation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mandat ADD CONSTRAINT mandat_ibfk_2 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE resiliation DROP FOREIGN KEY FK_D0060BC7C687DD98');
        $this->addSql('ALTER TABLE resiliation ADD CONSTRAINT resiliation_ibfk_1 FOREIGN KEY (mandat_id) REFERENCES mandat (id) ON DELETE CASCADE');
    }
}
