<div class="modal bottom-sheet" id="modal_request_sep" style="min-height: 100vh;">
<div class="modal-footer"><button class="btn-flat modal-close">close</button></div>
<div class="modal-content">
    <div class="row container">
        <div class="col s12">
            <div class="col l4 s12 m4 input-field">
                <input type="text" name="" id="batch_num"><label for="">Batch#</label>
            </div>

            <div class="col l4 m4 s12 input-field">
                <input type="text" name="" id="emp_id"><label for="">Employee ID</label>
            </div>

            <div class="col l4 m4 s12 input-field">
                <input type="text" name="" id="name"><label for="">Employee Name</label>
            </div>

            <div class="col l4 m4 s12 input-field">
              <select class="browser-default z-depth-5" name="" id="position">
                <option value="">--POSITION</option>
                <?php
                    $x = "SELECT position FROM position";
                    $stmt = $conn->prepare($x);
                    $stmt->execute();
                    foreach($stmt->fetchALL() as $s){
                        echo '<option value="'.$s['position'].'">'.$s['position'].'</option>';
                    }
                ?>
              </select>
            </div>

            <div class="col l4 m4 s12 input-field">
              <select class="browser-default z-depth-5" name="" id="section">
                <option value="">--SECTION</option>
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
            <!-- TRAINING NEEDS -->
            <div class="col l4 m4 s12 input-field">
              <select class="browser-default z-depth-5" name="" id="training_needs">
                <option value="">--Training Needs</option>
                <option value="ET">Expert Training</option>
                <option value="JT">Jr. Staff Training</option>
                <option value="ST">Staff Training</option>
              </select>
            </div>

            <!-- REASON FOR TRAINING -->
            <div class="col l4 m4 s12 input-field">
              <select class="browser-default z-depth-5" name="" id="reason_training">
                <option value="">--REASON FOR TRAINING</option>
                <option value="REQUIREMENT FOR POSITION">REQUIREMENT FOR POSITION</option>
              </select>
            </div>

            <!-- SCHEDULE -->
            <div class="col l4 m4 s12 input-field">
              <select class="browser-default z-depth-5" name="" id="schedule">
                <option value="">--SCHEDULE</option>
                <?php
                    $x = "SELECT training_sched,description FROM training_schedule";
                    $stmt = $conn->prepare($x);
                    $stmt->execute();
                    foreach($stmt->fetchALL() as $s){
                        echo '<option value="'.$s['training_sched'].'">'.$s['training_sched']."/".$s['description'].'</option>';
                    }
                ?>
              </select>
            </div>

            <!-- SUBMIT -->
            <div class="col s12 input-field">
              <button type="button" class="btn blue large" onclick="send_request()">Submit</button>
            </div>
        </div>
    </div>
</div>
</div>
