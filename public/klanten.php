<h1>Alle Klanten</h1>

<p>Klik <a href="index.php">hier</a> om terug te gaan.</p>
<p>Klik <a href="">hier</a> om een klant toe te voegen.</p>

<form action="" method="post">
    <p>Zoek op: </p>
    <input type="text" name="search" value="<?php if(isset($_POST['search'])) {echo $_POST['search'];} ?>"><br>
    <input type="submit" value="Naam" name="name">
    <input type="submit" value="Voornaam" name="firstName">
    <input type="submit" value="Achternaam" name="lastName">
    <input type="submit" value="Adres" name="address">
</form>

<table>
    <thead>
        <tr>
            <td>Naam</td>
            <td>Email</td>
            <td>Telefoon</td>
            <td>Adres</td>
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
    $name = $r['firstName'] + " " + $r['lastName'];
    echo "<td>$name</td>";
    $email = $r['email'];
    echo "<td>$email</td>";
    $phone = $r['phone'];
    echo "<td>$phone</td>";
    $address = $r['address'];
    echo "<td>$address</td>";
    echo "</tr>";
}

?>
    </tbody>
</table>