<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
}
include("../src/customers.php");

$customers = new Customers();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klant Toevoegen</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<header class="container">
    <div>
        <h1>Klant Toevoegen</h1>
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
        Voornaam<br><input type="text" name="firstName"><br>
        Achternaam<br><input type="text" name="lastName"><br>
        Email<br><input type="text" name="email"><br>
        Telefoonnummer<br><input type="text" name="phone"><br>
        Adres<br><input type="text" name="address"><br>
        <input type="submit" value="Nieuw account aanmaken" name="opslaan"><br>
    </form>
    <a href="index.php" class="button">Terug</a><br>
</section>

<?php
if (isset($_POST['opslaan'])) {
    $customers->insertCustomer($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['phone'], $_POST['address']);
    header("Location: klanten.php");
}
// $alleCustomers = $customers->getAllCustomers();
// print_r($alleCustomers);
?>