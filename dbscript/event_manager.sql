DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `event_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `start` timestamp NULL DEFAULT NULL,
  `end` timestamp NULL DEFAULT NULL,
  `reminder` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`event_id`),
  KEY `idx_events_reminder` (`reminder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(65) DEFAULT NULL,
  `email` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `user_event  `;
CREATE TABLE `user_event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_EventIdUser` (`event_id`),
  KEY `FK_UserIdEvent` (`user_id`),
  CONSTRAINT `FK_EventIdUser` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  CONSTRAINT `FK_UserIdEvent` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
