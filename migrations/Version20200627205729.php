<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\Migrations\Exception\MigrationException;

/**
 * This is an export of the original DB schema, and is used as the baseline schema for development.
 */
final class Version20200627205729 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'NO_AUTO_VALUE_ON_ZERO\' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meetup_id` int(11) NOT NULL,
  `meetup_venue_id` int(11) NOT NULL,
  `joindin_event_name` varchar(60) NOT NULL,
  `joindin_talk_id` int(11) NOT NULL,
  `joindin_url` varchar(253) NOT NULL,
  `speaker_id` int(11) NOT NULL,
  `supporter_id` int(11) NOT NULL,
  `meetup_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `meetup_id` (`meetup_id`,`speaker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table phinxlog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `phinxlog`;



# Dump of table speakers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `speakers`;

CREATE TABLE `speakers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(254) NOT NULL,
  `twitter` varchar(15) NOT NULL,
  `avatar` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `twitter` (`twitter`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table supporters
# ------------------------------------------------------------

DROP TABLE IF EXISTS `supporters`;

CREATE TABLE `supporters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `url` varchar(253) NOT NULL,
  `twitter` varchar(15) NOT NULL,
  `email` varchar(254) NOT NULL,
  `logo` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `twitter` (`twitter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(120) NOT NULL,
  `password` char(60) NOT NULL,
  `role` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;        
        ');
    }

    public function down(Schema $schema): void
    {
        // TODO: Implement down() method.
    }
}
