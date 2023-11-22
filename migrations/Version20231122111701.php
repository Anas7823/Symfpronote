<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231122111701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note CHANGE coeff_mat coeff_mat_id INT NOT NULL');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1451FE7481 FOREIGN KEY (coeff_mat_id) REFERENCES matiere (id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA1451FE7481 ON note (coeff_mat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1451FE7481');
        $this->addSql('DROP INDEX IDX_CFBDFA1451FE7481 ON note');
        $this->addSql('ALTER TABLE note CHANGE coeff_mat_id coeff_mat INT NOT NULL');
    }
}
