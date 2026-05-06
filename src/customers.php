<?php
include_once("database.php");

Class Customers extends Database
{
    function GetAllCustomers()
    {
        $query = "SELECT * FROM customers";
        $result = parent::voerQueryUit($query);
        return $result;
    }

    function GetCustomerOnId($id) {
        $query = "SELECT * FROM customers WHERE id = ?";
        $params = [$id];
        $result = parent::voerQueryUit($query, $params);

        if (count($result) > 0) {
            return $result[0];
        } else {
            return false;
        }
    }

    function GetCustomersOnFirstName($firstName)
    {
        $query = "SELECT * FROM customers WHERE firstName LIKE ?";
        $params = ["%$firstName%"];
        $result = parent::voerQueryUit($query, $params);
        return $result;
    }
    function GetCustomersOnLastName($lastName)
    {
        $query = "SELECT * FROM customers WHERE lastName LIKE ?";
        $params = ["%$lastName%"];
        $result = parent::voerQueryUit($query, $params);
        return $result;
    }
    function GetCustomersOnAddress($address)
    {
        $query = "SELECT * FROM customers WHERE address LIKE ?";
        $params = ["%$address%"];
        $result = parent::voerQueryUit($query, $params);
        return $result;
    }

    function GetCustomersOnName($name)
    {
        $query = "SELECT * FROM customers WHERE firstName LIKE ? OR lastName LIKE ?";
        $params = ["%$name%", "%$name%"];
        $result = parent::voerQueryUit($query, $params);
        return $result;
    }

    function insertCustomer($firstName, $lastName, $email, $phone, $address)
    {
    if($firstName == "" || $lastName == "" || $email == "" || $phone == "" || $address == "")
    { 
        return false;
    }

    $query = "INSERT INTO customers (firstName, lastName, email, phone, address) VALUES (?, ?, ?, ?, ?)";

    $params = [$firstName, $lastName, $email, $phone, $address];


    return parent::voerQueryUit($query, $params) > 0;

    }

    function UpdateCustomerAddress($id, $address) {
        $query = "UPDATE customers SET address = ? WHERE id = ?";
        $params = [$address, $id];
        $result = parent::voerQueryUit($query, $params);
        return $result;
    }
}
?>