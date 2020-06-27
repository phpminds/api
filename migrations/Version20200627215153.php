<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * An event does not require a speaker or a sponsor.
 */
final class Version20200627215153 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE events CHANGE speaker_id speaker_id INT DEFAULT NULL, CHANGE supporter_id supporter_id INT DEFAULT NULL, CHANGE meetup_date meetup_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE speakers CHANGE twitter twitter VARCHAR(15) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE events CHANGE speaker_id speaker_id INT NOT NULL, CHANGE supporter_id supporter_id INT NOT NULL, CHANGE meetup_date meetup_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE speakers CHANGE twitter twitter VARCHAR(15) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
    }
}
