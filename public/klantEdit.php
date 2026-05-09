<?php
if (!isset($_GET["id"])) {
    header("location: klanten.php");
}

include("../src/customers.php");
$customers = new Customers;

if (isset($_POST["verzenden"])) {
    $customers->UpdateCustomerAddress($_GET["id"], $_POST["address"]);

    echo "Adress bijgewerkt";
}

$customer = $customers->GetCustomerOnId($_GET["id"]);

if ($customer == false) {
    header("location: klanten.php");
}
?>

<form action="" method="post">
    <label for="firstName">Voornaam</label>
    <input type="text" name="firstName" id="" value="<?= $customer["firstName"] ?>" disabled><br>

    <label for="lastName">Achternaam</label>
    <input type="text" name="lastName" id="" value="<?= $customer["lastName"] ?>" disabled><br>

    <label for="email">Email</label>
    <input type="email" name="email" id="" value="<?= $customer["email"] ?>" disabled><br>

    <label for="phone">Telefoon</label>
    <input type="text" name="phone" id="" value="<?= $customer["phone"] ?>" disabled><br>

    <label for="address">Addres</label>
    <input type="text" name="address" id="" value="<?= $customer["address"] ?>"><br>
    <input type="submit" name="verzenden" value="bewerk">
</form>

<a href="klanten.php">Terug</a>