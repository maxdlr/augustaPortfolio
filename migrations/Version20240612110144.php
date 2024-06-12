<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240612110144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE website_config (id INT AUTO_INCREMENT NOT NULL, seo_img_id INT DEFAULT NULL, description VARCHAR(500) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, INDEX IDX_460FCB5745FE87B9 (seo_img_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE website_config ADD CONSTRAINT FK_460FCB5745FE87B9 FOREIGN KEY (seo_img_id) REFERENCES media (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE website_config DROP FOREIGN KEY FK_460FCB5745FE87B9');
        $this->addSql('DROP TABLE website_config');
    }
}
