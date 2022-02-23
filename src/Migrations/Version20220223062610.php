<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223062610 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ads CHANGE project_id project_id INT DEFAULT NULL, CHANGE price price VARCHAR(50) DEFAULT NULL, CHANGE publication_date publication_date DATETIME DEFAULT NULL, CHANGE publication_end publication_end DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE ads_categories CHANGE slug slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE comment CHANGE blog_id blog_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mentoring_categories CHANGE slug slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE mentoring_programs CHANGE target_audience target_audience INT DEFAULT NULL, CHANGE format format INT DEFAULT NULL');
        $this->addSql('ALTER TABLE news CHANGE nko_id nko_id INT DEFAULT NULL, CHANGE date_to date_to DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE nko CHANGE agreement agreement VARCHAR(255) DEFAULT NULL, CHANGE ogrn ogrn VARCHAR(255) DEFAULT NULL, CHANGE long_name long_name VARCHAR(255) DEFAULT NULL, CHANGE short_name short_name VARCHAR(255) DEFAULT NULL, CHANGE yegryul_date yegryul_date DATE DEFAULT NULL, CHANGE registration_date registration_date DATE DEFAULT NULL, CHANGE okved okved VARCHAR(255) DEFAULT NULL, CHANGE okved2 okved2 VARCHAR(255) DEFAULT NULL, CHANGE legal_zip legal_zip VARCHAR(255) DEFAULT NULL, CHANGE legal_city legal_city VARCHAR(255) DEFAULT NULL, CHANGE legal_street legal_street VARCHAR(255) DEFAULT NULL, CHANGE legal_house legal_house VARCHAR(255) DEFAULT NULL, CHANGE legal_pavilion legal_pavilion VARCHAR(255) DEFAULT NULL, CHANGE legal_office legal_office VARCHAR(255) DEFAULT NULL, CHANGE legal_district legal_district VARCHAR(255) DEFAULT NULL, CHANGE legal_address legal_address VARCHAR(255) DEFAULT NULL, CHANGE bank_name bank_name VARCHAR(255) DEFAULT NULL, CHANGE bank_inn bank_inn VARCHAR(255) DEFAULT NULL, CHANGE bank_kpp bank_kpp VARCHAR(255) DEFAULT NULL, CHANGE bank_bik bank_bik VARCHAR(255) DEFAULT NULL, CHANGE bank_kschet bank_kschet VARCHAR(255) DEFAULT NULL, CHANGE r_schet r_schet VARCHAR(255) DEFAULT NULL, CHANGE site site VARCHAR(255) DEFAULT NULL, CHANGE blocked_at blocked_at DATETIME DEFAULT NULL, CHANGE okpo okpo BIGINT DEFAULT NULL, CHANGE kpp kpp BIGINT DEFAULT NULL, CHANGE type type SMALLINT DEFAULT NULL, CHANGE management_name management_name VARCHAR(255) DEFAULT NULL, CHANGE management_post management_post VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nko_project_results CHANGE project_id project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projects CHANGE nko_id nko_id INT DEFAULT NULL, CHANGE date_publish date_publish DATETIME DEFAULT NULL, CHANGE date_begin date_begin DATETIME DEFAULT NULL, CHANGE date_end date_end DATETIME DEFAULT NULL, CHANGE link_to_site link_to_site VARCHAR(255) DEFAULT NULL, CHANGE output_bank_details output_bank_details TINYINT(1) DEFAULT NULL, CHANGE expert_assessment expert_assessment DOUBLE PRECISION DEFAULT NULL, CHANGE grant_amount grant_amount DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE nko_project_stages CHANGE project_id project_id INT DEFAULT NULL, CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE date_begin date_begin DATETIME DEFAULT NULL, CHANGE date_end date_end DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE nko_social_network CHANGE type_id type_id INT DEFAULT NULL, CHANGE nko_id nko_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vacancy CHANGE project_id project_id INT DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE contact_phone contact_phone VARCHAR(255) DEFAULT NULL, CHANGE contact_email contact_email VARCHAR(255) DEFAULT NULL, CHANGE publication_date publication_date DATETIME DEFAULT NULL, CHANGE price price DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE vacancy_categories CHANGE slug slug VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE ads CHANGE project_id project_id INT DEFAULT NULL, CHANGE price price VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE publication_date publication_date DATETIME DEFAULT \'NULL\', CHANGE publication_end publication_end DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE ads_categories CHANGE slug slug VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE comment CHANGE blog_id blog_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mentoring_categories CHANGE slug slug VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mentoring_programs CHANGE target_audience target_audience INT DEFAULT NULL, CHANGE format format INT DEFAULT NULL');
        $this->addSql('ALTER TABLE news CHANGE nko_id nko_id INT DEFAULT NULL, CHANGE date_to date_to DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE nko CHANGE agreement agreement VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE ogrn ogrn VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE long_name long_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE short_name short_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE yegryul_date yegryul_date DATE DEFAULT \'NULL\', CHANGE registration_date registration_date DATE DEFAULT \'NULL\', CHANGE okved okved VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE okved2 okved2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE legal_zip legal_zip VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE legal_city legal_city VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE legal_street legal_street VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE legal_house legal_house VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE legal_pavilion legal_pavilion VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE legal_office legal_office VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE legal_district legal_district VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE legal_address legal_address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE bank_name bank_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE bank_inn bank_inn VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE bank_kpp bank_kpp VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE bank_bik bank_bik VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE bank_kschet bank_kschet VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE r_schet r_schet VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE site site VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE blocked_at blocked_at DATETIME DEFAULT \'NULL\', CHANGE okpo okpo BIGINT DEFAULT NULL, CHANGE kpp kpp BIGINT DEFAULT NULL, CHANGE type type SMALLINT DEFAULT NULL, CHANGE management_name management_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE management_post management_post VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nko_project_results CHANGE project_id project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nko_project_stages CHANGE project_id project_id INT DEFAULT NULL, CHANGE title title VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE date_begin date_begin DATETIME DEFAULT \'NULL\', CHANGE date_end date_end DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE nko_social_network CHANGE type_id type_id INT DEFAULT NULL, CHANGE nko_id nko_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projects CHANGE nko_id nko_id INT DEFAULT NULL, CHANGE date_publish date_publish DATETIME DEFAULT \'NULL\', CHANGE date_begin date_begin DATETIME DEFAULT \'NULL\', CHANGE date_end date_end DATETIME DEFAULT \'NULL\', CHANGE link_to_site link_to_site VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE output_bank_details output_bank_details TINYINT(1) DEFAULT \'NULL\', CHANGE expert_assessment expert_assessment DOUBLE PRECISION DEFAULT \'NULL\', CHANGE grant_amount grant_amount DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE vacancy CHANGE project_id project_id INT DEFAULT NULL, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE contact_phone contact_phone VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE contact_email contact_email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE publication_date publication_date DATETIME DEFAULT \'NULL\', CHANGE price price DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE vacancy_categories CHANGE slug slug VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
