<?php

class UserData
{
    protected $_id, $_FirstName, $_LastName, $_email, $_pwd, $_DoB, $_gender;

    public function __construct($dbRow)
    {
        $this->_id = $dbRow['id'];
        $this->_FirstName = $dbRow['first_name'];
        $this->_LastName = $dbRow['last_name'];
        $this->_pwd = $dbRow['password'];
        $this->_DoB = $dbRow['DoB'];
        $this->_email = $dbRow['email'];
        $this->_gender = $dbRow['gender'];



    }
    public function getID()
    {
        return $this->_id;
    }

    public function getFirstName()
    {
        return $this->_FirstName;
    }

    public function getLastName()
    {
        return $this->_LastName;
    }

    public function getEmail(){
        return $this->_email;
    }

    public function getPassword(){
        return $this->_pwd;
    }

    public function getDoB(){
        return $this->_DoB;
    }

    public function getGender(){
        return $this->_gender;
    }



}