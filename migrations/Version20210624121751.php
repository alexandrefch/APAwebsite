<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624121751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7D3656A4E7927C74 (email), UNIQUE INDEX UNIQ_7D3656A4217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, structure_id INT NOT NULL, discipline_id INT NOT NULL, description LONGTEXT DEFAULT NULL, rate LONGTEXT DEFAULT NULL, INDEX IDX_AC74095A2534008B (structure_id), INDEX IDX_AC74095AA5522701 (discipline_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_place_type (activity_id INT NOT NULL, place_type_id INT NOT NULL, INDEX IDX_138919CD81C06096 (activity_id), INDEX IDX_138919CDF1809B68 (place_type_id), PRIMARY KEY(activity_id, place_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_pathology (activity_id INT NOT NULL, pathology_id INT NOT NULL, INDEX IDX_3B0F392481C06096 (activity_id), INDEX IDX_3B0F3924CE86795D (pathology_id), PRIMARY KEY(activity_id, pathology_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_audience_type (activity_id INT NOT NULL, audience_type_id INT NOT NULL, INDEX IDX_8AFEDEA581C06096 (activity_id), INDEX IDX_8AFEDEA5180F8CD9 (audience_type_id), PRIMARY KEY(activity_id, audience_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audience_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pathology (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule (id INT AUTO_INCREMENT NOT NULL, contributor_id INT NOT NULL, activity_id INT NOT NULL, duration INT NOT NULL, week_day INT NOT NULL, begin TIME NOT NULL, INDEX IDX_5A3811FB7A19A357 (contributor_id), INDEX IDX_5A3811FB81C06096 (activity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule_person (schedule_id INT NOT NULL, person_id INT NOT NULL, INDEX IDX_56FD9569A40BC2D5 (schedule_id), INDEX IDX_56FD9569217BBB47 (person_id), PRIMARY KEY(schedule_id, person_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, phone_number VARCHAR(15) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, address VARCHAR(255) NOT NULL, lat VARCHAR(15) NOT NULL, lng VARCHAR(15) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_6F0137EAC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A4217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A2534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095AA5522701 FOREIGN KEY (discipline_id) REFERENCES activity_type (id)');
        $this->addSql('ALTER TABLE activity_place_type ADD CONSTRAINT FK_138919CD81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_place_type ADD CONSTRAINT FK_138919CDF1809B68 FOREIGN KEY (place_type_id) REFERENCES place_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_pathology ADD CONSTRAINT FK_3B0F392481C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_pathology ADD CONSTRAINT FK_3B0F3924CE86795D FOREIGN KEY (pathology_id) REFERENCES pathology (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_audience_type ADD CONSTRAINT FK_8AFEDEA581C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_audience_type ADD CONSTRAINT FK_8AFEDEA5180F8CD9 FOREIGN KEY (audience_type_id) REFERENCES audience_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB7A19A357 FOREIGN KEY (contributor_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE schedule_person ADD CONSTRAINT FK_56FD9569A40BC2D5 FOREIGN KEY (schedule_id) REFERENCES schedule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE schedule_person ADD CONSTRAINT FK_56FD9569217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EAC54C8C93 FOREIGN KEY (type_id) REFERENCES structure_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity_place_type DROP FOREIGN KEY FK_138919CD81C06096');
        $this->addSql('ALTER TABLE activity_pathology DROP FOREIGN KEY FK_3B0F392481C06096');
        $this->addSql('ALTER TABLE activity_audience_type DROP FOREIGN KEY FK_8AFEDEA581C06096');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB81C06096');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095AA5522701');
        $this->addSql('ALTER TABLE activity_audience_type DROP FOREIGN KEY FK_8AFEDEA5180F8CD9');
        $this->addSql('ALTER TABLE activity_pathology DROP FOREIGN KEY FK_3B0F3924CE86795D');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A4217BBB47');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB7A19A357');
        $this->addSql('ALTER TABLE schedule_person DROP FOREIGN KEY FK_56FD9569217BBB47');
        $this->addSql('ALTER TABLE activity_place_type DROP FOREIGN KEY FK_138919CDF1809B68');
        $this->addSql('ALTER TABLE schedule_person DROP FOREIGN KEY FK_56FD9569A40BC2D5');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A2534008B');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EAC54C8C93');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE activity_place_type');
        $this->addSql('DROP TABLE activity_pathology');
        $this->addSql('DROP TABLE activity_audience_type');
        $this->addSql('DROP TABLE activity_type');
        $this->addSql('DROP TABLE audience_type');
        $this->addSql('DROP TABLE pathology');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE place_type');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('DROP TABLE schedule_person');
        $this->addSql('DROP TABLE structure');
        $this->addSql('DROP TABLE structure_type');
    }
}
