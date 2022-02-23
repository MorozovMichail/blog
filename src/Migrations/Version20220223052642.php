<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223052642 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ads (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, project_id INT DEFAULT NULL, nko_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, type INT NOT NULL, price VARCHAR(50) DEFAULT NULL, phone VARCHAR(255) NOT NULL, publication_date DATETIME DEFAULT NULL, publication_end DATETIME DEFAULT NULL, INDEX IDX_7EC9F62012469DE2 (category_id), INDEX IDX_7EC9F620166D1F9C (project_id), INDEX IDX_7EC9F620979B72A2 (nko_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ads_categories (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mentoring_categories (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mentoring_programs (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, nko_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, target_audience INT DEFAULT NULL, format INT DEFAULT NULL, INDEX IDX_DCD085A212469DE2 (category_id), INDEX IDX_DCD085A2979B72A2 (nko_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, nko_id INT DEFAULT NULL, title VARCHAR(300) NOT NULL, url VARCHAR(300) NOT NULL, announce LONGTEXT DEFAULT NULL, content LONGTEXT DEFAULT NULL, enabled TINYINT(1) NOT NULL, publication_date DATETIME NOT NULL, date_to DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_1DD39950979B72A2 (nko_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nko (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, agreement VARCHAR(255) DEFAULT NULL, inn BIGINT NOT NULL, ogrn VARCHAR(255) DEFAULT NULL, long_name VARCHAR(255) DEFAULT NULL, short_name VARCHAR(255) DEFAULT NULL, yegryul_date DATE DEFAULT NULL, registration_date DATE DEFAULT NULL, okved VARCHAR(255) DEFAULT NULL, okved2 VARCHAR(255) DEFAULT NULL, legal_zip VARCHAR(255) DEFAULT NULL, legal_city VARCHAR(255) DEFAULT NULL, legal_street VARCHAR(255) DEFAULT NULL, legal_house VARCHAR(255) DEFAULT NULL, legal_pavilion VARCHAR(255) DEFAULT NULL, legal_office VARCHAR(255) DEFAULT NULL, legal_district VARCHAR(255) DEFAULT NULL, legal_address VARCHAR(255) DEFAULT NULL, bank_name VARCHAR(255) DEFAULT NULL, bank_inn VARCHAR(255) DEFAULT NULL, bank_kpp VARCHAR(255) DEFAULT NULL, bank_bik VARCHAR(255) DEFAULT NULL, bank_kschet VARCHAR(255) DEFAULT NULL, r_schet VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, site VARCHAR(255) DEFAULT NULL, blocked_at DATETIME DEFAULT NULL, nko_status SMALLINT NOT NULL, okpo BIGINT DEFAULT NULL, kpp BIGINT DEFAULT NULL, type SMALLINT DEFAULT NULL, management_name VARCHAR(255) DEFAULT NULL, management_post VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nko_roles (id INT AUTO_INCREMENT NOT NULL, nko_id INT NOT NULL, employee VARCHAR(255) NOT NULL, role INT NOT NULL, INDEX IDX_F13AD81979B72A2 (nko_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nko_project_results (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, position INT NOT NULL, INDEX IDX_125FDEE8166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects (id INT AUTO_INCREMENT NOT NULL, nko_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, brief_description LONGTEXT NOT NULL, full_description LONGTEXT NOT NULL, date_publish DATETIME DEFAULT NULL, date_begin DATETIME DEFAULT NULL, date_end DATETIME DEFAULT NULL, work_progress LONGTEXT DEFAULT NULL, link_to_site VARCHAR(255) DEFAULT NULL, output_bank_details TINYINT(1) DEFAULT NULL, expert_assessment DOUBLE PRECISION DEFAULT NULL, grant_amount DOUBLE PRECISION DEFAULT NULL, enabled TINYINT(1) DEFAULT \'1\' NOT NULL, INDEX IDX_5C93B3A4979B72A2 (nko_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nko_projects_news (projects_id INT NOT NULL, news_id INT NOT NULL, INDEX IDX_D32462101EDE0F55 (projects_id), INDEX IDX_D3246210B5A459A0 (news_id), PRIMARY KEY(projects_id, news_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects_projects_groups (projects_id INT NOT NULL, projects_groups_id INT NOT NULL, INDEX IDX_4A7CDBA11EDE0F55 (projects_id), INDEX IDX_4A7CDBA1D68BFAF0 (projects_groups_id), PRIMARY KEY(projects_id, projects_groups_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects_groups (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3199A58F2B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nko_project_stages (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, date_begin DATETIME DEFAULT NULL, date_end DATETIME DEFAULT NULL, INDEX IDX_DB95637B166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nko_social_network (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, nko_id INT DEFAULT NULL, src VARCHAR(255) NOT NULL, INDEX IDX_C6CB074C54C8C93 (type_id), INDEX IDX_C6CB074979B72A2 (nko_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nko_social_network_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2DA352EF2B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacancy (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, project_id INT DEFAULT NULL, nko_id INT NOT NULL, title VARCHAR(255) NOT NULL, is_hot TINYINT(1) NOT NULL, target_audience INT NOT NULL, short_description VARCHAR(500) NOT NULL, full_description LONGTEXT NOT NULL, duties LONGTEXT NOT NULL, conditions LONGTEXT NOT NULL, email VARCHAR(255) DEFAULT NULL, contact_phone VARCHAR(255) DEFAULT NULL, contact_email VARCHAR(255) DEFAULT NULL, publication_date DATETIME DEFAULT NULL, vacancy_status INT NOT NULL, price DOUBLE PRECISION DEFAULT NULL, INDEX IDX_A9346CBD12469DE2 (category_id), INDEX IDX_A9346CBD166D1F9C (project_id), INDEX IDX_A9346CBD979B72A2 (nko_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacancy_skills (vacancy_id INT NOT NULL, skills_id INT NOT NULL, INDEX IDX_7654587B433B78C4 (vacancy_id), INDEX IDX_7654587B7FF61858 (skills_id), PRIMARY KEY(vacancy_id, skills_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacancy_categories (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ads ADD CONSTRAINT FK_7EC9F62012469DE2 FOREIGN KEY (category_id) REFERENCES ads_categories (id)');
        $this->addSql('ALTER TABLE ads ADD CONSTRAINT FK_7EC9F620166D1F9C FOREIGN KEY (project_id) REFERENCES projects (id)');
        $this->addSql('ALTER TABLE ads ADD CONSTRAINT FK_7EC9F620979B72A2 FOREIGN KEY (nko_id) REFERENCES nko (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mentoring_programs ADD CONSTRAINT FK_DCD085A212469DE2 FOREIGN KEY (category_id) REFERENCES mentoring_categories (id)');
        $this->addSql('ALTER TABLE mentoring_programs ADD CONSTRAINT FK_DCD085A2979B72A2 FOREIGN KEY (nko_id) REFERENCES nko (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950979B72A2 FOREIGN KEY (nko_id) REFERENCES nko (id)');
        $this->addSql('ALTER TABLE nko_roles ADD CONSTRAINT FK_F13AD81979B72A2 FOREIGN KEY (nko_id) REFERENCES nko (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nko_project_results ADD CONSTRAINT FK_125FDEE8166D1F9C FOREIGN KEY (project_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A4979B72A2 FOREIGN KEY (nko_id) REFERENCES nko (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nko_projects_news ADD CONSTRAINT FK_D32462101EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nko_projects_news ADD CONSTRAINT FK_D3246210B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects_projects_groups ADD CONSTRAINT FK_4A7CDBA11EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects_projects_groups ADD CONSTRAINT FK_4A7CDBA1D68BFAF0 FOREIGN KEY (projects_groups_id) REFERENCES projects_groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nko_project_stages ADD CONSTRAINT FK_DB95637B166D1F9C FOREIGN KEY (project_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nko_social_network ADD CONSTRAINT FK_C6CB074C54C8C93 FOREIGN KEY (type_id) REFERENCES nko_social_network_type (id)');
        $this->addSql('ALTER TABLE nko_social_network ADD CONSTRAINT FK_C6CB074979B72A2 FOREIGN KEY (nko_id) REFERENCES nko (id)');
        $this->addSql('ALTER TABLE vacancy ADD CONSTRAINT FK_A9346CBD12469DE2 FOREIGN KEY (category_id) REFERENCES vacancy_categories (id)');
        $this->addSql('ALTER TABLE vacancy ADD CONSTRAINT FK_A9346CBD166D1F9C FOREIGN KEY (project_id) REFERENCES projects (id)');
        $this->addSql('ALTER TABLE vacancy ADD CONSTRAINT FK_A9346CBD979B72A2 FOREIGN KEY (nko_id) REFERENCES nko (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vacancy_skills ADD CONSTRAINT FK_7654587B433B78C4 FOREIGN KEY (vacancy_id) REFERENCES vacancy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vacancy_skills ADD CONSTRAINT FK_7654587B7FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment CHANGE blog_id blog_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ads DROP FOREIGN KEY FK_7EC9F62012469DE2');
        $this->addSql('ALTER TABLE mentoring_programs DROP FOREIGN KEY FK_DCD085A212469DE2');
        $this->addSql('ALTER TABLE nko_projects_news DROP FOREIGN KEY FK_D3246210B5A459A0');
        $this->addSql('ALTER TABLE ads DROP FOREIGN KEY FK_7EC9F620979B72A2');
        $this->addSql('ALTER TABLE mentoring_programs DROP FOREIGN KEY FK_DCD085A2979B72A2');
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD39950979B72A2');
        $this->addSql('ALTER TABLE nko_roles DROP FOREIGN KEY FK_F13AD81979B72A2');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A4979B72A2');
        $this->addSql('ALTER TABLE nko_social_network DROP FOREIGN KEY FK_C6CB074979B72A2');
        $this->addSql('ALTER TABLE vacancy DROP FOREIGN KEY FK_A9346CBD979B72A2');
        $this->addSql('ALTER TABLE ads DROP FOREIGN KEY FK_7EC9F620166D1F9C');
        $this->addSql('ALTER TABLE nko_project_results DROP FOREIGN KEY FK_125FDEE8166D1F9C');
        $this->addSql('ALTER TABLE nko_projects_news DROP FOREIGN KEY FK_D32462101EDE0F55');
        $this->addSql('ALTER TABLE projects_projects_groups DROP FOREIGN KEY FK_4A7CDBA11EDE0F55');
        $this->addSql('ALTER TABLE nko_project_stages DROP FOREIGN KEY FK_DB95637B166D1F9C');
        $this->addSql('ALTER TABLE vacancy DROP FOREIGN KEY FK_A9346CBD166D1F9C');
        $this->addSql('ALTER TABLE projects_projects_groups DROP FOREIGN KEY FK_4A7CDBA1D68BFAF0');
        $this->addSql('ALTER TABLE vacancy_skills DROP FOREIGN KEY FK_7654587B7FF61858');
        $this->addSql('ALTER TABLE nko_social_network DROP FOREIGN KEY FK_C6CB074C54C8C93');
        $this->addSql('ALTER TABLE vacancy_skills DROP FOREIGN KEY FK_7654587B433B78C4');
        $this->addSql('ALTER TABLE vacancy DROP FOREIGN KEY FK_A9346CBD12469DE2');
        $this->addSql('DROP TABLE ads');
        $this->addSql('DROP TABLE ads_categories');
        $this->addSql('DROP TABLE mentoring_categories');
        $this->addSql('DROP TABLE mentoring_programs');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE nko');
        $this->addSql('DROP TABLE nko_roles');
        $this->addSql('DROP TABLE nko_project_results');
        $this->addSql('DROP TABLE projects');
        $this->addSql('DROP TABLE nko_projects_news');
        $this->addSql('DROP TABLE projects_projects_groups');
        $this->addSql('DROP TABLE projects_groups');
        $this->addSql('DROP TABLE nko_project_stages');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE nko_social_network');
        $this->addSql('DROP TABLE nko_social_network_type');
        $this->addSql('DROP TABLE vacancy');
        $this->addSql('DROP TABLE vacancy_skills');
        $this->addSql('DROP TABLE vacancy_categories');
        $this->addSql('ALTER TABLE comment CHANGE blog_id blog_id INT DEFAULT NULL');
    }
}
