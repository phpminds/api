<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Allow nullables for everything apart from joindin_event_name and meetup_date, to ensure max BC.
 */
final class Version20200703223032 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE events CHANGE joindin_talk_id joindin_talk_id INT DEFAULT NULL, CHANGE joindin_url joindin_url VARCHAR(253) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE events CHANGE joindin_talk_id joindin_talk_id INT NOT NULL, CHANGE joindin_url joindin_url VARCHAR(253) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
    }
}
