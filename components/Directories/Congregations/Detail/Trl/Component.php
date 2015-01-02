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
        foreach ($ret['speakers'] as $key=>$speaker) {
            $talks = array();
            foreach ($speaker['talks'] as $talk) {
                $talks[] = array(
                    'number' => $talk['number'],
                    'title' => $talk['row']->getParentRow('Talk')->getTitle($this->getData()->getLanguage())
                );
            }
            $ret['speakers'][$key]['talks'] = $talks;
        }
        return $ret;
    }
}