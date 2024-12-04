<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
require '../../../config.php';
$req = $conn->prepare(
    'UPDATE contact SET home=? ,updated_at=? where contact_id=?'
);
$currentDateTime = date("Y-m-d H:i:s");

if ($_POST['home'] == "false") {
    $success = $req->execute([
        "true",
        $currentDateTime,
        $_POST['contact_id']
    ]);
    $_SESSION['successUpdate'] = "Record shown successfully.";
       
} else if ($_POST["home"] == "true") 
 {
    $success = $req->execute([
        "false",
        $currentDateTime,
        $_POST['contact_id']
    ]);
    $_SESSION['successUpdate'] = "Record hidden successfully.";


}
if (!$success) {
    $_SESSION['errorUpdate'] = "Operation failed.";
}

header('location:index.php');


?>