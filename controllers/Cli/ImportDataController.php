<?php
class Cli_ImportDataController extends Kwf_Controller_Action
{
    /*
        DELETE FROM t_congregations;
        DELETE FROM t_circles;
        DELETE FROM t_circle_groups;
        delete from t_speakers;
        delete from t_talk_titles;
    */
    public function indexAction()
    {
        Kwf_Registry::get('db')->query('DELETE FROM t_speakers_to_talks');
        Kwf_Registry::get('db')->query('DELETE FROM t_speakers');
        Kwf_Registry::get('db')->query('DELETE FROM t_congregations');
        Kwf_Registry::get('db')->query('DELETE FROM t_circles');
        Kwf_Registry::get('db')->query('DELETE FROM t_circle_groups');

        $xml = file_get_contents('app/data_export.xml');
        $xml = str_replace('wp:', '', $xml);
        $xml = str_replace(':encoded', '', $xml);
        $xml = str_replace('dc:', '', $xml);
        $xmlDocument = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

        $circleGroupsModel = Kwf_Model_Abstract::getInstance('CircleGroups');
        $circlesModel = Kwf_Model_Abstract::getInstance('Circles');
        $congregationModel = Kwf_Model_Abstract::getInstance('Congregations');

        $englishCircleGroupRow = $circleGroupsModel->createRow();
        $englishCircleGroupRow->name = 'Fremdsprachen';
        $englishCircleGroupRow->save();
        $englishRow = $circlesModel->createRow();
        $englishRow->name = 'English';
        $englishRow->group_id = $englishCircleGroupRow->id;
        $englishRow->save();

        echo "Insert CircleGroups, Circles and Congregations\n";
        foreach ($xmlDocument->channel->category as $category) {
            //$category->category_nicename
            $row = $circleGroupsModel->createRow();
            if ((string)$category->category_parent != "") {
                $select = new Kwf_Model_Select();
                $parentName = (string)$category->category_parent;
                if ((string)$category->category_parent == 'englischer-kreis') {
                    $parentName = 'English';
                }
                if ((string)$category->category_parent == 'more-languages') {
                    continue;
                }
                $select->whereEquals('name', $parentName);
                $groupRow = $circleGroupsModel->getRow($select);
                $circleRow = $circlesModel->getRow($select);
                if ($groupRow) {
                    $row = $circlesModel->createRow();
                    $row->group_id = $groupRow->id;
                } else if (!$groupRow && $circleRow) {
                    $row = $congregationModel->createRow();
                    $row->circle_id = $circleRow->id;
                } else {
                    echo $category->asXML()."\n";
                    echo "Gruppe ".(string)$category->category_parent." nicht gefunden!\n";
                    continue;
                }
            }
            $row->name = (string)$category->cat_name;
            $row->save();
        }

        echo "Insert Speakers and SpeakerToTalks\n";
        $emptyPosts = array(84, 132, 133, 134, 135, 136, 137, 138, 139, 140, 150,
            151, 1271, 1272, 1333, 1980, 1981, 3023, 3024, 3025, 7, 8, 9, 10, 11, 12,
            13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 3026, 3160, 25, 26, 27,
            28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 44, 45, 46,
        );

        // bis 3494 nichts wichtiges
        $problematicEntries = array();
        $speakersModel = Kwf_Model_Abstract::getInstance('Speakers');
        $talksModel = Kwf_Model_Abstract::getInstance('Talks');
        $speakersToTalksModel = Kwf_Model_Abstract::getInstance('SpeakersToTalks');
        $talkTitlesModel = Kwf_Model_Abstract::getInstance('TalkTitles');
        //2553 => übersetzung der vorträge
        $uselessEntries = array(108, 210, 215, 245, 337, 1144, 1145, 2452, 2569, 2693, 2761);
        $continue = true;
        $countSpeakers = 0;
        $countCongregations = 0;
        foreach ($xmlDocument->channel->item as $item) {
            if ($continue) {
                if ((string)$item->post_id == 3494) $continue = false;
                continue;
            }
            if (in_array($item->post_id, $uselessEntries)) continue;
            if ($item->post_id == 2553) {
                $lines = explode("\n", (string)$item->content);
                foreach ($lines as $line) {
                    $splited = explode('.', $line);
                    $select = new Kwf_Model_Select();
                    $select->whereEquals('number', $splited[0]);
                    $talksRow = $talksModel->getRow($select);
                    if (!$talksRow) {
                        $talksRow = $talksModel->createRow();
                        $talksRow->number = $splited[0];
                        $talksRow->save();
                    }
                    $talkTitleRow = $talkTitlesModel->createRow();
                    $talkTitleRow->language = 'en';
                    $talkTitleRow->title = ltrim($splited[1]);
                    $talkTitleRow->talk_id = $talksRow->id;
                    $talkTitleRow->save();
                }
                continue;
            }
            if (!(string)$item->title) {
                echo "Es ist kein TITEL gesetzt.\n";
                p($item->asXML());
                continue;
            }
            if (strpos((string)$item->title, '.') === 0) {
//                 echo "VERSAMMLUNG\n";
                $select = new Kwf_Model_Select();
                $select->whereEquals('name', str_replace('.', '', (string)$item->title));
                $congregationRow = $congregationModel->getRow($select);

            } else {
//                 echo "REDNER\n";
                $speakerRow = $speakersModel->createRow();

                $name = explode(' ', (string)$item->title);
                if (count($name) > 2) {
                    echo "PROBLEM (name hat mehr als 2 teile): ".(string)$item->title."(".(string)$item->post_id.")\n";
                }
                $speakerRow->lastname = '';
                foreach ($name as $key => $part) { //TODO anders herum
                    if ($key == 0) $speakerRow->lastname = $part;
                    if ($key > 0) $speakerRow->firstname .= $part.' ';
                }
                $speakerRow->lastname = rtrim($speakerRow->lastname);

                $select = new Kwf_Model_Select();
                $select->whereEquals('name', (string)$item->category);
                $congregationRow = $congregationModel->getRow($select);
                if (!$congregationRow) {
                    p($item->asXML());
                    echo 'Versammlung '.(string)$item->category.' nicht gefunden!'."\n";
                    continue;
                }
                $speakerRow->congregation_id = $congregationRow->id;

                $lines = explode("\n", (string)$item->content);
                $talks = false;
                foreach ($lines as $line) {
                    if (strpos(strtolower($line), 'dienstamt') !== false) {
                        if (strpos(strtolower($line), 'ä') !== false) {
                            $speakerRow->degree = 'eldest';
                        } else if (strpos(strtolower($line), 'dag') !== false) {
                            $speakerRow->degree = 'ministry_assistent';
                        } else {
                            $problematicEntries[] = $item;
                        }
                        continue;
                    } else if (strpos(strtolower($line), 'Telefonnummer') !== false) {
                        $splited = explode(':', $line);
                        $speakerRow->phone = $splited[count($splited)-1];
                        continue;
                    } else if (strpos(strtolower($line), 'Vorträge') !== false) {
                        $talks = true;
                        continue;
                    }
                    if ($talks) {
                        $splited = explode(' ', strip_tags($line));
                        $select = new Kwf_Model_Select();
                        $select->whereEquals('number', $splited[0]);
                        $talkRow = $talksModel->getRow($select);
                        if (!$talkRow) $problematicEntries[] = $item;
                        $speakerRow->save();
                        $speakersToTalksRow = $speakersToTalksModel->createRow();
                        $speakersToTalksRow->talk_id = $talkRow->id;
                        $speakersToTalksRow->speaker_id = $speakerRow->id;
                        $speakersToTalksRow->save();
                    }
                }
                $speakerRow->save();
                $countSpeakers++;
            }
        }
        echo "Es wurden ".$countSpeakers." Redner angelegt\n";

        //TODO anlegen von Rednern:
/*        <item>
        <title>Sonnleitner Stefan</title>
        <link>https://vtinfos.hosted-secure.com/712/712a/zell-am-see/stefan-sonnleitner/</link>
        <pubDate>Wed, 19 Jun 2013 16:41:20 +0000</pubDate>
        <dc:creator>Zell am See</dc:creator>
        <guid isPermaLink="false">http://vtinfos.com/?p=49</guid>
        <description></description>
        <content:encoded><![CDATA[<strong>Versammlung</strong>: Zell am See
<strong>Dienstamt</strong>: Ä
<strong>Telefonnummer</strong>: 0676 912 911 3

<strong>Vorträge:
</strong>
<div>
<div title="Page 71">

71 Wie man geistig wach bleibt

81 Wer ist befähigt, Gottes Diener zu sein?

143 Auf den Gott allen Trostes vertrauen

154 Die Menschenherrschaft - auf der Waage gewogen

165 Wessen Wertvorstellungen teilen wir?

175 Was kennzeichnet die Bibel als glaubwürdig?

<span style="color: #444444; font-family: 'Open Sans', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; background-color: #ffffff;">187 Warum lässt ein liebevoller Gott das Böse zu? (SV)</span>

188 Vertrauen wir voller Zuversicht auf Jehova?

</div>
</div>]]></content:encoded>
        <excerpt:encoded><![CDATA[]]></excerpt:encoded>
        <wp:post_id>49</wp:post_id>
        <wp:post_date>2013-06-19 16:41:20</wp:post_date>
        <wp:post_date_gmt>2013-06-19 16:41:20</wp:post_date_gmt>
        <wp:comment_status>closed</wp:comment_status>
        <wp:ping_status>closed</wp:ping_status>
        <wp:post_name>stefan-sonnleitner</wp:post_name>
        <wp:status>publish</wp:status>
        <wp:post_parent>0</wp:post_parent>
        <wp:menu_order>0</wp:menu_order>
        <wp:post_type>post</wp:post_type>
        <wp:post_password></wp:post_password>
        <wp:is_sticky>0</wp:is_sticky>
        <category domain="category" nicename="zell-am-see"><![CDATA[Zell am See]]></category>
        <wp:postmeta>
            <wp:meta_key>_edit_last</wp:meta_key>
            <wp:meta_value><![CDATA[2]]></wp:meta_value>
        </wp:postmeta>
    </item>*/
// 
//         foreach ($xmlDocument->channel->author as $author) {
//             echo $author->asXML();
//         }
        exit;
    }
}
