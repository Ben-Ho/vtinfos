<?php
class Login_Form_Component extends Kwc_User_Login_Form_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['placeholder']['submitButton'] = trlStatic('Anmelden');
        return $ret;
    }

    protected function _afterSave(Kwf_Model_Row_Interface $row)
    {
        $tryLogin = false;
        if (strpos($row->text, '@') !== false) {
            $tryLogin = true;
            $row->email = $row->text;
        } else {
            $splited = explode(' ', $row->text);
            if (count($splited) == 2) {
                //Firstname and Lastname will
                $firstname = $splited[0];
                $lastname = $splited[1];
                $select = new Kwf_Model_Select();
                $select->whereEquals('firstname', $firstname);
                $select->whereEquals('lastname', $lastname);
                $rows = Kwf_Registry::get('userModel')->getRows($select);
                foreach ($rows as $user) {
                    $result = $this->_getAuthenticateResult($user->email, $row->password);
                    if ($result->isValid()) {
                        $row->email = $user->email;
                        $tryLogin = true;
                        break;
                    }
                }
            }
        }
        if ($tryLogin) {
            parent::_afterSave($row);
        } else {
            $this->_errors[] = array('message' => $this->getData()->trl('Bitte geben Sie Ihre korrekten Zugangsdaten ein!'));
        }
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
