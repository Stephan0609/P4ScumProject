<?php
include_once("database.php");

Class Authenticate extends Database
{
    function IsUserAvailable()
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $result = parent::voerQueryUit($query);
        
        if (count($result) > 0) {
            return false;
        }

        return true;
    }

    function InsertUser($email, $password) {
        $query = "INSERT INTO users (email, password) VALUES(?, ?)";
        $params = [$email, password_hash($password, PASSWORD_DEFAULT)];
        parent::voerQueryUit($query, $params);
    }

    function UserLogin($email, $password) {
        $query = "SELECT * FROM users WHERE email = ?";
        $params = [$email];

        $result = parent::voerQueryUit($query, $params);

        if (count($result) > 0 && password_verify($password, $result[0]["password"],)) {
            return $result[0]["email"];
        } else {
            return false;
        }
    }
}
?>