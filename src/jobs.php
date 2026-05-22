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

    function addJob($description, $date, $customerId, $title, $location, $paid, $worked, $invoice, $cost, $inkopen, $voorrijKosten)
    {
    if($description == "" || $date == "" || $customerId == "" || $title == "" || $location == "" || $worked == "")
    { 
        return false;
    }

    $query = "INSERT INTO jobs (description, date, customerId, title, location, paid, hoursWorked, invoiceSent, totalCost, boughtMaterials, callOutFee) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $params = [$description, $date, $customerId, $title, $location, $paid, $worked, $invoice, $cost, $inkopen, $voorrijKosten];


    return parent::voerQueryUit($query, $params) > 0;

    }

    function updateInvoiceSendAndPaid($send, $payed, $id) {
        $query = "UPDATE jobs SET invoiceSent = ?, paid = ? WHERE id = ?";
        $params = [$send, $payed, $id];
        parent::voerQueryUit($query, $params);
    }
}
?>