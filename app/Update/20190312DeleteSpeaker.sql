ALTER TABLE `t_speakers_to_talks` ADD FOREIGN KEY (`speaker_id`) REFERENCES `t_speakers`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
