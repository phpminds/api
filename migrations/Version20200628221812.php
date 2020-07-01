<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Allow NULL for meetup_id and meetup_venue_id.
 */
final class Version20200628221812 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE events CHANGE meetup_id meetup_id INT DEFAULT NULL, CHANGE meetup_venue_id meetup_venue_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE events CHANGE meetup_id meetup_id INT NOT NULL, CHANGE meetup_venue_id meetup_venue_id INT NOT NULL');
    }
}
