<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header class="container">
    <div>
        <h1>Home</h1>
        <nav>
            <ul>
                <li><a href="klanten.php">Klanten</a></li>
                <li><a href="voorraad.php">Voorraad</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
    </header>
</body>

</html>