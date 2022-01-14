<?php

class Admindata
{
    protected $_id, $_email, $_pwd;

    public function __construct($dbRow)
    {
        $this->_id = $dbRow['adminID'];
        $this->_pwd = $dbRow['adminPassword'];
        $this->_email = $dbRow['adminEmail'];
    }
    public function getID()
    {
        return $this->_id;
    }
    public function getEmail(){
        return $this->_email;
    }

    public function getPassword(){
        return $this->_pwd;
    }



}