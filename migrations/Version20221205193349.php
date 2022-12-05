<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205193349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE patient');
        $this->addSql('ALTER TABLE indisponibilite ADD CONSTRAINT FK_8717036F4F31A84 FOREIGN KEY (medecin_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F866B899279 FOREIGN KEY (patient_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F864F31A84 FOREIGN KEY (medecin_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user ADD medecin_id INT DEFAULT NULL, ADD dtype VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) DEFAULT NULL, ADD prenom VARCHAR(255) DEFAULT NULL, ADD adresse VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494F31A84 FOREIGN KEY (medecin_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6494F31A84 ON user (medecin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1BDA53C6E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1ADAD7EBE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE indisponibilite DROP FOREIGN KEY FK_8717036F4F31A84');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F866B899279');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F864F31A84');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6494F31A84');
        $this->addSql('DROP INDEX IDX_8D93D6494F31A84 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP medecin_id, DROP dtype, DROP nom, DROP prenom, DROP adresse');
    }
}
