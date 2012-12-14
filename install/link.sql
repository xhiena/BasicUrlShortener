SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
DROP TABLE IF EXISTS `link`;
CREATE TABLE IF NOT EXISTS `link` (
  `id` bigint(20) NOT NULL auto_increment,
  `url` varchar(255) NOT NULL,
  `shortcode` varchar(6) NOT NULL,
  `visited` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `key` (`shortcode`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;