<?php
  require 'conn.php';
  $method = $_POST['method'];
  if($method == 'send_request'){
    $batch = trim($_POST['batch']);
    $empid = trim($_POST['empid']);
    $name = strtoupper($_POST['name']);
    $position = $_POST['position'];
    $section = $_POST['section'];
    $training_needs = $_POST['training_needs'];
    $reason = $_POST['reason'];
    $schedule = $_POST['schedule'];
    $level = $_POST['level'];
    $username = $_POST['username'];
    $approver = $_POST['username'];
    // CHECK IF HAS EXISTING TRAINING
    $check = "SELECT id FROM sep_request WHERE step = '2' AND employee_id = '$empid'";
    $stmt = $conn->prepare($check);
    $stmt->execute();
    if($stmt->rowCount() > 0){
      echo 'exists';
    }else{
      // INSERT THE REQUEST TO DB
      $insert = "INSERT INTO sep_request (`requester`,`approver`,`batch_num`,`employee_id`,`name`,`position`,`section`,`training_needs`,`reason`,`schedule`,`step`) VALUES
      ('$username','$approver','$batch','$empid','$name','$position','$section','$training_needs','$reason','$schedule','$level')";
      $stmt = $conn->prepare($insert);
      if($stmt->execute()){
        echo 'success';
      }else{
        echo 'fail';
      }
    }
  }

  // LOAD PENDING
  if($method == 'load_pending'){
    $search = $_POST['search'];
    $section = $_POST['section'];
    // FETCH
    $count = 0;
    $sql = "SELECT *FROM sep_request WHERE step = '1' AND (employee_id LIKE '$search%' OR name LIKE '$search%' OR batch_num LIKE '$search%') AND section LIKE '$section%'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount() > 0){
      // FETCH OBJECT
      foreach($stmt->fetchALL() as $x){
        $count++;
        if($x['training_needs'] == 'ET'){
          $x['training_needs'] = 'Expert Training';
        }
        if($x['training_needs'] == 'JT'){
          $x['training_needs'] = 'Jr. Staff Training';
        }
        if($x['training_needs'] == 'ST'){
          $x['training_needs'] = 'Staff Training';
        }
        echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="approval_modal" onclick="get_req_id('.$x['id'].')">';
        echo '<td>'.$count.'</td>';
        echo '<td>'.$x['batch_num'].'</td>';
        echo '<td>'.$x['employee_id'].'</td>';
        echo '<td>'.$x['name'].'</td>';
        echo '<td>'.$x['position'].'</td>';
        echo '<td>'.$x['section'].'</td>';
        echo '<td>'.$x['training_needs'].'</td>';
        echo '<td>'.$x['reason'].'</td>';
        echo '<td>'.$x['schedule'].'</td>';
        // INDEXING GET REQUESTER NAME VIA ITS USERNAME
        $requester = $x['requester'];
        $get_requester = "SELECT name FROM users WHERE username = '$requester'";
        $stmt = $conn->prepare($get_requester);
        $stmt->execute();
        foreach($stmt->fetchALL() as $name){
          $name = $name['name'];
        }
        echo '<td>'.$name.'</td>';
        echo '</tr>';
      }
    }else{
      echo '<tr><td colspan="9">NO REQUEST</td></tr>';
    }
  }

  elseif($method == 'load_approved'){
    $search = $_POST['search'];
    $section = $_POST['section'];
    $username = $_POST['username'];
    // FETCH
    $count = 0;
    $sql = "SELECT *FROM sep_request WHERE step = '2' AND (employee_id LIKE '$search%' OR name LIKE '$search%' OR batch_num LIKE '$search%') AND section LIKE '$section%' AND approver LIKE '$username%' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount() > 0){
      // FETCH OBJECT
      foreach($stmt->fetchALL() as $x){
        $count++;
        if($x['training_needs'] == 'ET'){
          $x['training_needs'] = 'Expert Training';
        }
        if($x['training_needs'] == 'JT'){
          $x['training_needs'] = 'Jr. Staff Training';
        }
        if($x['training_needs'] == 'ST'){
          $x['training_needs'] = 'Staff Training';
        }
        echo '<tr>';
        echo '<td>'.$count.'</td>';
        echo '<td>'.$x['batch_num'].'</td>';
        echo '<td>'.$x['employee_id'].'</td>';
        echo '<td>'.$x['name'].'</td>';
        echo '<td>'.$x['position'].'</td>';
        echo '<td>'.$x['section'].'</td>';
        echo '<td>'.$x['training_needs'].'</td>';
        echo '<td>'.$x['reason'].'</td>';
        echo '<td>'.$x['schedule'].'</td>';
        // INDEXING GET REQUESTER NAME VIA ITS USERNAME
        $requester = $x['requester'];
        $get_requester = "SELECT name FROM users WHERE username = '$requester'";
        $stmt = $conn->prepare($get_requester);
        $stmt->execute();
        foreach($stmt->fetchALL() as $name){
          $name = $name['name'];
        }
        echo '<td>'.$name.'</td>';
        echo '</tr>';
      }
    }else{
      echo '<tr><td colspan="9">NO REQUEST</td></tr>';
    }
  }

// Cancelled
elseif($method == 'load_cancelled'){
  $search = $_POST['search'];
  $section = $_POST['section'];
  // FETCH
  $count = 0;
  $sql = "SELECT *FROM sep_request WHERE step = '0' AND (employee_id LIKE '$search%' OR name LIKE '$search%' OR batch_num LIKE '$search%') AND section LIKE '$section%'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  if($stmt->rowCount() > 0){
    // FETCH OBJECT
    foreach($stmt->fetchALL() as $x){
      $count++;
      if($x['training_needs'] == 'ET'){
        $x['training_needs'] = 'Expert Training';
      }
      if($x['training_needs'] == 'JT'){
        $x['training_needs'] = 'Jr. Staff Training';
      }
      if($x['training_needs'] == 'ST'){
        $x['training_needs'] = 'Staff Training';
      }
      echo '<tr>';
      echo '<td>'.$count.'</td>';
      echo '<td>'.$x['batch_num'].'</td>';
      echo '<td>'.$x['employee_id'].'</td>';
      echo '<td>'.$x['name'].'</td>';
      echo '<td>'.$x['position'].'</td>';
      echo '<td>'.$x['section'].'</td>';
      echo '<td>'.$x['training_needs'].'</td>';
      echo '<td>'.$x['reason'].'</td>';
      echo '<td>'.$x['schedule'].'</td>';
      echo '<td>'.$x['remarks'].'</td>';
      // INDEXING GET REQUESTER NAME VIA ITS USERNAME
      $requester = $x['requester'];
      $get_requester = "SELECT name FROM users WHERE username = '$requester'";
      $stmt = $conn->prepare($get_requester);
      $stmt->execute();
      foreach($stmt->fetchALL() as $name){
        $name = $name['name'];
      }
      echo '<td>'.$name.'</td>';
      echo '</tr>';
    }
  }else{
    echo '<tr><td colspan="9">NO REQUEST</td></tr>';
  }
}

// Completed
elseif($method == 'load_completed'){
  $search = $_POST['search'];
  $requester = $_POST['username'];
  // FETCH
  $count = 0;
  $sql = "SELECT *FROM sep_request WHERE step = '3' AND (employee_id LIKE '$search%' OR name LIKE '$search%' OR batch_num LIKE '$search%') AND requester LIKE '$requester%'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  if($stmt->rowCount() > 0){
    // FETCH OBJECT
    foreach($stmt->fetchALL() as $x){
      $count++;
      if($x['training_needs'] == 'ET'){
        $x['training_needs'] = 'Expert Training';
      }
      if($x['training_needs'] == 'JT'){
        $x['training_needs'] = 'Jr. Staff Training';
      }
      if($x['training_needs'] == 'ST'){
        $x['training_needs'] = 'Staff Training';
      }
      echo '<tr>';
      echo '<td>'.$count.'</td>';
      echo '<td>'.$x['batch_num'].'</td>';
      echo '<td>'.$x['employee_id'].'</td>';
      echo '<td>'.$x['name'].'</td>';
      echo '<td>'.$x['position'].'</td>';
      echo '<td>'.$x['section'].'</td>';
      echo '<td>'.$x['training_needs'].'</td>';
      echo '<td>'.$x['reason'].'</td>';
      echo '<td>'.$x['schedule'].'</td>';
      echo '</tr>';
    }
  }else{
    echo '<tr><td colspan="9">NO REQUEST</td></tr>';
  }
}

elseif($method == 'approved_request_command'){
  $id = $_POST['id'];
  $username = trim($_POST['approver']);
  $approve = "UPDATE sep_request SET step = '2',approver = '$username' WHERE id = '$id'";
  $stmt=$conn->prepare($approve);
  if($stmt->execute()){
    echo 'y';
  }else{
    echo 'n';
  }
}
elseif($method == 'cancel_request_command'){
  $id = $_POST['id'];
  $username = trim($_POST['approver']);
  $remarks = strtoupper($_POST['remarks']);
  $approve = "UPDATE sep_request SET step = '0',approver = '$username', remarks = '$remarks' WHERE id = '$id'";
  $stmt=$conn->prepare($approve);
  if($stmt->execute()){
    echo 'y';
  }else{
    echo 'n';
  }
}

  $conn = null;
?>
