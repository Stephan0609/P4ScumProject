<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("login.php");
}
include("../src/stock.php");
$stock = new Stock;
$allStock = $stock->GetAllStock();
?>
<form action="" method="POST">
    Naam: <input type="text" name="name"><br>
    Hoeveelheid: <input type="number" name="quantity"><br>
    <input type="submit" value="Aan voorraad toevoegen" name="opslaan"><br>
    <input type="submit" value="Voorraad aanpassen" name="update"><br>
    <input type="submit" value="Verwijder uit voorraad" name="delete"><br>
</form>
<a href="voorraad.php">Terug</a><br>
<?php
if(isset($_POST['opslaan']))
    {
        if(isset($_POST['name']) && isset($_POST['quantity']))
            {
                if(!isInStock($_POST['name'], $allStock))
                    {
                        $quantity = (int)$_POST['quantity'];
                        $stock->insertStock($_POST['name'], $quantity);
                        header("Location: voorraad.php");
                    }
            }
    }

elseif(isset($_POST['update']))
    {
        if(isset($_POST['name']) && isset($_POST['quantity']))
            {
                if(isInStock($_POST['name'], $allStock))
                    {
                        $quantity = (int)$_POST['quantity'];
                        $stock->updateStock($_POST['name'], $quantity);
                        header("Location: voorraad.php");
                    }
            }
    }

elseif(isset($_POST['delete']))
    {
        if(isset($_POST['name']))
            {
                if(isInStock($_POST['name'], $allStock))
                    {
                        $stock->deleteFromStock($_POST['name']);
                        header("Location: voorraad.php");
                    }
            }
    }



function isInStock($naam, $allStock)
{
    foreach($allStock as $currentStock)
        {
            if(strtolower($currentStock['name']) == strtolower($naam))
                {
                    return true;
                }
        }
    return false;
}
?>