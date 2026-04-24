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

    public function insertCustomer($firstName, $lastName, $email, $phone, $address)
    {
    if($firstName == "" || $lastName == "" || $email == "" || $phone == "" || $address == "")
    { 
        return false;
    }

    $query = "INSERT INTO customers (firstName, lastName, email, phone, address) VALUES (?, ?, ?, ?, ?)";

    $params = [$firstName, $lastName, $email, $phone, $address];


    return parent::voerQueryUit($query, $params) > 0;

    }
}
?>