<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
}
include("../src/stock.php");
$stock = new Stock;
$allStock = $stock->GetAllStock();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voorraad aanpassen</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<header class="container">
    <div>
        <h1>Voorraad aanpassen</h1>
        <nav>
            <ul>
                <li><a href="klanten.php">Klanten</a></li>
                <li><a href="voorraad.php">Voorraad</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
</header>

<section class="container">

<form action="" method="POST">
    Naam:<br><input type="text" name="name"><br>
    Hoeveelheid:<br><input type="number" name="quantity"><br>
    <input type="submit" value="Aan voorraad toevoegen" name="opslaan"><br>
    <input type="submit" value="Voorraad aanpassen" name="update"><br>
    <input type="submit" value="Verwijder uit voorraad" name="delete"><br>
</form>
<a href="voorraad.php" class="button">Terug</a><br>
</section>
<?php
if (isset($_POST['opslaan'])) {
    if (isset($_POST['name']) && isset($_POST['quantity'])) {
        if (!isInStock($_POST['name'], $allStock)) {
            $quantity = (int)$_POST['quantity'];
            $stock->insertStock($_POST['name'], $quantity);
            header("Location: voorraad.php");
        }
    }
} elseif (isset($_POST['update'])) {
    if (isset($_POST['name']) && isset($_POST['quantity'])) {
        if (isInStock($_POST['name'], $allStock)) {
            $quantity = (int)$_POST['quantity'];
            $stock->updateStock($_POST['name'], $quantity);
            header("Location: voorraad.php");
        }
    }
} elseif (isset($_POST['delete'])) {
    if (isset($_POST['name'])) {
        if (isInStock($_POST['name'], $allStock)) {
            $stock->deleteFromStock($_POST['name']);
            header("Location: voorraad.php");
        }
    }
}



function isInStock($naam, $allStock)
{
    foreach ($allStock as $currentStock) {
        if (strtolower($currentStock['name']) == strtolower($naam)) {
            return true;
        }
    }
    return false;
}
?>