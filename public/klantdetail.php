<?php
session_start();
$id = $_GET['id'];
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
}

include("../src/customers.php");
include("../src/jobs.php");

$customers = new Customers;

if (isset($_POST['veranderAdres'])) {
    if (isset($_POST['nieuwAdres'])) {
        $customers->updateCustomerAdres($id, $_POST['nieuwAdres']);
    }
}

$customer = $customers->GetCustomerOnID($id);

$firstName = $customer['firstName'];
$lastName = $customer['lastName'];
$email = $customer['email'];
$phone = $customer['phone'];
$address = $customer['address'];

echo "<h1>$firstName $lastName</h1>";
echo "<p>Email: $email<br>Telefoon: $phone<br>Adres: $address</p>";

?>
<form action="" method="POST">
    Verander adres: <input type="text" name="nieuwAdres"><br>
    <input type="submit" value="Verander adres" name="veranderAdres"><br><br>
</form>

<?php
echo ("<a href='newJob.php?id=$id'>Nieuwe klus</a>");

$jobs = new Jobs;

if (isset($_POST["updateJob"])) {
    $send = 0;
    $paid = 0;
    if (isset($_POST["send"])) {
        $send = 1;
    }
    if (isset($_POST["paid"])) {
        $paid = 1;
    }

    $jobs->updateInvoiceSendAndPaid($send, $paid, $_POST["id"]);
}

$tasks = $jobs->GetAllJobsWithCustomerID($id);
?>

<table border='1'>
    <thead>
        <tr>
            <td>Titel</td>
            <td>Beschrijving</td>
            <td>Locatie</td>
            <td>Factuur Verstuurd</td>
            <td>Factuur Betaald</td>
            <td>Update</td>
        </tr>
        <?php foreach ($tasks as $t): ?>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $t['id'] ?>">
                <tr>
                    <td><?= $t['title'] ?></td>
                    <td><?= $t['description'] ?></td>
                    <td><?= $t['location'] ?></td>
                    <td><input type="checkbox" name="send" <?php if ($t['invoiceSent'] == 1) echo "checked" ?>></td>
                    <td><input type="checkbox" name="paid" <?php if ($t['paid'] == 1) echo "checked" ?>></td>
                    <td><input type="submit" name="updateJob" value="update"></td>
                </tr>
            </form>
        <?php endforeach ?>
    </thead>
    <tbody>
        <a href="klanten.php">Terug</a>