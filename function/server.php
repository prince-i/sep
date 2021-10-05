<?php
    require 'conn.php';
    session_start();
    if(isset($_POST['login_button'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        // RESTRICTION
        if(empty($username) || empty($password)){
            echo '<b class="red-text">Incomplete credentials!</b>';
        }else{
            // CHECK USER IF EXISTS
            $sql = "SELECT id,role FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                // EXIST USER GET INFO
                foreach($stmt->fetchALL() as $x){
                    $role = $x['role'];
                    // REQUESTOR STAFF
                    if($role == 'requestor'){
                        $_SESSION['username'] = $username;
                        header('location: page/requestor.php');
                    }
                    // APPROVER SV/MANAGER
                    elseif($role == 'approver'){
                        $_SESSION['username'] = $username;
                        header('location: page/approver.php');
                    }
                    // RTS BEBE MADEL
                    else{
                        $_SESSION['username'] = $username;
                        header('location: page/rts.php');
                    }
                }


            }else{
                echo '<b class="red-text">Invalid credentials!</b>';
            }
        }
    }
?>