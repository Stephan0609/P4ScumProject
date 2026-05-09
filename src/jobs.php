<?php
include_once("database.php");

class Jobs extends Database
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

    function addJob($description, $date, $customerId, $title, $location, $paid)
    {
    if($description == "" || $date == "" || $customerId == "" || $title == "" || $location == "")
    { 
        return false;
    }

    $query = "INSERT INTO jobs (description, date, customerId, title, location, paid) VALUES (?, ?, ?, ?, ?, ?)";

    $params = [$description, $date, $customerId, $title, $location, $paid];


    return parent::voerQueryUit($query, $params) > 0;

    }
}
?>