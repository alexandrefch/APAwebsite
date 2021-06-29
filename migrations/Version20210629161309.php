<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629161309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prescription (id INT AUTO_INCREMENT NOT NULL, doctor_id INT NOT NULL, patient_id INT NOT NULL, goal LONGTEXT NOT NULL, creation_date DATE NOT NULL, duration INT NOT NULL, min_time_sport_week INT NOT NULL, max_time_sport_week INT NOT NULL, INDEX IDX_1FBFB8D987F4FB17 (doctor_id), INDEX IDX_1FBFB8D96B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prescription_activity_type (prescription_id INT NOT NULL, activity_type_id INT NOT NULL, INDEX IDX_EC00FA6793DB413D (prescription_id), INDEX IDX_EC00FA67C51EFA73 (activity_type_id), PRIMARY KEY(prescription_id, activity_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prescription_pathology (prescription_id INT NOT NULL, pathology_id INT NOT NULL, INDEX IDX_5F7351A493DB413D (prescription_id), INDEX IDX_5F7351A4CE86795D (pathology_id), PRIMARY KEY(prescription_id, pathology_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D987F4FB17 FOREIGN KEY (doctor_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D96B899279 FOREIGN KEY (patient_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE prescription_activity_type ADD CONSTRAINT FK_EC00FA6793DB413D FOREIGN KEY (prescription_id) REFERENCES prescription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prescription_activity_type ADD CONSTRAINT FK_EC00FA67C51EFA73 FOREIGN KEY (activity_type_id) REFERENCES activity_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prescription_pathology ADD CONSTRAINT FK_5F7351A493DB413D FOREIGN KEY (prescription_id) REFERENCES prescription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prescription_pathology ADD CONSTRAINT FK_5F7351A4CE86795D FOREIGN KEY (pathology_id) REFERENCES pathology (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prescription_activity_type DROP FOREIGN KEY FK_EC00FA6793DB413D');
        $this->addSql('ALTER TABLE prescription_pathology DROP FOREIGN KEY FK_5F7351A493DB413D');
        $this->addSql('DROP TABLE prescription');
        $this->addSql('DROP TABLE prescription_activity_type');
        $this->addSql('DROP TABLE prescription_pathology');
    }
}
