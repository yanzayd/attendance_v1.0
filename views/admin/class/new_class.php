<body>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">New Class</h4>
						</div>
					</div>
					<form method="post" id="simpleForm" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-4 col-sm-12">
									<label>Section</label>
									<select id="section" name="class-section" class="custom-select col-12">
										<option value=""hidden>section</option>
										<option value="secondaire General">CO</option>
										<option value="commercial et gestion">CG</option>
										<option value="biochimie">BIO</option>
										<option value="humanite pedagogique">HP</option>
									</select>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label>name</label>
									<input type="text" id="name" name="name" class="form-control">
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
