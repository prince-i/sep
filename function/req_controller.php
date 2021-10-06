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
    // CHECK IF HAS EXISTING TRAINING
    $check = "SELECT id FROM sep_request WHERE step = '1' AND employee_id = '$empid'";
    $stmt = $conn->prepare($check);
    $stmt->execute();
    if($stmt->rowCount() > 0){
      echo 'exists';
    }else{
      // INSERT THE REQUEST TO DB
      $insert = "INSERT INTO sep_request (`requester`,`batch_num`,`employee_id`,`name`,`position`,`section`,`training_needs`,`reason`,`schedule`,`step`) VALUES
      ('$username','$batch','$empid','$name','$position','$section','$training_needs','$reason','$schedule','$level')";
      $stmt = $conn->prepare($insert);
      if($stmt->execute()){
        echo 'success';
      }else{
        echo 'fail';
      }
    }
  }

  // LOAD PENDING
  elseif($method == 'load_pending'){
    $search = $_POST['search'];
    $requester = $_POST['username'];
    // FETCH
    $count = 0;
    $sql = "SELECT *FROM sep_request WHERE step = '1' AND (employee_id LIKE '$search%' OR name LIKE '$search%' OR batch_num LIKE '$search%') AND requester LIKE '$requester%'";
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

  elseif($method == 'load_approved'){
    $search = $_POST['search'];
    $requester = $_POST['username'];
    // FETCH
    $count = 0;
    $sql = "SELECT *FROM sep_request WHERE step = '2' AND (employee_id LIKE '$search%' OR name LIKE '$search%' OR batch_num LIKE '$search%') AND requester LIKE '$requester%'";
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

// Cancelled
elseif($method == 'load_cancelled'){
  $search = $_POST['search'];
  $requester = $_POST['username'];
  // FETCH
  $count = 0;
  $sql = "SELECT *FROM sep_request WHERE step = '0' AND (employee_id LIKE '$search%' OR name LIKE '$search%' OR batch_num LIKE '$search%') AND requester LIKE '$requester%'";
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


  $conn = null;
?>
