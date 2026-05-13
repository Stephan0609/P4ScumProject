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

<h1>Alle Voorraad</h1>

<p>Klik <a href="index.php">hier</a> om terug te gaan.</p>
<p>Klik <a href="newStock.php">hier</a> om voorraad aan te passen.</p>

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