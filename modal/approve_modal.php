<div class="modal" id="approval_modal">
<div class="modal-content">
<div class="row">
  <div class="col s12 center">
    <h5>Menu</h5>
    <input type="hidden" name="" id="req_id_app">
    <div class="col s6 input-field">
      <button type="button" name="button" class="btn blue btn-large col s12" onclick="approved_btn()">approved</button>
    </div>
    <div class="col s6 input-field">
      <button type="button" name="button"  class="btn red btn-large col s12" onclick="show_cancel_form()">cancel request</button>
    </div>
  </div>

  <!-- REMARKS -->
  <div class="col s12" id="cancel_form" style="display:none;">
    <div class="col s12 input-field">
      <input type="text" name="" value="" id="cancel_remarks"><label for="">CANCELLING REMARKS</label>
    </div>
    <div class="col s12 input-field">
      <button type="button" name="button" class="btn red btn-large" onclick="decline_req_btn()">confirm cancel</button>
    </div>
  </div>
</div>
</div>
</div>
