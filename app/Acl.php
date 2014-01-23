<?php
class Acl extends Kwf_Acl_Component
{
    public function __construct()
    {
        parent::__construct();

        // User Administration
//         $this->add(new Kwf_Acl_Resource_MenuUrl('kwf_user_users',
//                 array('text'=>trlKwf('Useradministration'), 'icon'=>'user.png'),
//                 '/kwf/user/users'));
//             $this->add(new Zend_Acl_Resource('kwf_user_user'), 'kwf_user_users');
//             $this->add(new Zend_Acl_Resource('kwf_user_log'), 'kwf_user_users');
//             $this->add(new Zend_Acl_Resource('kwf_user_comments'), 'kwf_user_users');

        // Admin
        $this->allow('admin', 'kwf_user_changeuser');
        $this->allow('admin', 'kwf_user_users');

        $this->addResource(new Kwf_Acl_Resource_MenuUrl('talks_talks',
            array('text' => trl('Vortragsthemen')),
            '/admin/talks/talks'));
        $this->allow('admin', 'talks_talks');


        $this->addResource(new Kwf_Acl_Resource_MenuUrl('talks_circles',
                array('text' => trl('Kreise')),
                '/admin/talks/circles'));
            $this->addResource(new Zend_Acl_Resource('talks_congregations'), 'talks_circles');
            $this->addResource(new Zend_Acl_Resource('talks_speakers'), 'talks_circles');
            $this->addResource(new Zend_Acl_Resource('talks_speakers-to-talks'), 'talks_circles');
            $this->addResource(new Zend_Acl_Resource('talks_circle-groups'), 'talks_circles');
        $this->allow('admin', 'talks_circles');
    }
}
