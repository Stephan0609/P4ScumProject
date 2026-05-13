<?php
session_start();
$id = $_GET['id'];
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
}

include("../src/customers.php");
include("../src/jobs.php");

$customers = new Customers;
$customer = $customers->GetCustomerOnID($id);


$jobs = new Jobs;
$tasks = $jobs->GetAllJobsWithCustomerID($id);

if(!$tasks == [])
    {
        echo("Er is al een klus, klik <a href='klantdetail.php?id=$id'>hier</a> om terug te gaan");
    }

else{
    echo "<td><a href='klantdetail.php?id=$id'>Terug</a></td>";
?>
<form action="" method="POST">
    Titel: <input type="text" name="title"><br>
    Omschrijving klus: <textarea name="omschrijving" id=""></textarea><br>
    Datum: <input type="date" name="date"><br>
    Locatie: <input type="text" name="location"><br>
    <input type="checkbox" name="paid">Betaald<br>

    <input type="submit" name="addJob" value="Maak klus"><br>
</form>
<?php
if(isset($_POST['addJob']) && isset($_POST['omschrijving']) && isset($_POST['date']) && isset($_POST['title']) && isset($_POST['location']))
    {
        $paid = isset($_POST['paid']) ? 1 : 0;
        $jobs->addJob($_POST['omschrijving'], $_POST['date'], $id, $_POST['title'], $_POST['location'], $paid);
    }
}