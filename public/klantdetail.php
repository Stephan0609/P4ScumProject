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
echo("<a href='newJob.php?id=$id'>Nieuwe klus</a>");

$jobs = new Jobs;
$tasks = $jobs->GetAllJobsWithCustomerID($id);
if($tasks != [])
    {
        echo "<table><thead><tr>
        <td>Titel</td><td>Beschrijving</td><td>Locatie</td><td>Uren gewerkt </td><td> totale kosten</td>
        </tr></thead><tbody>";
        foreach ($tasks as $t) {
            echo "<tr>";
            $title = $t['title'];
            echo "<td>$title</td>";
            $desc = $t['description'];
            echo "<td>$desc</td>";
            $loc = $t['location'];
            echo "<td>$loc</td>";
            $hours = $t['hoursWorked'];
            echo "<td>$hours</td>";
            $cost = $t['totalCost'];
            echo "<td>$cost</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
else{
    echo"<br>";
}

if(isset($_POST['veranderAdres']))
    {
        if(isset($_POST['nieuwAdres']))
            {
                $customers->updateCustomerAdres($id, $_POST['nieuwAdres']);
            }
    }
?>
<a href="klanten.php">Terug</a>
