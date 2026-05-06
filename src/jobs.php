<?php
include_once("database.php");

Class Jobs extends Database
{
    function GetAllJobsWithCustomerID($id)
    {
        $query = "SELECT * FROM jobs WHERE customerId = ?";
        $params = [$id];
        $result = parent::voerQueryUit($query, $params);
        return $result;
    }

    function GetJobOnID($id)
    {
        $query = "SELECT * FROM jobs WHERE id = ?";
        $params = [$id];
        $result = parent::voerQueryUit($query, $params);
        return $result;
    }
}
?>