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

    function insertStock($name, $quantity)
    {
    if($name == "" || $quantity == "")
    { 
        return false;
    }

    $query = "INSERT INTO stock (name, quantity) VALUES (?, ?)";

    $params = [$name, $quantity];


    return parent::voerQueryUit($query, $params) > 0;

    }

    function updateStock($name, $quantity)
    {
    if($name == "" || $quantity == "")
    { 
        return false;
    }

    $query = "UPDATE stock SET quantity = ? WHERE name = ?";

    $params = [$quantity, $name];


    return parent::voerQueryUit($query, $params) > 0;
    }



    function deleteFromStock($name)
    {
    if($name == "")
    { 
        return false;
    }

    $query = "DELETE FROM stock WHERE name = ?";

    $params = [$name];


    return parent::voerQueryUit($query, $params) > 0;
    }
}
?>