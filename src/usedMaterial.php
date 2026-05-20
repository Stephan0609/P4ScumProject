<?php
include_once("database.php");

Class UsedMaterial extends Database
{
    function GetUsedMaterials($id)
    {
        $query = "SELECT * FROM usedmaterial WHERE jobId = ?";
        $params = [$id];
        $result = parent::voerQueryUit($query, $params);
        return $result;
    }

    function addMaterial($name, $quantity, $id)
    {
    if($name == "" || $quantity == "")
    { 
        return false;
    }

    $query = "INSERT INTO usedmaterial (name, quantity, jobId) VALUES (?, ?, ?)";

    $params = [$name, $quantity, $id];


    return parent::voerQueryUit($query, $params) > 0;

    }
}