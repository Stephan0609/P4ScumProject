<?php
include_once("database.php");

Class Stock extends Database
{
    function GetAllStock()
    {
        $query = "SELECT * FROM stock";
        $result = parent::voerQueryUit($query);
        return $result;
    }
}
?>