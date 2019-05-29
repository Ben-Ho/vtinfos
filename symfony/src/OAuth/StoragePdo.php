<?php
namespace App\OAuth;

use Symfony\Component\Config\Definition\Exception\Exception;

class StoragePdo extends \OAuth2\Storage\Pdo
{
    public function __construct(array $config = array())
    {
        $connection = \Kwf_Registry::get('db')->getConnection();
        parent::__construct($connection, $config);
    }

    public function getUser($username)
    {
        $select = new \Kwf_Model_Select();
        $select->whereEquals('email', $username);
        $userRow = \Kwf_Registry::get('userModel')->getRow($select);
        if (!$userRow) return false;
        $userData = $userRow->toArray();
        $userData['user_id'] = $userData['id'];
        return $userData;
    }

    public function setUser($username, $password, $firstName = null, $lastName = null)
    {
        throw new \Kwf_Exception_NotYetImplemented();
    }

    protected function checkPassword($userRow, $password)
    {
        return \Kwf_Registry::get('userModel')->getRow($userRow['user_id'])->validatePassword($password);
    }
}
