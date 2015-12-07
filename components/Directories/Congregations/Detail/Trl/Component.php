<?php
class Directories_Congregations_Detail_Trl_Component extends Kwc_Directories_Item_Detail_Trl_Component
{
    public static function getSettings($masterComponentClass)
    {
        $ret = parent::getSettings($masterComponentClass);
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['country'] = '';
        if ($ret['row']->country) {
            $ret['country'] = Kwf_Model_Abstract::getInstance('Kwf_Util_Model_Countries')
                ->getNameByLanguageAndId($this->getData()->getLanguage(), $ret['row']->country);
        }
        foreach ($ret['speakers'] as $key=>$speaker) {
            $talks = array();
            foreach ($speaker['talks'] as $talk) {
                $talks[] = array(
                    'number' => $talk['number'],
                    'title' => $talk['row']->getParentRow('Talk')->getTitle($this->getData()->getLanguage()),
                    'language' => Talks::getLanguage($talk['row']->language, $this->getData())
                );
            }
            $ret['speakers'][$key]['talks'] = $talks;
        }
        $ret['pdfDownloadUrl'] = Kwf_Media::getUrl('CongregationsPdf', $ret['row']->id, 'congregation;'.$this->getData()->getLanguage(), $this->getData()->trl('Versammlungs.pdf'));
        return $ret;
    }
}
