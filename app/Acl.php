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

        $this->add(new Kwf_Acl_Resource_MenuUrl('kwf_trl_web',
                array('text'=>trlKwf('Translation Web'), 'icon'=>'comment.png'),
                '/kwf/trl/web'), 'settings');
        $this->add(new Zend_Acl_Resource('kwf_trl_web-edit'), 'kwf_trl_web');
        $this->add(new Kwf_Acl_Resource_MenuUrl('kwf_trl_kwf',
                array('text'=>trlKwf('Translation Common'), 'icon'=>'comment.png'),
                '/kwf/trl/kwf'), 'settings');
        $this->add(new Zend_Acl_Resource('kwf_trl_kwf-edit'), 'kwf_trl_kwf');

        $this->addRole(new Kwf_Acl_Role('talk-organiser', trl('Vortragseinteiler')));
        $this->add(new Kwf_Acl_Resource_EditRole('edit_role_talk-organiser', 'talk-organiser'), 'edit_role');
        $this->allow('talk-organiser', 'edit_role_talk-organiser');

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
            $this->addResource(new Zend_Acl_Resource('talks_talk-translations'), 'talks_circles');
        $this->allow('admin', 'talks_circles');
    }
}
