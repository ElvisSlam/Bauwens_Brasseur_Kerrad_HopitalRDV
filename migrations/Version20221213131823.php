<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221213131823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE indisponibilite (id INT AUTO_INCREMENT NOT NULL, medecin_id INT DEFAULT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_8717036F4F31A84 (medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rdv (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, medecin_id INT DEFAULT NULL, statut_id INT DEFAULT NULL, date DATE NOT NULL, heure TIME NOT NULL, duree TIME NOT NULL, INDEX IDX_10C31F866B899279 (patient_id), INDEX IDX_10C31F864F31A84 (medecin_id), INDEX IDX_10C31F86F6203804 (statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, medecin_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, discr VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6494F31A84 (medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE indisponibilite ADD CONSTRAINT FK_8717036F4F31A84 FOREIGN KEY (medecin_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F866B899279 FOREIGN KEY (patient_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F864F31A84 FOREIGN KEY (medecin_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6494F31A84 FOREIGN KEY (medecin_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE indisponibilite DROP FOREIGN KEY FK_8717036F4F31A84');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F866B899279');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F864F31A84');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86F6203804');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6494F31A84');
        $this->addSql('DROP TABLE indisponibilite');
        $this->addSql('DROP TABLE rdv');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
