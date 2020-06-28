<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add title, description and rsvp_url. All values default to null.
 */
final class Version20200628213618 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE events ADD title VARCHAR(100) DEFAULT NULL AFTER id, ADD description LONGTEXT DEFAULT NULL AFTER title, ADD rsvp_url LONGTEXT DEFAULT NULL AFTER description');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE events DROP title, DROP description, DROP rsvp_url');
    }
}
