<?php
class Rows_User extends Kwf_User_Row
{
    public function validatePassword($password)
    {
        if ($this->use_wp_login) {
            // validate with phpass
            require_once 'app/PasswordHash.php';
            $hasher = new PasswordHash(8, false);
            return $hasher->CheckPassword($password, $this->wp_pass);
        } else {
            return parent::validatePassword($password);
        }
    }

    public function setPassword($password)
    {
        parent::setPassword($password);
        $this->use_wp_login = 0;
    }
}
