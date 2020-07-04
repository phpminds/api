<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add an updated date field and update all previous events setting them to their meetup_date.
 */
final class Version20200703234017 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE events ADD updated DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $oldEvents = $this->connection->query('SELECT id, meetup_date FROM events')->fetchAll();
        foreach ($oldEvents as $event) {
            $this->addSql('UPDATE events SET updated = "'.$event['meetup_date'].'" WHERE id = '.$event['id']);
        }

        $this->addSql('ALTER TABLE events MODIFY updated DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE events DROP updated');
    }
}
