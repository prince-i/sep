<?php
require 'server.php';
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    // FETCH DATA
    $sql = "SELECT *FROM users WHERE username = '$username' LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    foreach($stmt->fetchALL() as $u){
        $role = $u['role'];
        $level = $u['level'];
        $name = $u['name'];
        $email = $u['email_add'];
        $position = $u['position'];
    }
}else{
    $session_unset();
    $session_destroy();
    header('location:../index.php');
}

?>