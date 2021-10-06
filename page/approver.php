<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approver</title>
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
    <nav class="nav-extended #004d40 teal darken-4 z-depth-5">
        <div class="nav-wrapper">
        <a href="#" class="brand-logo center"><img src="" alt="" class="responsive-img" style="width:50px;"></a>
        <a href="#">Approver Dashboard</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><span style="font-size:20px;font-weight:bold;">&plus;</span></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="#" data-target="modal_logout" class="modal-trigger"><?=ucwords($name)."-".ucwords($position);?></a></li>
        </ul>
        </div>
        <div class="nav-content">
        <ul class="tabs tabs-transparent">
            <li class="tab"><a href="#request" onclick="pending()">For Approval Requests<span class="new badge #64b5f6 blue lighten-2" id="pending"></a></span></li>
            <li class="tab"><a href="#approved" onclick="load_approved_list()">Approved Request<span class="new badge #64b5f6 blue lighten-2" id="approved_notif"></span></a></li>
            <li class="tab"><a href="#cancelled" onclick="load_cancelled_list()">Cancelled Request<span class="new badge #64b5f6 blue lighten-2" id="cancel_notif"></span></a></li>
            <li class="tab"><a href="#verified" onclick="load_completed()">Completed Training Request<span class="new badge #64b5f6 blue lighten-2" id="verified_notif"></span></a></li>
        </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
    <li><a href="#" class="modal-trigger" data-target="modal_logout"><?=ucwords($name);?></a></li>
    </ul>

    <!-- TAB CONTENTS -->
    <div class="row">
      <!-- REQUEST TAB -->
      <div class="col s12" id="request">
          <div class="row">
              <div class="col s12">
                <div class="col s8 input-field">
                    <input type="text" name="" value="" id="pending_search" onchange="pending()"><label for="pending_search">Search (Employee ID#/Batch#/Name)</label>
                </div>

                  <div class="col s2 right input-field">
                      <button class="btn #006064 cyan darken-4 col s12 modal-trigger" data-target="modal_request_sep">Request &plus;</button>
                  </div>
              </div>
              <!-- TABLE -->
              <div class="col s12">
                  <table class="centered">
                      <thead>
                          <th>NO.</th>
                          <th>BATCH#</th>
                          <th>EMPLOYEE ID</th>
                          <th>NAME</th>
                          <th>POSITION</th>
                          <th>DEPT/SECTION</th>
                          <th>TRAINING NEEDS</th>
                          <th>REASON</th>
                          <th>SCHEDULE</th>
                          <th>REQUESTER</th>
                      </thead>
                      <tbody id="pending_req">

                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  <!-- APPROVED -->
      <div class="col s12" id="approved">
        <div class="row">
            <div class="col s12">
              <div class="col s8 input-field">
                  <input type="text" name="" value="" id="approved_search" onchange="load_approved_list()"><label for="pending_search">Search (Employee ID#/Batch#/Name)</label>
              </div>

                <div class="col s2 right input-field">
                    <button class="btn #006064 cyan darken-4 col s12 modal-trigger" data-target="modal_request_sep">Request &plus;</button>
                </div>
            </div>
            <!-- TABLE -->
            <div class="col s12">
                <table class="centered">
                    <thead>
                        <th>NO.</th>
                        <th>BATCH#</th>
                        <th>EMPLOYEE ID</th>
                        <th>NAME</th>
                        <th>POSITION</th>
                        <th>DEPT/SECTION</th>
                        <th>TRAINING NEEDS</th>
                        <th>REASON</th>
                        <th>SCHEDULE</th>
                        <th>REQUESTER</th>
                    </thead>
                    <tbody id="approved_req">

                    </tbody>
                </table>
            </div>
        </div>
      </div>
      <!-- CANCELLED -->
      <div class="col s12" id="cancelled">
        <div class="row">
            <div class="col s12">
              <div class="col s8 input-field">
                  <input type="text" name="" value="" id="cancelled_search" onchange="load_cancelled_list()"><label for="pending_search">Search (Employee ID#/Batch#/Name)</label>
              </div>

                <div class="col s2 right input-field">
                    <button class="btn #006064 cyan darken-4 col s12 modal-trigger" data-target="modal_request_sep">Request &plus;</button>
                </div>
            </div>
            <!-- TABLE -->
            <div class="col s12">
                <table class="centered">
                    <thead>
                        <th>NO.</th>
                        <th>BATCH#</th>
                        <th>EMPLOYEE ID</th>
                        <th>NAME</th>
                        <th>POSITION</th>
                        <th>DEPT/SECTION</th>
                        <th>TRAINING NEEDS</th>
                        <th>REASON</th>
                        <th>SCHEDULE</th>
                        <th>REMARKS</th>
                        <th>REQUESTER</th>
                    </thead>
                    <tbody id="cancelled_req">

                    </tbody>
                </table>
            </div>
        </div>
      </div>

      <!-- VERIFIED -->
      <div class="col s12" id="verified">
        <div class="row">
            <div class="col s12">
              <div class="col s8 input-field">
                  <input type="text" name="" value="" id="completed_search" onchange="load_completed()"><label for="pending_search">Search (Employee ID#/Batch#/Name)</label>
              </div>

                <div class="col s2 right input-field">
                    <button class="btn #006064 cyan darken-4 col s12 modal-trigger" data-target="modal_request_sep">Request &plus;</button>
                </div>
            </div>
            <!-- TABLE -->
            <div class="col s12">
                <table class="centered">
                    <thead>
                        <th>NO.</th>
                        <th>BATCH#</th>
                        <th>EMPLOYEE ID</th>
                        <th>NAME</th>
                        <th>POSITION</th>
                        <th>DEPT/SECTION</th>
                        <th>TRAINING NEEDS</th>
                        <th>REASON</th>
                        <th>SCHEDULE</th>
                        <th>REQUESTER</th>
                    </thead>
                    <tbody id="completed_req"></tbody>
                </table>
            </div>
        </div>
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
            pending();
        });
        function send_request(){
          var batch = $('#batch_num').val();
          var empid = $('#emp_id').val();
          var name = $('#name').val();
          var position = $('#position').val();
          var section = $('#section').val();
          var training_needs = $('#training_needs').val();
          var reason = $('#reason_training').val();
          var schedule = $('#schedule').val();

          if(batch == '' || empid == '' || name == '' || position == '' || section == '' || training_needs == '' || reason == '' || schedule == ''){
            M.toast({html:'Please fill-up all fields!',
                    classes:'round red'});
          }else{
            $.ajax({
              url: '../function/app_controller.php',
              type: 'POST',
              cache: false,
              data:{
                method: 'send_request',
                batch:batch,
                empid:empid,
                name:name,
                position:position,
                section:section,
                training_needs:training_needs,
                reason:reason,
                schedule:schedule,
                level: '<?=$level;?>',
                username:'<?=$username;?>'
              },success:function(response){
                if(response == 'exists'){
                  swal('This employee has ongoing SEP training request!');
                }else if(response == 'success'){
                  swal('Request sent!','','success');
                  clear_sep_form();
                  pending();
                }else{
                  swal('Failed, please report the error to IT!','','error');
                }
              }
            });
          }
        }
        function clear_sep_form(){
          $('#batch_num').val('');
          $('#emp_id').val('');
          $('#name').val('');
          $('#position').val('');
          $('#section').val('');
          $('#training_needs').val('');
          $('#reason_training').val('');
          $('#schedule').val('');
        }
        function pending(){
          var search = document.getElementById('pending_search').value;
          $.ajax({
            url: '../function/app_controller.php',
            type: 'POST',
            cache: false,
            data:{
              method: 'load_pending',
              search:search,
              section: '<?=$section;?>'
            },success:function(data){
              // console.log(data);
              document.getElementById('pending_req').innerHTML = data;
            }
          });
        }

        function load_approved_list(){
          var search = document.getElementById('approved_search').value;
          $.ajax({
            url: '../function/app_controller.php',
            type: 'POST',
            cache: false,
            data:{
              method: 'load_approved',
              search:search,
              section: '<?=$section;?>',
              username: '<?=$username;?>'
            },success:function(data){
              // console.log(data);
              document.getElementById('approved_req').innerHTML = data;
            }
          });
        }

        // CANCELLED
        function load_cancelled_list(){
          var search = document.getElementById('cancelled_search').value;
          $.ajax({
            url: '../function/app_controller.php',
            type: 'POST',
            cache: false,
            data:{
              method: 'load_cancelled',
              search:search,
                section: '<?=$section;?>'
            },success:function(data){
              // console.log(data);
              document.getElementById('cancelled_req').innerHTML = data;
            }
          });
        }

        // Completed
        function load_completed(){
          var search = document.getElementById('completed_search').value;
          $.ajax({
            url: '../function/app_controller.php',
            type: 'POST',
            cache: false,
            data:{
              method: 'load_completed',
              search:search,
              section: '<?=$section;?>'
            },success:function(data){
              // console.log(data);
              document.getElementById('cancelled_req').innerHTML = data;
            }
          });
        }

        // GET REQUEST FOR APPROVAL Menu
        function get_req_id(id){
          // console.log(id);
          document.querySelector('#req_id_app').value = id;
        }

        function approved_btn(){
          var id = document.querySelector('#req_id_app').value;
          $.ajax({
            url: '../function/app_controller.php',
            type: 'POST',
            cache: false,
            data:{
              method: 'approved_request_command',
              id:id,
              approver: '<?=$username;?>'
            },success:function(response){
              console.log(response);
              if(response == 'y'){
                M.toast({html:'Approved!',classes:'green rounded'});
                pending();
                $('.modal').modal('close','#approval_modal');
              }else{
                M.toast({html:'Failed!',classes:'red rounded'});
              }
            }
          });
        }

        function decline_req_btn(){
          var id = document.querySelector('#req_id_app').value;
          var remarks = document.getElementById('cancel_remarks').value;
          $.ajax({
            url: '../function/app_controller.php',
            type: 'POST',
            cache: false,
            data:{
              method: 'cancel_request_command',
              id:id,
              approver: '<?=$username;?>',
              remarks:remarks
            },success:function(response){
              console.log(response);
              if(response == 'y'){
                M.toast({html:'Cancelled!',classes:'green rounded'});
                pending();
                $('.modal').modal('close','#approval_modal');
              }else{
                M.toast({html:'Failed!',classes:'red rounded'});
              }
            }
          });
        }

        function show_cancel_form(){
          if(document.getElementById('cancel_form').style.display == "none"){
            document.getElementById('cancel_form').style.display = "block";
          }
          else if(document.getElementById('cancel_form').style.display == "block"){
            document.getElementById('cancel_form').style.display = "none";
          }

        }
    </script>
</body>
</html>
