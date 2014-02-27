<?php
class Circles_Circle_Congregation_Component extends Kwc_Abstract
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlStatic('Versammlung');
        $ret['plugins'] = array('Login_Plugin_Component');
        $ret['assets']['dep'][] = 'KwfResponsiveEl';
        $ret['cssClass'] = 'webStandard';
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['row'] = $this->getData()->getRow();
        $select = new Kwf_Model_Select();
        $select->where(new Kwf_Model_Select_Expr_Higher('speaks_count', 0));
        $select->whereEquals('deleted', 0);
        $ret['speakers'] = $this->getData()->getRow()->getChildRows('Speakers', $select);

        $speakerModel = Kwf_Model_Abstract::getInstance('Speakers');
        if ($ret['row']->coordinator) {
            $ret['coordinator'] = $speakerModel->getRow($ret['row']->coordinator);
        }
        if ($ret['row']->talk_organiser) {
            $ret['talk_organiser'] = $speakerModel->getRow($ret['row']->talk_organiser);
        }
        return $ret;
    }
}
