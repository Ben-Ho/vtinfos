DROP TABLE cache_component;
CREATE TABLE IF NOT EXISTS `cache_component` (
  `component_id` varchar(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `db_id` varchar(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `page_db_id` varchar(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `expanded_component_id` varchar(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `component_class` varchar(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `renderer` enum('component','mail_html','mail_txt','export_html') NOT NULL,
  `type` enum('page','component','master','partial','componentLink','fullPage','partials') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `value` varchar(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `tag` varchar(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `url` text,
  `domain_component_id` varchar(255) DEFAULT NULL,
  `microtime` bigint(14) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `deleted` smallint(1) NOT NULL DEFAULT '0',
  `content` longblob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE `cache_component`
 ADD PRIMARY KEY (`component_id`,`type`,`value`,`renderer`), ADD KEY `component_class` (`component_class`), ADD KEY `db_id` (`db_id`), ADD KEY `value` (`value`), ADD KEY `type` (`type`), ADD KEY `page_db_id` (`page_db_id`), ADD KEY `expanded_component_id` (`expanded_component_id`), ADD KEY `tag` (`tag`);
