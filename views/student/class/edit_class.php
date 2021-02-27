<?php
$ClassesTable  = new \Classes();
if(!Input::checkInput('_id', 'get', 1)):
  Redirect::to(DN._.'list/class');
endif;
if(!is_numeric(Input::get('_id', 'get'))):
  Redirect::to(DN._.'list/class');
endif;
$_encryptedID_       = Input::get('_id', 'get');
$_ID                 = (int)Hash::decryptToken($_encryptedID_);
$ClassesTable->select("WHERE id =? LIMIT 1", Array($_ID));
if($ClassesTable->count()):
  foreach($ClassesTable->data() as $class_):
  endforeach;
else:
  Redirect::to(DN._.'list/class');
endif;
?>
<body>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Edit Class</h4>
						</div>
            <hr/>
					</div>
					<form method="post" id="simpleForm">
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label>code</label>
									<input type="text" value="<?= $class_->code?>" id="code" name="code" class="form-control">
								</div>
							</div>
							<div class="col-md-4 col-sm-12">
									<label>Section</label>
									<select value="" id="section" name="section" class="custom-select col-12">
										<option value="<?= $class_->id?>"hidden><?= $class_->section?></option>
										<option value="secondaire General">CO</option>
										<option value="commercial et gestion">CG</option>
										<option value="biochimie">BIO</option>
										<option value="humanite pedagogique">HP</option>
									</select>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label>name</label>
									<input value="<?= $class_->name?>" type="text" id="name" name="name" class="form-control">
								</div>
							</div>
						</div>
            <hr/>
            <input type="hidden" name="_ID" id="_ID" value="<?= $_encryptedID_ ?>">
						<button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
						<button type="button" style="Background: #2A3F54" class="btn btn-success SubmitUpdateInformation">Save</button>
					</form>
				</div>
			</div>
		</div>
	</div>
