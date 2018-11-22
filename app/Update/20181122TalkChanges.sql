CREATE TABLE IF NOT EXISTS `t_talk_changes` (
`id` int(11) NOT NULL,
  `talk_id` int(11) NOT NULL,
  `change_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `change_info` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `change_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `t_talk_changes`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `t_talk_changes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
