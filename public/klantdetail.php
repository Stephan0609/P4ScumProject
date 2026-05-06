<?php
include("../src/customers.php");

$customers = new Customers;

$customer = $customers->GetCustomerOnID($_GET['id']);

$firstName = $customer['firstName'];
$lastName = $customer['lastName'];
$email = $customer['email'];
$phone = $customer['phone'];
$address = $customer['address'];

echo "<h1>$firstName $lastName</h1>";
echo "<p>Email: $email<br>Telefoon: $phone<br>Adres: $address</p>";

?>