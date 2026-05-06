<?php
if (!isset($_SESSION["email"])) {
    header("login.php");
}
?>

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
    echo "<tr>";
    $name = $r["name"];
    echo "<td>$name</td>";
    $quantity = $r["quantity"];
    echo "<td>$quantity</td>";
    echo "</tr>";
}
?>
    </tbody>
</table>
