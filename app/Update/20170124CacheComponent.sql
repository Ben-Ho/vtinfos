ALTER TABLE `cache_component` ADD `url` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE `kwc_basic_cards` ADD `data` INT NOT NULL ;
ALTER TABLE `cache_component` ADD `tag` VARCHAR(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL AFTER `value`;
