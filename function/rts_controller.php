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
          echo '<td rowspan="2" style="border:1px solid black;text-align:center;"></td>';
          echo '<td rowspan="2" style="border:1px solid black;text-align:center;"></td>';
          echo '<td rowspan="2" style="border:1px solid black;text-align:center;"></td>';
          echo '<td rowspan="2" style="border:1px solid black;text-align:center;"></td>';
          echo '<td rowspan="2" style="border:1px solid black;text-align:center;"></td>';
          echo '</tr>';
          echo '<tr style="border:1px solid black;text-align:center;">';
          echo '<td style="border:1px solid black;text-align:center;background-color:gray;"></td>';
          echo '</tr>';

       }
     }else{
       echo '<tr><td colspan="16" class="center">NO RECORD</td></tr>';
     }
  }
?>
