<?php
include("../src/customers.php");

$customers = new Customers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        Voornaam: <input type="text" name="firstName"><br>
        Achternaam: <input type="text" name="lastName"><br>
        Email: <input type="text" name="email"><br>
        Telefoonnummer: <input type="text" name="phone"><br>
        Adres: <input type="text" name="address"><br>
        <input type="submit" value="New account aanmaken" name="opslaan"><br>
    </form>
    <a href="index.php">Terug</a><br>
</body>
</html>
<?php
if(isset($_POST['opslaan']))
    {
        $customers->insertCustomer($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['phone'], $_POST['address']);
        header("Location: klanten.php");
    }
    // $alleCustomers = $customers->getAllCustomers();
    // print_r($alleCustomers);
?>