<?php
require '../../config.php';
require '../../model/uuid.php';

$sql = 'INSERT INTO contact ( contact_id,name,email,subject,message,home) VALUES (?,?,?,?,?,?)';

$req = $conn->prepare($sql);

$req->execute([
    Uuid::generate(),
    $_POST['name'],
    $_POST['email'],
    $_POST['subject'],
    $_POST['message'],
  "false"
]);

header('location:success.php')
    ?>