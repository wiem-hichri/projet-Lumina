<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
    exit(); // Terminate script execution after redirection
}

require '../../../config.php';
require '../../../model/uuid.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form fields (add more validation as needed)
    if (empty($_POST['cin']) || empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['tel']) || empty($_POST['poste'])) {
        $_SESSION['errorAdd'] = "All fields are required.";
        header('location:index.php');
        exit(); // Terminate script execution after redirection
    }

    // Check if the cin or email already exists in the database
    $sqlCheck = 'SELECT * FROM admin WHERE cin = ? OR email = ?';
    $reqCheck = $conn->prepare($sqlCheck);
    $reqCheck->execute([$_POST['cin'], $_POST['email']]);
    $existingRecord = $reqCheck->fetch();

    if ($existingRecord) {
        $_SESSION['errorAdd'] = "CIN or email already exists in the database.";
        header('location:index.php');
        exit(); // Terminate script execution after redirection
    }

    // Insert data into the database
    $sql = 'INSERT INTO admin (admin_id, cin, first_name, last_name, email, password, tel, poste) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $req = $conn->prepare($sql);
    $admin_id = Uuid::generate();
    $success = $req->execute([$admin_id, $_POST['cin'], $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['tel'], $_POST['poste'],]);

    // Check if the insertion was successful
    if ($success) {
        $_SESSION['successAdd'] = "New record added successfully.";
    } else {
        $_SESSION['errorAdd'] = "Failed to add new record.";
    }

    header('location:index.php');
    exit(); // Terminate script execution after redirection
} else {
    header('location:index.php');
    exit(); // Terminate script execution after redirection
}
?>