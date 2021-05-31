<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210528095047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, contributor_id INT NOT NULL, structure_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_AC74095A7A19A357 (contributor_id), INDEX IDX_AC74095A2534008B (structure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contributor (id INT AUTO_INCREMENT NOT NULL, user_profile_id INT NOT NULL, UNIQUE INDEX UNIQ_DA6F97936B9DD454 (user_profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doctor (id INT AUTO_INCREMENT NOT NULL, user_profile_id INT NOT NULL, UNIQUE INDEX UNIQ_1FC0F36A6B9DD454 (user_profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doctor_patient (doctor_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_8977B44687F4FB17 (doctor_id), INDEX IDX_8977B4466B899279 (patient_id), PRIMARY KEY(doctor_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, user_profile_id INT NOT NULL, UNIQUE INDEX UNIQ_1ADAD7EB6B9DD454 (user_profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_feedback (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, schedule_id INT NOT NULL, comment LONGTEXT NOT NULL, INDEX IDX_E5AC1CFD6B899279 (patient_id), INDEX IDX_E5AC1CFDA40BC2D5 (schedule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prescription (id INT AUTO_INCREMENT NOT NULL, doctor_id INT NOT NULL, patient_id INT NOT NULL, duration INT NOT NULL, date DATE NOT NULL, INDEX IDX_1FBFB8D987F4FB17 (doctor_id), INDEX IDX_1FBFB8D96B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule (id INT AUTO_INCREMENT NOT NULL, begin_date_time DATETIME NOT NULL, duration TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule_patient (schedule_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_97B0FB5AA40BC2D5 (schedule_id), INDEX IDX_97B0FB5A6B899279 (patient_id), PRIMARY KEY(schedule_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, uid INT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(45) NOT NULL, last_name VARCHAR(45) NOT NULL, phone_number VARCHAR(15) DEFAULT NULL, birth_date DATE DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649539B0606 (uid), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A7A19A357 FOREIGN KEY (contributor_id) REFERENCES contributor (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A2534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE contributor ADD CONSTRAINT FK_DA6F97936B9DD454 FOREIGN KEY (user_profile_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE doctor ADD CONSTRAINT FK_1FC0F36A6B9DD454 FOREIGN KEY (user_profile_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE doctor_patient ADD CONSTRAINT FK_8977B44687F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE doctor_patient ADD CONSTRAINT FK_8977B4466B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB6B9DD454 FOREIGN KEY (user_profile_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE patient_feedback ADD CONSTRAINT FK_E5AC1CFD6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE patient_feedback ADD CONSTRAINT FK_E5AC1CFDA40BC2D5 FOREIGN KEY (schedule_id) REFERENCES schedule (id)');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D987F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id)');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D96B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE schedule_patient ADD CONSTRAINT FK_97B0FB5AA40BC2D5 FOREIGN KEY (schedule_id) REFERENCES schedule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE schedule_patient ADD CONSTRAINT FK_97B0FB5A6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A7A19A357');
        $this->addSql('ALTER TABLE doctor_patient DROP FOREIGN KEY FK_8977B44687F4FB17');
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D987F4FB17');
        $this->addSql('ALTER TABLE doctor_patient DROP FOREIGN KEY FK_8977B4466B899279');
        $this->addSql('ALTER TABLE patient_feedback DROP FOREIGN KEY FK_E5AC1CFD6B899279');
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D96B899279');
        $this->addSql('ALTER TABLE schedule_patient DROP FOREIGN KEY FK_97B0FB5A6B899279');
        $this->addSql('ALTER TABLE patient_feedback DROP FOREIGN KEY FK_E5AC1CFDA40BC2D5');
        $this->addSql('ALTER TABLE schedule_patient DROP FOREIGN KEY FK_97B0FB5AA40BC2D5');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A2534008B');
        $this->addSql('ALTER TABLE contributor DROP FOREIGN KEY FK_DA6F97936B9DD454');
        $this->addSql('ALTER TABLE doctor DROP FOREIGN KEY FK_1FC0F36A6B9DD454');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB6B9DD454');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE contributor');
        $this->addSql('DROP TABLE doctor');
        $this->addSql('DROP TABLE doctor_patient');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE patient_feedback');
        $this->addSql('DROP TABLE prescription');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('DROP TABLE schedule_patient');
        $this->addSql('DROP TABLE structure');
        $this->addSql('DROP TABLE `user`');
    }
}
