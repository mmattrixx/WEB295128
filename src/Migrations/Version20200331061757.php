<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200331061757 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pomiary CHANGE user_id user_id INT DEFAULT NULL, CHANGE tektura_id tektura_id INT DEFAULT NULL, CHANGE pokrycie1_id pokrycie1_id INT DEFAULT NULL, CHANGE fala1_id fala1_id INT DEFAULT NULL, CHANGE pokrycie2_id pokrycie2_id INT DEFAULT NULL, CHANGE fala2_id fala2_id INT DEFAULT NULL, CHANGE pokrycie3_id pokrycie3_id INT DEFAULT NULL, CHANGE numer_zlecenia numer_zlecenia VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pomiary CHANGE user_id user_id INT DEFAULT NULL, CHANGE tektura_id tektura_id INT DEFAULT NULL, CHANGE pokrycie1_id pokrycie1_id INT DEFAULT NULL, CHANGE fala1_id fala1_id INT DEFAULT NULL, CHANGE pokrycie2_id pokrycie2_id INT DEFAULT NULL, CHANGE fala2_id fala2_id INT DEFAULT NULL, CHANGE pokrycie3_id pokrycie3_id INT DEFAULT NULL, CHANGE numer_zlecenia numer_zlecenia VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user DROP roles');
    }
}
