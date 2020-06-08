<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200328092705 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pomiary (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, tektura_id INT DEFAULT NULL, pokrycie1_id INT DEFAULT NULL, fala1_id INT DEFAULT NULL, pokrycie2_id INT DEFAULT NULL, fala2_id INT DEFAULT NULL, pokrycie3_id INT DEFAULT NULL, data_wykonania DATETIME NOT NULL, numer_zlecenia VARCHAR(255) DEFAULT NULL, pomiar1 INT NOT NULL, pomiar2 INT NOT NULL, pomiar3 INT NOT NULL, pomiar4 INT NOT NULL, pomiar5 INT NOT NULL, ect_max DOUBLE PRECISION NOT NULL, ect_min DOUBLE PRECISION NOT NULL, ect_avg DOUBLE PRECISION NOT NULL, standard_deviation DOUBLE PRECISION NOT NULL, waga DOUBLE PRECISION NOT NULL, wilgotnosc_ect DOUBLE PRECISION NOT NULL, temperatura_ect DOUBLE PRECISION NOT NULL, wilgotnosc_mierzona DOUBLE PRECISION NOT NULL, grubosc_tektury DOUBLE PRECISION NOT NULL, numer_programu VARCHAR(255) NOT NULL, INDEX IDX_D2EFCA54A76ED395 (user_id), INDEX IDX_D2EFCA545D1D6233 (tektura_id), INDEX IDX_D2EFCA54CD1EC83B (pokrycie1_id), INDEX IDX_D2EFCA545494233E (fala1_id), INDEX IDX_D2EFCA54DFAB67D5 (pokrycie2_id), INDEX IDX_D2EFCA5446218CD0 (fala2_id), INDEX IDX_D2EFCA54671700B0 (pokrycie3_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pomiary ADD CONSTRAINT FK_D2EFCA54A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pomiary ADD CONSTRAINT FK_D2EFCA545D1D6233 FOREIGN KEY (tektura_id) REFERENCES tektura (id)');
        $this->addSql('ALTER TABLE pomiary ADD CONSTRAINT FK_D2EFCA54CD1EC83B FOREIGN KEY (pokrycie1_id) REFERENCES papier (id)');
        $this->addSql('ALTER TABLE pomiary ADD CONSTRAINT FK_D2EFCA545494233E FOREIGN KEY (fala1_id) REFERENCES papier (id)');
        $this->addSql('ALTER TABLE pomiary ADD CONSTRAINT FK_D2EFCA54DFAB67D5 FOREIGN KEY (pokrycie2_id) REFERENCES papier (id)');
        $this->addSql('ALTER TABLE pomiary ADD CONSTRAINT FK_D2EFCA5446218CD0 FOREIGN KEY (fala2_id) REFERENCES papier (id)');
        $this->addSql('ALTER TABLE pomiary ADD CONSTRAINT FK_D2EFCA54671700B0 FOREIGN KEY (pokrycie3_id) REFERENCES papier (id)');
        $this->addSql('ALTER TABLE tektura DROP FOREIGN KEY FK_A24B2439A76ED395');
        $this->addSql('DROP INDEX IDX_A24B2439A76ED395 ON tektura');
        $this->addSql('ALTER TABLE tektura DROP user_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pomiary');
        $this->addSql('ALTER TABLE tektura ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tektura ADD CONSTRAINT FK_A24B2439A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A24B2439A76ED395 ON tektura (user_id)');
    }
}
