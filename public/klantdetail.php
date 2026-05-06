<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("login.php");
}

include("../src/customers.php");
include("../src/jobs.php");

$customers = new Customers;

$customer = $customers->GetCustomerOnID($_GET['id']);

$firstName = $customer['firstName'];
$lastName = $customer['lastName'];
$email = $customer['email'];
$phone = $customer['phone'];
$address = $customer['address'];

echo "<h1>$firstName $lastName</h1>";
echo "<p>Email: $email<br>Telefoon: $phone<br>Adres: $address</p>";

$jobs = new Jobs;
$tasks = $jobs->GetAllJobsWithCustomerID($_GET['id']);
echo "<table><thead><tr>
<td>Titel</td><td>Beschrijving</td><td>Locatie</td>
</tr></thead><tbody>";
foreach ($tasks as $t) {
    echo "<tr>";
    $title = $t['title'];
    echo "<td>$title</td>";
    $desc = $t['description'];
    echo "<td>$desc</td>";
    $loc = $t['location'];
    echo "<td>$loc</td>";
    echo "</tr>";
}
echo "</tbody></table>";
?>