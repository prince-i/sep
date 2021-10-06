<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTS ADMIN</title>
    <link rel="stylesheet" href="../node_modules/materialize-css/dist/css/materialize.min.css">
</head>
<body>
    <?php
        include '../function/session.php';
        include '../modal/logout.php';
        include '../modal/request_form.php';
        include '../modal/approve_modal.php';
    ?>
    <!-- NAV -->
    <nav class="nav-extended #263238 blue-grey darken-4 z-depth-5">
        <div class="nav-wrapper">
        <!-- <a href="#" class="brand-logo center"><img src="" alt="" class="responsive-img" style="width:50px;"></a> -->
        <a href="#">RTS-SEP Dashboard</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><span style="font-size:20px;font-weight:bold;">&plus;</span></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="#" data-target="modal_logout" class="modal-trigger"><?=ucwords($name)."-".ucwords($position);?></a></li>
        </ul>
        </div>
        <div class="nav-content">
        <ul class="tabs tabs-transparent">
            <li class="tab"><a href="#training" onclick="training()">SEP TRAINING REQUEST</a></span></li>
            <li class="tab"><a href="#account" onclick="account()">ACCOUNT MANAGEMENT</span></a></li>
            <li class="tab"><a href="#sched" onclick="training_sched()">TRAINING SCHED</span></a></li>
        </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
    <li><a href="#" class="modal-trigger" data-target="modal_logout"><?=ucwords($name);?></a></li>
    </ul>

    <!-- tabs -->
    <br>
    <div class="row">
      <div class="col s12" id="training">
        <div class="col s12" id="filter_form">
          <div class="col s1 input-field">
            <select class="browser-default z-depth-4" onchange="training()" name="" id="year_filter_sep" style="border:1px solid green;color:green;">
              <?php
                $base_year = $server_year + 1;
                $year_range = $base_year - 20;
                for($base_year;$base_year >= $year_range; $base_year--){
                  echo '<option>'.$base_year.'</option>';
                }
              ?>
            </select>
          </div>
          <!-- NEEDS -->
          <div class="col s3 input-field">
            <select class="browser-default z-depth-4" onchange="training()" name="" id="training_needs_filter" style="border:1px solid green;color:green;">
            <option value="">Filter by Training Needs</option>
            <option value="ET">Expert Training</option>
            <option value="JT">Jr. Staff Training</option>
            <option value="ST">Staff Training</option>
            </select>
          </div>
          <!-- SECTION -->
          <div class="col s3 input-field">
            <select class="browser-default z-depth-4" onchange="training()" name="" id="section_filter" style="border:1px solid green;color:green;">
            <option value="">All Section</option>
            <?php
                $x = "SELECT deptCode,section_name FROM section";
                $stmt = $conn->prepare($x);
                $stmt->execute();
                foreach($stmt->fetchALL() as $s){
                    echo '<option value="'.$s['section_name'].'">'.$s['deptCode']."-".$s['section_name'].'</option>';
                }
            ?>
            </select>
          </div>

        </div>
        <!-- UPDATE FORM -->
        <div class="col s12" id="update_form" style="display:none;">
          <div class="col s3 input-field">
            <input type="text" name="" value="" id="actual_date" class="datepicker" style="border:1px solid green;color:green;"><label for="">ACTUAL DATE</label>
          </div>
          <div class="col s3 input-field">
            <select class="browser-default z-depth-4" name="" id="training_status" style="border:1px solid green;color:green;">
              <option value="">Filter by Training Needs</option>
              <option value="ET">Expert Training</option>
              <option value="JT">Jr. Staff Training</option>
              <option value="ST">Staff Training</option>
            </select>
          </div>

          <div class="col s2 input-field">
            <select class="browser-default z-depth-4" name="" id="training_approval" style="border:1px solid green;color:green;">
              <option value="">--Training Approval</option>
              <option value="Y">YES</option>
              <option value="N">NO</option>
            </select>
          </div>

          <div class="col s2 input-field">
            <input type="text" name="" value="" id="remarks" style="border:1px solid green;color:green;"><label for="">Remarks</label>
          </div>
          <div class="col s2 input-field">
            <button type="button" name="button" class="btn green" onclick="get_to_update()">Update</button>
          </div>
        </div>


        <table style="border:1px solid black;zoom:80%;" class="">
        <thead style="border:1px solid black;">
          <tr style="border:1px solid black;">
            <th rowspan="3" style="border:1px solid black;text-align:center;">
              <p>
              <label>
                <input type="checkbox" class="filled-in" id="check_all" onchange="select_all_func()"/>
                <span></span>
              </label>
            </p>

            </th>
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
        </thead>
        <tbody id="sep_data">
          <!-- <tr style="border:1px solid black;text-align:center;">
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
          <td style="border:1px solid black;text-align:center;"></td>
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
          <td rowspan="2" style="border:1px solid black;text-align:center;"></td>
        </tr>
        <tr style="border:1px solid black;text-align:center;">
          <td style="border:1px solid black;text-align:center;" rowspan="2"></td>
        </tr> -->
        </tbody>
        </table>
      </div>
      <!-- ACCT MANAGEMENT -->
      <div class="col s12" id="account">

      </div>
      <!-- SCHED MANAGEMENT -->
      <div class="col s12" id="sched">

      </div>
    </div>


    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/materialize-css/dist/js/materialize.min.js"></script>
    <script src="../node_modules/sweetalert/dist/sweetalert.min.js" charset="utf-8"></script>
    <script>
        $(document).ready(function(){
            $('.tabs').tabs();
            $('.modal').modal();
            $('.sidenav').sidenav({
                preventScrolling: true,
                draggable: true,
                inDuration: 500
            });
            $('.datepicker').datepicker({
              format: 'yyyy-mm-dd',
              autoClose:true
            });
            training();
        });

        function training(){
          var year = document.getElementById('year_filter_sep').value;
          var train_needs = document.getElementById('training_needs_filter').value;
          var section = document.getElementById('section_filter').value;
          $.ajax({
            url: '../function/rts_controller.php',
            type: 'POST',
            cache: false,
            data:{
              method: 'load_sep_training',
              year:year,
              train_needs:train_needs,
              section:section
            },success:function(response){
              // console.log(response);
              document.getElementById('sep_data').innerHTML = response;
            }
          });
        }
        // SELECT ALL TRAINING
        const select_all_func =()=>{
            var select_all = document.getElementById('check_all');
            if(select_all.checked == true){
                console.log('check');
                $('.singleCheck').each(function(){
                    this.checked=true;
                });
            }else{
                console.log('uncheck');
                $('.singleCheck').each(function(){
                    this.checked=false;
                });
            }
            get_checked_length();
        }
        // CHECK SELECTED ARRAY
        const get_checked_length =()=>{
          var checkedArr = [];
          $('input.singleCheck:checkbox:checked').each(function(){
              checkedArr.push($(this).val());
          });
          var number_of_selected = checkedArr.length;
          console.log(number_of_selected);
          if(number_of_selected > 0){
              // $('#checkbox_control').fadeIn(500);
              $('#filter_form').fadeOut(400,function(){
                $('#update_form').fadeIn(400);
              });
          }else{
            $('#update_form').fadeOut(400,function(){
              $('#filter_form').fadeIn(400);
            });
          }
      }

        function get_to_update(){
          var actual_date = document.getElementById('actual_date').value;
          var training_status = document.getElementById('training_status').value;
          var training_app = document.getElementById('training_approval').value;
          var remarks = document.getElementById('remarks').value;
          var id = [];
          $('input.singleCheck:checkbox:checked').each(function(){
              id.push($(this).val());
          });
          console.log(id);

        }

        </script>
</body>
</html>
