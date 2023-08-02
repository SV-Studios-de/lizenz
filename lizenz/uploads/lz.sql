CREATE TABLE IF NOT EXISTS `licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `file_id` int(11) NOT NULL,
  `license` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `license` (`license`),
  KEY `file_id` (`file_id`)
);

CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);
