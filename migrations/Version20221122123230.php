<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221122123230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistant ADD is_verified TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE medecin ADD is_verified TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE patient ADD is_verified TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistant DROP is_verified');
        $this->addSql('ALTER TABLE medecin DROP is_verified');
        $this->addSql('ALTER TABLE patient DROP is_verified');
        $this->addSql('ALTER TABLE `user` DROP is_verified');
    }
}
