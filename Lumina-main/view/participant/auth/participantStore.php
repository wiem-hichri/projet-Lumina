<?php
require '../../../config.php';
require '../../../model/uuid.php';
session_start();

$sql = 'INSERT INTO participant (participant_id, cin, first_name, last_name, email, password, tel, address, profession) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
$req = $conn->prepare($sql);

$participant_id = Uuid::generate(); // Générer un ID participant

$success=$req->execute([
    $participant_id,
    $_POST['cin'],
    $_POST['first_name'],
    $_POST['last_name'],
    $_POST['email'],
    $_POST['password'],
    $_POST['tel'],
    $_POST['address'],
    $_POST['profession']
]);

if ($success) {
    $_SESSION['successLogin'] = "Login successful.";
    $_SESSION['participant'] = $_POST["email"];
    $_SESSION['username'] = $_POST["first_name"] . " " . $_POST["last_name"];
    $_SESSION['participant_id'] = $participant_id;
    header("Location: ../../main/home.php");
    exit(); // Terminate script execution after redirection
} else {
    $_SESSION['errorLogin'] = "Login failed.";
    header("Location: ../../main/home.php");
    exit(); // Terminate script execution after redirection
}
   
?>
