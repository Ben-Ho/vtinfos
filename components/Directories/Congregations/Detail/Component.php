<?php
class Directories_Congregations_Detail_Component extends Kwc_Directories_Item_Detail_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['generators']['child']['component']['lastChange'] = 'Directories_Congregations_Detail_LastChange_Component';
        $ret['plugins'] = array('Login_Plugin_Component');
        $ret['rootElementClass'] = 'kwfUp-webStandard';
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['row'] = $this->getData()->getRow();
        $ret['country'] = '';
        if ($ret['row']->country) {
            $ret['country'] = Kwf_Model_Abstract::getInstance('Kwf_Util_Model_Countries')
                ->getNameByLanguageAndId($this->getData()->getLanguage(), $ret['row']->country);
        }
        $select = new Kwf_Model_Select();
        $select->where(new Kwf_Model_Select_Expr_Higher('speaks_count', 0));
        $select->whereEquals('deleted', 0);
        $select->whereEquals('inactive', 0);
        $select->order('lastname');
        $ret['speakers'] = array();
        foreach ($this->getData()->getRow()->getChildRows('Speakers', $select) as $speaker) {
            $talks = array();
            $select = new Kwf_Model_Select();
            $select->order('language');
            $select->order('number');
            foreach ($speaker->getChildRows('SpeakerToTalks', $select) as $talk) {
                $talks[] = array(
                    'row' => $talk,
                    'number' => $talk->number,
                    'title' => $talk->title,
                    'language' => Talks::getLanguage($talk->language, $this->getData())
                );
            }
            $ret['speakers'][] = array(
                'row' => $speaker,
                'talks' => $talks
            );
        }

        $speakerModel = Kwf_Model_Abstract::getInstance('Speakers');
        if ($ret['row']->coordinator) {
            $row = $speakerModel->getRow($ret['row']->coordinator);
            if (!$row->deleted) {
                $ret['coordinator'] = $row;
            }
        }
        if ($ret['row']->talk_organiser) {
            $row = $speakerModel->getRow($ret['row']->talk_organiser);
            if (!$row->deleted) {
                $ret['talk_organiser'] = $row;
            }
        }
        $ret['pdfDownloadUrl'] = Kwf_Media::getUrl('CongregationsPdf', $ret['row']->id, 'congregation;'.$this->getData()->getLanguage(), $this->getData()->trl('Versammlungs.pdf'));
        $ret['address'] = $ret['row']->street.', '.$ret['row']->zip.' '.$ret['row']->city.', '.$ret['row']->country;
        $ret['gmapUrl'] = 'https://www.google.at/maps/place/'.urlencode($ret['address']);
        return $ret;
    }
}
