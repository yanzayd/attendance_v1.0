<?php
$AppUsersTable  = new \AppUsers();
if(!Input::checkInput('_id', 'get', 1)):
  Redirect::to(DN._.'list/teacher');
endif;
if(!is_numeric(Input::get('_id', 'get'))):
  Redirect::to(DN._.'list/teacher');
endif;
$_encryptedID_       = Input::get('_id', 'get');
$_ID                 = (int)Hash::decryptToken($_encryptedID_);
$AppUsersTable->select("WHERE id =? LIMIT 1", Array($_ID));
if($AppUsersTable->count()):
  foreach($AppUsersTable->data() as $teacher):
  endforeach;
else:
  Redirect::to(DN._.'list/teacher');
endif;
?>
<body>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Edit Student</h4>
						</div>
					</div>
					<form method="post" id="simpleForm" enctype="multipart/form-data" >
            <div class="row">
							<div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>First Name</label>
                  <input id="firstname" name="firstname" value="<?=$teacher->firstname?>"  type="text" class="form-control">
                </div>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Last Name</label>
                  <input id="lastname" name="lastname" value="<?=$teacher->lastname?>" type="text" class="form-control">
                </div>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Surname</label>
                  <input id="surname" name="surname" value="<?=$teacher->surname?>"  type="text" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Email</label>
                  <input id="email" name="email" value="<?=$teacher->email?>"  type="email" class="form-control">
                </div>
              </div>
              <div class="col-md-4 col-sm-12">
								<label>Gender</label>
									<select id="gender" name="gender" class="custom-select col-12">
										<option selected="" value="<?=$teacher->gender?>"><?=$teacher->gender?></option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Address</label>
                  <input id="address" name="address" value="<?=$teacher->address?>" type="text" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
							<div class="col-md-4 col-sm-12">
								<label>Class</label>
									<select id="classes" name="classes" class="custom-select col-12">
										<option  selected="" value="<?=$teacher->classes?>" hidden><?=$teacher->classes?></option>
	<?
   $ClassesTable = new \Classes();
	 $ClassesTable->select('ORDER BY name ASC');
	 if($ClassesTable->count()):
		 foreach ($ClassesTable->data() as $class_):
	?>
	                <option value="<?=$class_->name.' '.$class_->section?>"><?=$class_->name.' '.$class_->section?></option>
	<?
  endforeach;
endif;
	?>
									</select>
							</div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Nationality</label>
                  <input id="nationality" name="nationality" value="<?=$teacher->nationality?>"  type="text" class="form-control">
                </div>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Birthday</label>
                  <input id="birthday" name="birthday" value="<?=$teacher->birthday?>"  type="date" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Mother Name</label>
                  <input id="mothername" name="mothername" value="<?=$teacher->mothername?>" type="text" class="form-control">
                </div>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Father Name</label>
                  <input id="fathername" name="fathername" value="<?=$teacher->fathername?>" type="text" class="form-control">
                </div>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Responsible Phone</label>
                  <input id="responsable_phone" name="responsable_phone" value="<?=$teacher->responsable_phone?>"  type="text" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Religion</label>
                  <input id="religion" name="religion" value="<?=$teacher->religion?>" type="text" class="form-control">
                </div>
              </div>
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label>Card ID</label>
									<input id="card_id" name="card_id" value="<?=$teacher->card_id?>" type="text" class="form-control">
								</div>
							</div>
            </div>
						<button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
	 					<button type="button" style="Background: #2A3F54" class="btn btn-success SubmitRegister">Save</button>
					</form>
				</div>
			</div>
		</div>
	</div>
