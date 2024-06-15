<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240611130518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apply_skills (apply_id INT NOT NULL, skills_id INT NOT NULL, INDEX IDX_786FE7E54DDCCBDE (apply_id), INDEX IDX_786FE7E57FF61858 (skills_id), PRIMARY KEY(apply_id, skills_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apply_skills ADD CONSTRAINT FK_786FE7E54DDCCBDE FOREIGN KEY (apply_id) REFERENCES apply (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apply_skills ADD CONSTRAINT FK_786FE7E57FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apply ADD diplome_id INT NOT NULL, ADD experience_id INT NOT NULL, ADD state_id INT NOT NULL, ADD status_id INT NOT NULL, ADD job_seeker_id INT NOT NULL');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F26F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id)');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F46E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id)');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F5D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1FC2C5BAA3 FOREIGN KEY (job_seeker_id) REFERENCES job_seeker (id)');
        $this->addSql('CREATE INDEX IDX_BD2F8C1F26F859E2 ON apply (diplome_id)');
        $this->addSql('CREATE INDEX IDX_BD2F8C1F46E90E27 ON apply (experience_id)');
        $this->addSql('CREATE INDEX IDX_BD2F8C1F5D83CC1 ON apply (state_id)');
        $this->addSql('CREATE INDEX IDX_BD2F8C1F6BF700BD ON apply (status_id)');
        $this->addSql('CREATE INDEX IDX_BD2F8C1FC2C5BAA3 ON apply (job_seeker_id)');
        $this->addSql('ALTER TABLE document ADD apply_id INT NOT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A764DDCCBDE FOREIGN KEY (apply_id) REFERENCES apply (id)');
        $this->addSql('CREATE INDEX IDX_D8698A764DDCCBDE ON document (apply_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apply_skills DROP FOREIGN KEY FK_786FE7E54DDCCBDE');
        $this->addSql('ALTER TABLE apply_skills DROP FOREIGN KEY FK_786FE7E57FF61858');
        $this->addSql('DROP TABLE apply_skills');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F26F859E2');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F46E90E27');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F5D83CC1');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F6BF700BD');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1FC2C5BAA3');
        $this->addSql('DROP INDEX IDX_BD2F8C1F26F859E2 ON apply');
        $this->addSql('DROP INDEX IDX_BD2F8C1F46E90E27 ON apply');
        $this->addSql('DROP INDEX IDX_BD2F8C1F5D83CC1 ON apply');
        $this->addSql('DROP INDEX IDX_BD2F8C1F6BF700BD ON apply');
        $this->addSql('DROP INDEX IDX_BD2F8C1FC2C5BAA3 ON apply');
        $this->addSql('ALTER TABLE apply DROP diplome_id, DROP experience_id, DROP state_id, DROP status_id, DROP job_seeker_id');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A764DDCCBDE');
        $this->addSql('DROP INDEX IDX_D8698A764DDCCBDE ON document');
        $this->addSql('ALTER TABLE document DROP apply_id');
    }
}
