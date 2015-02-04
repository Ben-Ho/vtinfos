<?php
class Login_Form_Component extends Kwc_User_Login_Form_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['placeholder']['submitButton'] = trlStatic('Anmelden');
        $ret['generators']['child']['component']['footer'] = 'Login_Form_Contact_Component';
        return $ret;
    }

    protected function _afterSave(Kwf_Model_Row_Interface $row)
    {
        if (strpos($row->text, '@') !== false) {
            $row->email = $row->text;
        } else {
            $userSelect = new Kwf_Model_Select();
            $userSelect->whereEquals('wp_user', $row->text);
            $userRows = Kwf_Registry::get('userModel')->getRows($userSelect);
            if (count($userRows) > 1) {
                $this->_errors[] = array('message' => $this->getData()->trl('Diesem Benutzernamen sind mehrere Benutzer zugeordnet. Bitte melde dich mit deiner E-Mail-Adresse ein.'));
                return;
            }
            $row->email = $userRows[0]->email;
        }
        parent::_afterSave($row);
    }

    private function _getAuthenticateResult($identity, $credential)
    {
        $adapter = new Kwf_Auth_Adapter_Service();
        $adapter->setIdentity($identity);
        $adapter->setCredential($credential);

        $auth = Kwf_Auth::getInstance();
        $auth->clearIdentity();
        return $auth->authenticate($adapter);
    }
}
