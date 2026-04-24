<?php
include_once("database.php");

Class Authenticate extends Database
{
    function IsUserAvailable()
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $result = parent::voerQueryUit($query);
        return $result;
    }
}
?>