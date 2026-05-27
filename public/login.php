<?php
require("../src/authenticate.php");
$Authenticate = new Authenticate();

// test account aanmaken
// $Authenticate->InsertUser("admin@admin", "admin");
// echo "true";

session_start();

if (isset($_SESSION["email"])) {
    header("Location: index.php");
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
<section class="container">
    <form action="" method="post" class="login">
        <?php
        if (isset($_POST["send"]) && $_POST["email"] != "") {
            $user = $Authenticate->UserLogin($_POST["email"], $_POST["password"]);

            if (!$user) {
                echo "Onjuiste inloggegevens";
            } else {
                $_SESSION["email"] = $user;
                header("Location: index.php");
            }
        } else {
            echo "Vul alles in";
        }
        ?>
        <input type="email" name="email" id="" placeholder="Email"><br>
        <input type="password" name="password" id="" placeholder="Wachtwoord"><br>
        <br>
        <input type="submit" name="send" value="login">
    </form>
</section>