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
        <h1><?= "$firstName $lastName" ?></h1>
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
    <table class="klantDetailTable" border='1'>
        <tr>
            <td>Email</td>
            <td><?= $email ?></td>
        </tr>
        <tr>
            <td>Telefoon</td>
            <td><?= $phone ?></td>
        </tr>
        <tr>
            <td>Adres</td>
            <td><?= $address ?></td>
        </tr>
    </table>
    <form action="" method="POST">
        <input type="text" name="nieuwAdres">
        <input type="submit" value="Verander adres" name="veranderAdres"><br><br>
    </form>

    <a href='newJob.php?id=<?= $id ?>' class="button">Nieuwe klus</a>
    <?php

    $jobs = new Jobs;

    if (isset($_POST['updateJob'])) {
        $send = 0;
        $paid = 0;

        if (isset($_POST['nieuwAdres'])) {
            $customers->updateCustomerAdres($id, $_POST['nieuwAdres']);
        }
        if (isset($_POST["send"])) {
            $send = 1;

            if ($_POST["previousSendState"] != 1) {
                $jobs->updateInvoiceSendDate($_POST["id"]);
            }
        }

        if (isset($_POST["paid"])) {
            $paid = 1;
        }

        $jobs->updateInvoice($send, $paid, $_POST["id"], $_POST["invoicePaymentTerm"]);
        $jobs->updateDescription($_POST['id'], $_POST['description']);
    }

    $tasks = $jobs->GetAllJobsWithCustomerID($id);
    ?>

    <table border='1'>
        <thead>
            <tr>
                <td>Titel</td>
                <td>Beschrijving</td>
                <td>Locatie</td>
                <td>Uren gewerkt</td>
                <td>Totale Kosten</td>
                <td>Factuur Verstuurd</td>
                <td>Factuur Betaal Termijn</td>
                <td>Factuur Betaald</td>
                <td>Update</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $t): ?>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $t['id'] ?>">
                    <tr <?php if ($jobs->PaymentPeriodPassed($t['id'], new DateTime())) {
                            echo "bgcolor='orange'";
                        } ?>>
                        <input type="hidden" name="previousSendState" value="<?= $t['invoiceSent'] ?>">
                    <tr>
                        <td><?= $t['title'] ?></td>
                        <td><textarea name="description" id=""><?= $t['description'] ?></textarea></td>
                        <td><?= $t['location'] ?></td>
                        <td><?= $t['hoursWorked'] ?></td>
                        <td><?= $t['totalCost'] ?></td>
                        <td><input type="checkbox" name="send" <?php if ($t['invoiceSent'] == 1) echo "checked" ?>></td>
                        <td><input type="number" name="invoicePaymentTerm" value="<?= $t['invoicePaymentTerm'] ?>"></td>
                        <td><input type="checkbox" name="paid" <?php if ($t['paid'] == 1) echo "checked" ?>></td>
                        <td><input type="submit" name="updateJob" value="update"></td>
                    </tr>
                </form>
            <?php endforeach ?>
        </tbody>
    </table>
    <a href="klanten.php" class="button">Terug</a>
</section>
