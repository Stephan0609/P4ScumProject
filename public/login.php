<?php
require("../src/authenticate.php");
$Authenticate = new Authenticate();

// test account aanmaken
// $Authenticate->InsertUser("admin@admin", "admin");
// echo "true";

session_start();

if (isset($_POST["send"]) && $_POST["email"] != "") {
    $user = $Authenticate->UserLogin($_POST["email"], $_POST["password"]);

    if (!$user) {
        echo "Onjuiste inloggegevens";
    } else {
        $_SESSION["email"] = $user;
        header("location: index.php");
    }
} else {
    echo "Vul alles in";
}
?>


<form action="" method="post">
    <label for="email">Email:</label><br>
    <input type="email" name="email" id=""><br>
    <label for="password">Wachtwoord</label><br>
    <input type="password" name="password" id=""><br>
    <br>
    <input type="submit" name="send" value="login">
</form>