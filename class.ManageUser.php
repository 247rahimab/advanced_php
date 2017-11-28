<?php
require_once 'class.Database.php';
class MangeUser {
    protected $dbLink;

    function __construct()
    {
        $dbConnectionObj = new Database();
        $this->dbLink = $dbConnectionObj->dbConnection();
        return $this->dbLink;
    }

    function registerUser($username, $password, $email, $ipAddress, $time, $date){
        $stmt = $this->dbLink->prepare("INSERT INTO users(username, password, email, ipAddress, time, date) VALUES (:username, :password, :email, :ipAddress, :time, :date)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':ipAddress', $ipAddress);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $rowCnt = $stmt->rowCount();
        return $rowCnt;
    }

    function loginUser($username, $password){
        $stmt = $this->dbLink->query("SELECT * FROM users WHERE username= '$username' AND password = '$password'");
        $stmt->execute();
        $row = $stmt->rowCount();
        return $row;
    }
    function  getUserInfo(){
        $stmt = $this->dbLink->query("SELECT * FROM users");
        $affect = $stmt->rowCount();
        $info = array();
        if($stmt->execute())
        {
            while ($result = $stmt->fetch())
            {
                $info[] = $result;
            }
            return $info;
        }else{
            return $affect;
        }
    }
}

$objManageUser = new MangeUser();
echo $objManageUser->registerUser('abd', '123', 'abc@gmail.com', '127.0.0.0', '2', '28-11-2017');
$objManageUser->loginUser('rahim','123');
$objManageUser->getUserInfo();