<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200413120600 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE blogg (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, blogg LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, tags LONGTEXT NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentt (id INT AUTO_INCREMENT NOT NULL, blogg_id INT DEFAULT NULL, user VARCHAR(255) NOT NULL, commentt LONGTEXT NOT NULL, approved TINYINT(1) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_C1FA038956BB9B74 (blogg_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentt ADD CONSTRAINT FK_C1FA038956BB9B74 FOREIGN KEY (blogg_id) REFERENCES blogg (id)');
        $this->addSql('ALTER TABLE comment CHANGE blog_id blog_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentt DROP FOREIGN KEY FK_C1FA038956BB9B74');
        $this->addSql('DROP TABLE blogg');
        $this->addSql('DROP TABLE commentt');
        $this->addSql('ALTER TABLE comment CHANGE blog_id blog_id INT DEFAULT NULL');
    }
}
