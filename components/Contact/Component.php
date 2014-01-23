<?php
class Contact_Component extends Kwc_Form_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trl('Kontakt-Formular');
        $ret['generators']['child']['component']['header'] = 'Contact_Header_Component';
        $ret['placeholder']['submitButton'] = trlStatic('Abschicken');
        return $ret;
    }
}
