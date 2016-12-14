<?php
class Search_Speakers_Detail_Component extends Kwc_Directories_Item_Detail_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['congregation'] = Kwf_Component_Data_Root::getInstance()
            ->getComponentByDbId('congregations_'.$this->getData()->row->congregation_id);
        $select = new Kwf_Model_Select();
        $select->order('number');
        $ret['talks'] = array();
        foreach ($this->getData()->row->getChildRows('SpeakerToTalks', $select) as $talk) {
            $ret['talks'][] = array(
                'row' => $talk,
                'number' => $talk->number,
                'title' => $talk->title
            );
        }
        return $ret;
    }
}
