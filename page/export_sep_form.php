<?php
  require '../function/session.php';
  $year = $_GET['year'];
  $training_needs = $_GET['training_needs'];
  $section = $_GET['section'];
  $approval = $_GET['approval'];

$datenow = date('Y-m-d');
$filename = "SEP TRAINING FORM-".$datenow.".xls";
// header("Content-Type: application/vnd.ms-excel");
// header('Content-Type: text/csv; charset=utf-8');
// header("Content-Disposition: ; filename=\"$filename\"");

$get_pic = "SELECT requester,approver FROM sep_request WHERE schedule LIKE '$year%' AND training_needs LIKE '$training_needs%' AND section LIKE '$section%' AND training_approval LIKE '$approval%'";
$stmt = $conn->prepare($get_pic);
$stmt->execute();
foreach($stmt->fetchALL() as $s){
  $requester = $s['requester'];
  $approver = $s['approver'];
}
$get_name_requester = "SELECT name FROM users WHERE username LIKE '$requester' AND section LIKE '$section%' LIMIT 1";
$stmt1 = $conn->prepare($get_name_requester);
$stmt1->execute();
foreach($stmt1->fetchALL() as $n){
  $requester_name = $n['name'];
}
 $get_name_approver= "SELECT name FROM users WHERE username LIKE '$approver%'  AND section LIKE '$section%' LIMIT 1";
$stmt2 = $conn->prepare($get_name_approver);
$stmt2->execute();
foreach($stmt2->fetchALL() as $nn){
  $approver_name = $nn['name'];
}
echo'
<html lang="en">
<style>
table{
  border-collapse:collapse;
}
body{
  font-family:arial;
  font-size:12px;
}
</style>
<body>

<table style="width:100%;">
  <tr>
    <td><img src="../assets/logo-fas.png" height="50" style="float:left;"/>FURUKAWA AUTOMOTIVE SYSTEMS <br> LIMA PHILIPPINES,INC.</td>
    <td><p style="background-color:black;color:white;text-align:center;padding:5px;">SEP TRAINING REQUEST FORM</p></td>
    <td>
      <div>
      <div style="font-weight:bold;border:1px solid black;text-align:center;">Approved by:</div>
      <div style="border-left:1px solid black;text-align:center;border-right:1px solid black;font-size:10px;">(HR Dept./RT Section)</div>
      <div style="border:1px solid black;text-align:center;">M.C.Nario</div>
      <div style="border-left:1px solid black;text-align:center;border-right:1px solid black;border-bottom:1px solid black;">&nbsp;</div>
      </div>
    </td>
    <td>
      <div>
      <div style="font-weight:bold;border:1px solid black;text-align:center;">Noted By:</div>
      <div  style="border-left:1px solid black;text-align:center;border-right:1px solid black;font-size:10px;"">Requester Supervisor</div>
      <div style="border:1px solid black;text-align:center;">'.$approver_name.'</div>
      <div style="border-left:1px solid black;text-align:center;border-right:1px solid black;border-bottom:1px solid black;">&nbsp;</div>
      </div>
    </td>
    <td>
      <div>
      <div style="font-weight:bold;border:1px solid black;text-align:center;">Prepared By:</div>
      <div style="border-left:1px solid black;text-align:center;border-right:1px solid black;font-size:10px;"">Requester Staff</div>
      <div style="border:1px solid black;text-align:center;">'.$requester_name.'</div>
      <div style="border-left:1px solid black;text-align:center;border-right:1px solid black;border-bottom:1px solid black;">&nbsp;</div>
      </div>
    </td>
  </tr>

  <tr>
    <td colspan="3">
      Note: Training Request must be submitted at least one day before the Training.
      <br>
      Make sure to attend on time ("NO LATE").
    </td>
    <td colspan="2">
      CTRL No:______________
    <td>
  </tr>
</table>

<table border="1">
<thead style="border:1px solid black;">
  <tr style="border:1px solid black;">
    <th rowspan="3" style="border:1px solid black;text-align:center;"> NO.</th>
    <th rowspan="3" style="border:1px solid black;text-align:center;">BATCH#</th>
    <th rowspan="3" style="border:1px solid black;text-align:center;">NAME</th>
    <th rowspan="3" style="border:1px solid black;text-align:center;">POSITION</th>
    <th rowspan="3" style="border:1px solid black;text-align:center;">DEPARTMENT/SECTION</th>
    <th colspan="4" style="border:1px solid black;text-align:center;">TRAINING NEEDS</th>
    <th style="border:1px solid black;text-align:center;">SCHEDULE</th>
    <th colspan="3" rowspan="2" style="border:1px solid black;text-align:center;">TRAINING STATUS</th>
    <th rowspan="3" style="border:1px solid black;text-align:center;">TRAINING APPROVAL</th>
    <th rowspan="3" style="border:1px solid black;text-align:center;">REMARKS</th>
  </tr>
  <tr style="border:1px solid black;">
    <th rowspan="2" style="border:1px solid black;text-align:center;">Expert Training</th>
    <th rowspan="2" style="border:1px solid black;text-align:center;">Jr. Staff Training</th>
    <th rowspan="2" style="border:1px solid black;text-align:center;">Staff Training</th>
    <th rowspan="2" style="border:1px solid black;text-align:center;">Reason for Training</th>
    <th style="border:1px solid black;text-align:center;">Planned Date<br>(mm-dd-yy)</th>
  </tr>
  <tr style="border:1px solid black;text-align:center;">
    <th style="border:1px solid black;text-align:center;background-color:gray;">Actual Date<br>(mm-dd-yy)</th>
    <th style="border:1px solid black;text-align:center;">ET</th>
    <th style="border:1px solid black;text-align:center;">JT</th>
    <th style="border:1px solid black;text-align:center;">ST</th>
  </tr>
</thead>';

$n = 0;
$sql = "SELECT *FROM sep_request WHERE schedule LIKE '$year%' AND training_needs LIKE '$training_needs%' AND section LIKE '$section%' AND training_approval LIKE '$approval%'";
$stmt = $conn->prepare($sql);
$stmt->execute();
if($stmt->rowCount() > 0){
  foreach ($stmt->fetchALL() as $x) {
    $n++;
    // CHECKL  ET
    if($x['training_needs'] == 'ET'){
      $et_check = '<b>&check;</b>';
    }else{
      $et_check = '';
    }
    // CHECK JT
    if($x['training_needs'] == 'JT'){
      $jt_check = '<b>&check;</b>';
    }else{
      $jt_check = '';
    }
    // CHECK ST
    if($x['training_needs'] == 'ST'){
      $st_check = '<b>&check;</b>';
    }else{
      $st_check = '';
    }

    if($x['training_status'] == 'ET'){
      $et_status = '<b>&check;</b>';
    }else{
      $et_status = '';
    }

    if($x['training_status'] == 'JT'){
       $jt_status = '<b>&check;</b>';
     }else{
       $jt_status = '';
     }

     if($x['training_status'] == 'ST'){
       $st_status = '<b>&check;</b>';
     }else{
       $st_status = '';
     }

     if($x['training_approval'] == 'Y' || $x['training_approval'] == 'y'){
       $appr = 'YES';
     }elseif($x['training_approval'] == 'P' || $x['training_approval'] == 'p'){
       $appr = 'PENDING';
     }
     else{
       $appr = 'NO';
     }

     echo '<tr style="border:1px solid black;text-align:center;">';
     echo '<td rowspan="2" style="border:1px solid black;text-align:center;">'.$n.'</td>';
     echo '<td rowspan="2" style="border:1px solid black;text-align:center;">'.$x['batch_num'].'</td>';
     echo '<td rowspan="2" style="border:1px solid black;text-align:center;">'.ucwords($x['name']).'</td>';
     echo '<td rowspan="2" style="border:1px solid black;text-align:center;">'.ucwords($x['position']).'</td>';
     echo '<td rowspan="2" style="border:1px solid black;text-align:center;">'.$x['section'].'</td>';
     echo '<td rowspan="2" style="border:1px solid black;text-align:center;">'.$et_check.'</td>';
     echo '<td rowspan="2" style="border:1px solid black;text-align:center;">'.$jt_check.'</td>';
     echo '<td rowspan="2" style="border:1px solid black;text-align:center;">'.$st_check.'</td>';
     echo '<td rowspan="2" style="border:1px solid black;text-align:center;">'.$x['reason'].'</td>';
     echo '<td style="border:1px solid black;text-align:center;">'.$x['schedule'].'</td>';
     echo '<td rowspan="2" style="border:1px solid black;text-align:center;">'.$et_status.'</td>';
     echo '<td rowspan="2" style="border:1px solid black;text-align:center;">'.$jt_status.'</td>';
     echo '<td rowspan="2" style="border:1px solid black;text-align:center;">'.$st_status.'</td>';
     echo '<td rowspan="2" style="border:1px solid black;text-align:center;">'.$appr.'</td>';
     echo '<td rowspan="2" style="border:1px solid black;text-align:center;">'.$x['remarks'].'</td>';
     echo '</tr>';
     echo '<tr style="border:1px solid black;text-align:center;">';
     echo '<td style="border:1px solid black;text-align:center;background-color:gray;">'.$x['actual_sched'].'</td>';
     echo '</tr>';

  }
}else{
  echo '<tr><td colspan="16" class="center">NO RECORD</td></tr>';
}


echo'

</table>
<span>RT-023-01</span>
</body>
</html>
';


 ?>
