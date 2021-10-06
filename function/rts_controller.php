<?php
  require 'conn.php';
  $method = $_POST['method'];

  if($method == 'load_sep_training'){
    $n = 0;
     $year = $_POST['year'];
     $train_needs = $_POST['train_needs'];
     $section = $_POST['section'];
     $sql = "SELECT *FROM sep_request WHERE schedule LIKE '$year%' AND training_needs LIKE '$train_needs%' AND section LIKE '$section%'";
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

          if($x['training_approval'] == 'Y'){
            $appr = 'YES';
          }else{
            $appr = 'NO';
          }

          echo '<tr style="border:1px solid black;text-align:center;cursor:pointer;">';
          echo '<td rowspan="2" style="border:1px solid black;text-align:center;">
          <p>
          <label>
            <input type="checkbox" class="filled-in singleCheck" id="training_record" onclick="get_checked_length()" value="'.$x['id'].'"/>
            <span></span>
          </label>
          </p>
          </td>';
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
  }

  elseif($method == 'update_trainees'){
    $id = [];
    $id = $_POST['id'];
    $actual_date = $_POST['actual_date'];
    $training_app = $_POST['training_app'];
    $remarks = strtoupper($_POST['remarks']);
    $training_status = $_POST['training_status'];
    $count = count($id);
    if($training_app == 'Y'){
      $step = '3';
    }else{
      $step = '0';
    }
    // EVERY ID RUN UPDATE FUNCTION
    foreach($id as $x){
      $update = "UPDATE sep_request SET actual_sched = '$actual_date', training_status = '$training_status', remarks = '$remarks', training_approval = '$training_app',step = '$step' WHERE id = '$x'";
      $stmt = $conn->prepare($update);
      if($stmt->execute()){
        $count = $count - 1;
      }
    }

    if($count == 0){
      echo 'success';
    }else{
      echo 'fail';
    }
  }


  $conn=null;
?>
