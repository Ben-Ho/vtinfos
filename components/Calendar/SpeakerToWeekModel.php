<?php
class Calendar_SpeakerToWeekModel extends Kwf_Model_Db
{
    /*
        CREATE TABLE IF NOT EXISTS `t_speakers_to_weeks` (
        `id` int(11) NOT NULL,
          `week` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          `speaker_id` int(11) NOT NULL,
          `congregation_id` int(11) NOT NULL,
          `talk_id` int(11) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


        ALTER TABLE `t_speakers_to_weeks`
         ADD PRIMARY KEY (`id`), ADD KEY `week` (`week`);


        ALTER TABLE `t_speakers_to_weeks`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
     */
    protected $_table = 't_speakers_to_weeks';
    protected $_referenceMap = array(
        'Speaker' => array(
            'refModelClass' => 'Speakers',
            'column' => 'speaker_id'
        ),
        'Talk' => array(
            'refModelClass' => 'Talks',
            'column' => 'talk_id'
        )
    );
}
