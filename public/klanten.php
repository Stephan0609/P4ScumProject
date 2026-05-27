<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klanten</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<header class="container">
    <div>
        <h1>Klanten</h1>
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
    <div class="zoekVoegKlantToeDiv">
        <form action="" method="post">
            <input type="text" name="search" placeholder="Zoek" value="<?php if (isset($_POST['search'])) {
                                                        echo $_POST['search'];
                                                    } ?>"><br>
            <input type="submit" value="Naam" name="name">
            <input type="submit" value="Voornaam" name="firstName">
            <input type="submit" value="Achternaam" name="lastName">
            <input type="submit" value="Adres" name="address">
        </form>
        <a href="nieuweKlant.php" class="button">Voeg Klant Toe</a>
    </div>

    <table border="1">
        <thead>
            <tr>
                <td>Naam</td>
                <td>Email</td>
                <td>Telefoon</td>
                <td>Adres</td>
                <td>Bekijk</td>
            </tr>
        </thead>
        <tbody>
            <?php
            include("../src/customers.php");
            $customers = new Customers;
            // hier komt de code voor het maken van de tabel
            if (isset($_POST['search'])) {
                $search = $_POST['search'];
            }
            if (isset($_POST['name'])) {
                $result = $customers->GetCustomersOnName($search);
            } elseif (isset($_POST['firstName'])) {
                $result = $customers->GetCustomersOnFirstName($search);
            } elseif (isset($_POST['lastName'])) {
                $result = $customers->GetCustomersOnLastName($search);
            } elseif (isset($_POST['address'])) {
                $result = $customers->GetCustomersOnAddress($search);
            } else {
                $result = $customers->GetAllCustomers();
            }

            foreach ($result as $r) {
                echo "<tr>";
                $name = $r['firstName'] . " " . $r['lastName'];
                echo "<td>$name</td>";
                $email = $r['email'];
                echo "<td>$email</td>";
                $phone = $r['phone'];
                echo "<td>$phone</td>";
                $address = (isset($r['currentaddress'])) ? $r['currentaddress'] : $r['address'];
                echo "<td>$address</td>";
                $id = $r['id'];
                echo "<td><a href='klantdetail.php?id=$id'>Bekijk</a></td>";
                echo "</tr>";
            }

            ?>
        </tbody>
    </table>
</section>