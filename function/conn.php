<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $server_date = date('Y-m-d');
    $server_year = date('Y');
    try{
        $conn = new PDO ("mysql:host=$servername;dbname=sep_db",$username,$password);
    }catch(PDOException $e){
        echo 'No connection'.$e->getMessage();
    }
?>
