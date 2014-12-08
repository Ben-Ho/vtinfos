<?php
class Forms_Speaker_Component extends Kwc_Form_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlStatic('Rednerformular');
        $ret['generators']['child']['component']['success'] = 'Forms_Speaker_Success_Component';
        $ret['placeholder']['submitButton'] = trlStatic('Anlegen');
        $ret['viewCache'] = false;
        $ret['useAjaxRequest'] = false;
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    protected function _beforeInsert(Kwf_Model_Row_Interface $row)
    {
        parent::_beforeInsert($row);
        $user = Kwf_Registry::get('userModel')->getAuthedUser();
        if ($user->congregation_id) {
            $row->congregation_id = $user->congregation_id;
        } else {
            throw new Kwf_ClientException(trl('Dir ist keine Versammlung zugewiesen. Deswegen kannst du keine Redner anlegen.'));
        }
    }
}
