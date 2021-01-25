<?php
$StudentTable  = new \Student();
if(!Input::checkInput('_id', 'get', 1)):
  Redirect::to(DN._.'list/student');
endif;
if(!is_numeric(Input::get('_id', 'get'))):
  Redirect::to(DN._.'list/student');
endif;
$_encryptedID_       = Input::get('_id', 'get');
$_ID                 = (int)Hash::decryptToken($_encryptedID_);
$StudentTable->select("WHERE id =? LIMIT 1", Array($_ID));
if($StudentTable->count()):
  foreach($StudentTable->data() as $student_):
  endforeach;
else:
  Redirect::to(DN._.'list/student');
endif;
?>
<div class="main-container">
  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
      <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
          <div class="pd-20 card-box height-100-p">
            <div class="profile-photo">
              <img src="<?=DN?>/assets/vendors/images/photo1.jpg" alt="" class="avatar-photo">
            </div>
            <h5 class="text-center h5 mb-0"><?=$student_->firstname.' '.$student_->lastname?></h5>
            <p class="text-center text-muted font-14">user type</p>
            <div class="profile-info">
              <h5 class="mb-20 h5 text-blue">Student Information</h5>
              <ul>
                <li>
                  <span>Names:</span>
                  <?=$student_->firstname.' '.$student_->lastname.' '.$student_->surname?>
                </li>
                <li>
                  <span>Email Address:</span>
                  <?=$student_->email?>
                </li>
                <li>
                  <span>Responsable Phone Number:</span>
                  <?=$student_->responsable_phone?>
                </li>
                <li>
                  <span>Sex:</span>
                  <?=$student_->gender?>
                </li>
                <li>
                  <span>Birthday:</span>
                  <?=$student_->birthday?>
                </li>
                <li>
                  <span>Address:</span>
                  <?=$student_->address?>
                </li>
                <li>
                  <span>Mother and Father names:</span>
                  <?=$student_->mothername.' and '.$student_->fathername?>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-xl-8 mb-30">
          <div class="card-box height-100-p pd-20">
            <h2 class="h4 mb-20">Attendance Progression</h2>
            <div id="chart6"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-box mb-30">
      <div class="pd-20">
        <h4 class="text-blue h4">Personal Attendance</h4>
      </div>
      <div class="pb-20">
        <table id="datatable" class="checkbox-datatable table nowrap">
          <thead>
            <tr>
              <th><div class="dt-checkbox">
                  <input type="checkbox" name="select_all" value="1" id="example-select-all">
                  <span class="dt-checkbox-label"></span>
                </div>

              </th>
              <th>#</th>
              <th>Names</th>
              <th>Class</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <tr >
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
