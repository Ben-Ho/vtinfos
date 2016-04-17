<?php
class CsvExport implements Kwf_Media_Output_Interface
{
    public static function getMediaOutput($id, $type, $className)
    {
        return CsvExport::generateMediaOutput($id, $type, $className);
    }

    public static function generateMediaOutput($id, $type, $className) {
        $authedUser = Kwf_Model_Abstract::getInstance('Users')->getAuthedUser();
        if (!$authedUser) {
            throw new Kwf_Exception_AccessDenied();
        }
        if ($type == 'de') {
            $subroot = Kwf_Component_Data_Root::getInstance()->getChildComponent('-master');
        } else {
            $subroot = Kwf_Component_Data_Root::getInstance()->getChildComponent('-'.$type);
        }
        if (!$authedUser->feature_csv_export) {
            throw new Kwf_Exception_AccessDenied();
        }
        $data = array();
        $circleNames = explode(',', $authedUser->feature_csv_export);
        foreach ($circleNames as $circleName) {
            $circleName = trim($circleName);
            $select = new Kwf_Model_Select();
            $select->whereEquals('name', $circleName);
            $circleRow = Kwf_Model_Abstract::getInstance('Circles')->getRow($select);
            if (!$circleRow) continue;
            foreach ($circleRow->getChildRows('Congregations') as $congregationRow) {
                foreach ($congregationRow->getChildRows('Speakers') as $speakerRow) {
                    $dataRow = array(
                        'congregation' => $congregationRow->name,
                        'name' => $speakerRow->firstname.' '.$speakerRow->lastname,
                        'phone' => $speakerRow->phone
                    );
                    $talks = array();
                    foreach ($speakerRow->getChildRows('SpeakerToTalks') as $talkRow) {
                        $talks[] = $talkRow->number;
                    }
                    $dataRow['talks'] = implode(',', $talks);
                    $data[] = implode(';', $dataRow);
                }
            }
        }
        return array (
            'contents' => implode("\n", $data),
            'mimeType' => 'text/csv',
            'lifetime' => false,
            'downloadFilename' => $subroot->trl('Redner.csv')
        );
    }
}
