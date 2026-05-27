<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
}
?>

<style>
    .low {
        background-color: orange;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voorraad</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<header class="container">
    <div>
        <h1>Voorraad</h1>
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
    <a href="newStock.php" class="button">Pas voorraad aan</a>
    <table border="1">
        <thead>
            <tr>
                <td>Wat</td>
                <td>Hoeveel</td>
            </tr>
        </thead>
        <tbody>
            <?php
            include("../src/stock.php");
            $stock = new Stock;
            // hier komt de code voor het maken van de tabel
            $result = $stock->GetAllStock();
            foreach ($result as $r) {
                $quantity = $r["quantity"];
                echo "<tr";
                if ($quantity <= 3) {
                    echo " class='low'";
                }
                echo ">";
                $name = $r["name"];
                echo "<td>$name</td>";
                echo "<td>$quantity</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.php" class="button">Terug</a>
</section>

<script>
    const low = document.getElementsByClassName("low");
    if (low.length > 0) {
        var alertText = "Je hebt weinig voorraad van de volgende: "
        Array.from(low).forEach(element => {
            const material = element.children[0].textContent
            alertText += material + ", "
        });
        alert(alertText);
    }

    //  
</script>