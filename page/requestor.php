<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requestor</title>
    <link rel="stylesheet" href="../node_modules/materialize-css/dist/css/materialize.min.css">
</head>
<body>
    <?php 
        include '../function/session.php';
        include '../modal/logout.php';
        include '../modal/request_form.php';
    ?>
    <!-- NAV -->
    <nav class="nav-extended #004d40 teal darken-4 z-depth-5">
        <div class="nav-wrapper">
        <a href="#" class="brand-logo center"><img src="" alt="" class="responsive-img" style="width:50px;"></a>
        <a href="#">Requestor Dashboard</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><span style="font-size:20px;font-weight:bold;">&plus;</span></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="#" data-target="modal_logout" class="modal-trigger"><?=ucwords($name)."-".ucwords($position);?></a></li>
        </ul>
        </div>
        <div class="nav-content">
        <ul class="tabs tabs-transparent">
            <li class="tab"><a href="#request" onclick="pending()">Pending Requests<span class="new badge #64b5f6 blue lighten-2" id="pending"></a></span></li>
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
    <!-- REQUEST TAB -->
    <div class="col s12" id="request">
        <div class="row">
            <div class="col s12">
                <div class="col s3 input-field ">
                    <select name="" id="section_filter" class="browser-default z-depth-5">
                        <option value="">--</option>
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
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="col s12" id="approved">APP</div>
    <div class="col s12" id="cancelled">CAN</div>
    <div class="col s12" id="verified">VER</div>

    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/materialize-css/dist/js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.tabs').tabs();
            $('.modal').modal();
            $('.sidenav').sidenav({
                preventScrolling: true,
                draggable: true,
                inDuration: 500
            });
        }); 
    </script>
</body>
</html>