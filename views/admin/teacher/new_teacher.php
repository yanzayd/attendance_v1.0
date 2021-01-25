<body>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">New Teacher</h4>
						</div>
					</div>
					<form method="post" id="simpleForm" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>First Name</label>
                  <input id="firstname" name="firstname" type="text" class="form-control">
                </div>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Last Name</label>
                  <input id="lastname" name="lastname" type="text" class="form-control">
                </div>
              </div>
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label>Email</label>
									<input id="email" name="email" type="text" class="form-control">
								</div>
							</div>
            </div>
            <div class="row">
							<div class="col-md-4 col-sm-12">
								<label>Gender</label>
									<select id="gender" name="gender" class="custom-select col-12">
										<option selected=""hidden>[Choose your gender]</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Address</label>
                  <input id="address" name="address" type="text" class="form-control">
                </div>
              </div>
							<div class="col-md-4 col-sm-12">
								<label>Qualification</label>
									<select id="qualification" name="qualification" class="custom-select col-12">
										<option selected="" hidden>[Choose your qualification]</option>
										<option value="PHD">PHD</option>
										<option value="Master">Master</option>
										<option value="Licence">Licence</option>
									</select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Nationality</label>
                  <input id="nationality" name="nationality" type="text" class="form-control">
                </div>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Birthday</label>
                  <input id="birthday" name="birthday" type="date" class="form-control">
                </div>
              </div>
							<div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Religion</label>
                  <input id="religion" name="religion" type="text" class="form-control">
                </div>
              </div>
            </div>
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label>Telephone</label>
									<input id="telephone" name="telephone" type="text" class="form-control">
								</div>
							</div>
						</div>
						<button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
						<button type="button" style="Background: #2A3F54" class="btn btn-success SubmitRegister">Register</button>
					</form>
				</div>
			</div>
		</div>
	</div>
