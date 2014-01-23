<?php
class Contact_FrontendForm extends Kwf_Form
{
    protected function _beforeInsert(Kwf_Model_Row_Interface $row)
    {
        $user = Kwf_Registry::get('userModel')->getAuthedUser();
        $row->firstname = $user->firstname;
        $row->lastname = $user->lastname;
        $row->email = $user->email;
        parent::_beforeInsert($row);
    }

    protected function _beforeSave(Kwf_Model_Row_Interface $row)
    {
        if (isset($_SERVER['HTTP_HOST'])) {
            $host = $_SERVER['HTTP_HOST'];
        } else {
            $host = Kwf_Registry::get('config')->server->domain;
        }

        $row->addTo('benjamin.hohenwarter@gmail.com');
        $row->setFrom($row->email);
        $row->subject = trl('Anfrage auf {0}',$host);
        parent::_beforeSave($row);
    }

    protected function _init()
    {
        $this->setModel(new Kwf_Model_Mail(array('tpl' => 'Contact')));

        $this->add(new Kwf_Form_Field_Select('topic', trlStatic('Grund')))
            ->setValues(array(//(neue Versammlung, Fehler auf der Seite, Wünsche, Sonstiges)
                'newCongregation' => trlStatic('Neue Versammlung'),
                'bug' => trlStatic('Fehler auf Seite gefunden'),
                'wishes' => trlStatic('Wunsch'),
                'miscellaneous' => trlStatic('Sonstiges')
            ));
        $this->add(new Kwf_Form_Field_TextArea('content', trlKwfStatic('Message')))
            ->setWidth(255)
            ->setHeight(120)
            ->setAllowBlank(false);
        parent::_init();
    }
}
