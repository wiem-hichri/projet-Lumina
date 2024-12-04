<?php
session_start();

require '../../../config.php';
$sql = "SELECT * FROM participant WHERE email=? AND password=?";

$req = $conn->prepare($sql);

$req->execute([$_POST["email"], $_POST["password"],]);

$result = $req->fetch();
if ($req->rowCount() > 0) {
    $_SESSION['successLogin'] = "Login successful.";
    $_SESSION['participant'] = $result["email"];
    $_SESSION['username'] = $result["first_name"] . " " . $result["last_name"];
    $_SESSION['participant_id'] = $result["participant_id"];
    header("Location: ../../main/home.php");
    exit(); // Terminate script execution after redirection
} else {
    $_SESSION['errorLogin'] = "Login failed.";
    header("Location: ../../main/home.php");
    exit(); // Terminate script execution after redirection
}
?>