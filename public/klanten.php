<h1>Alle Klanten</h1>

<p>Klik <a href="index.php">hier</a> om terug te gaan.</p>
<p>Klik <a href="">hier</a> om een klant toe te voegen.</p>

<table>
    <thead>
        <tr>
            <td>Naam</td>
            <td>Email</td>
            <td>Telefoon</td>
            <td>Adres</td>
        </tr>
    </thead>
<?php
include("../src/customers.php");
$customers = new Customers;
// hier komt de code voor het maken van de tabel
?>
</table>