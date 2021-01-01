<?php
require_once "database.php";
abstract class person
{
    public $name;
    public $family;

    function getName()
    {
        return $this->name;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function getFamily()
    {
        return $this->family;
    }

    function setFamily($family)
    {
        $this->family = $family;
    }
}

class user extends person
{
    private $username;
    private $password;
    private $email;

    function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    function getPassword()
    {
        return $this->password;
    }

    function setPassword($password, $hashit=true)
    {
        if($hashit)
            $this->password = md5($password);
        else
            $this->password = $password;
    }

    function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    function checkUserPass()
    {
        $paramTypes = "ss";
        $Parameters = array($this->username, $this->password);
        $result = database::ExecuteQuery('CheckUserPass', $paramTypes, $Parameters);

        if(mysqli_num_rows($result) > 0)
        {
            $row = $result->fetch_array();
            $this->setName($row["Name"]);
            $this->setFamily($row["Family"]);
            return true;
        }
        return false;
    }

    private function getUserAsaText()
    {
        return $this->username.' '.$this->password.' '.$this->name.' '.$this->family.PHP_EOL;
    }

    private function IsUsernameExist()
    {
        $paramTypes = "s";
        $Parameters = array($this->username);
        $result = database::ExecuteQuery('IsUsernameExist', $paramTypes, $Parameters);

        if(mysqli_num_rows($result) > 0)
              return true;
        return false;
    }

    function Save()
    {
        if(!$this->IsUsernameExist()) {
            $paramTypes = "ssss";
            $Parameters = array($this->username, $this->password,
                $this->name, $this->family);
            database::ExecuteQuery('AddUser', $paramTypes, $Parameters);
            return true;
        }
        return false;
    }
    public function jsonSerialize(){
        return get_object_vars($this);
    }

    public static function GetAllUsers()
    {
        $result = database::ExecuteQuery('GetAllUsers');
        $usersList = array();
        $i = 0;
        while ($row = $result->fetch_array())
        {
            $tempUser = new user();
            $tempUser->setUsername($row['Username']);
            $tempUser->setName($row['Name']);
            $tempUser->setFamily($row['Family']);
            $usersList[$i++] = $tempUser->jsonSerialize();
        }
        return $usersList;
    }
}