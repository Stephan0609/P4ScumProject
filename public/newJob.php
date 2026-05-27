<?php
session_start();
$id = $_GET['id'];
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
}

include("../src/customers.php");
include("../src/jobs.php");
include("../src/stock.php");
include("../src/usedMaterial.php");
$stock = new Stock;
$fullStock = $stock->GetAllStock();

$customers = new Customers;
$customer = $customers->GetCustomerOnID($id);

$materials = new UsedMaterial;
$usedMaterials = $materials->GetUsedMaterials($id);


$jobs = new Jobs;
$tasks = $jobs->GetAllJobsWithCustomerID($id);


?>
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


    <form action="" method="POST">
        Titel:<br><input type="text" name="title"><br>
        Omschrijving:<br><textarea name="omschrijving" id=""></textarea><br>
        Datum:<br><input type="date" name="date"><br>
        Locatie:<br><input type="text" name="location"><br>
        Uren gewerkt:<br><input type="number" value="0" name="hours"><br>
        Voorrijkosten:<br><input type="number" step=".01" value="0" name="voorrijKosten"><br>
        Totale kosten:<br><input type="number" step=".01" value="0" name="totalCost"><br>
        <input type="checkbox" name="paid">Betaald<br>
        <input type="checkbox" name="invoice">Vacatuur gestuurd<br>
        <input type="checkbox" name="inkopen">Moest extra materialen kopen<br>

        <input type="submit" name="addJob" value="Maak klus"><br>
    </form>
    <?php
    if (
        isset($_POST['addJob']) && isset($_POST['omschrijving']) && isset($_POST['date']) && isset($_POST['title']) && isset($_POST['location'])
        && isset($_POST['hours'])
    ) {
        if (!isset($_POST['voorrijKosten']))
            $_POST['voorrijKosten'] = 0;
        $paid = isset($_POST['paid']) ? 1 : 0;
        $invoiceSent = isset($_POST['invoice']) ? 1 : 0;
        $inkopen = isset($_POST['inkopen']) ? 1 : 0;
        $jobs->addJob($_POST['omschrijving'], $_POST['date'], $id, $_POST['title'], $_POST['location'], $paid, $_POST['hours'], $invoiceSent, $_POST['totalCost'], $inkopen, $_POST['voorrijKosten']);
        header("Location: klantdetail.php?id=$id");
    }


    echo "</tbody></table><br>";
    // echo '<input type="submit" name="changeQuantity" value="Verander hoeveel"><br>';
    echo "Alle gebruikte materialen:<br>";
    if ($usedMaterials != []) {
        echo "<table class='klantDetailTable'><thead><tr>
        <td>Naam</td><td>Hoeveel</td>
        </tr></thead><tbody>";
        foreach ($usedMaterials as $m) {
            echo "<tr>";
            $name = $m['name'];
            echo "<td>$name</td>";
            $quantity = $m['quantity'];
            echo "<td>$quantity</td>";
        }
        echo "</tbody></table>";
    } else {
        echo ("er zijn nog geen gebruikte materialen <br><br>");
    }
    ?>
    <form action="" method="POST">
        Materiaal toevoegen aan klus:<br>
        Naam: <input type="text" name="name"><br>
        Hoeveel: <input type="number" name="quantity"><br>

        <input type="submit" name="addMaterial" value="Voeg materiaal toe"><br>
    </form>
    <a href='klantdetail.php?id=<?= $id ?>' class="button">Terug</a>
</section>
<?php
if (isset($_POST['addMaterial']) && isset($_POST['name']) && isset($_POST['quantity'])) {
    $materials->addMaterial($_POST['name'], $_POST['quantity'], $id);
}
