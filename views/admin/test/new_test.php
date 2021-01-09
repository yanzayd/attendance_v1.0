<body>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Form grid Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">New test</h4>
							<!-- <p class="mb-30">All bootstrap element classies</p> -->
						</div>
					</div>
					<form method="post" id="simpleForm" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label>code </label>
									<input type="text" id="code" name="code" class="form-control">
								</div>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label>name</label>
									<input type="text" id="name" name="name" class="form-control">
								</div>
							</div>
              <div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label>date</label>
									<input type="date" id="date" name="date" class="form-control">
								</div>
							</div>
						</div>

					<button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
					<button type="button" style="Background: #2A3F54" class="btn btn-success SubmitRegister">Register</button>
					<!-- <h5 style="color:red;"><?=Session::get('error') ?></h5> -->
					</form>
				</div>
				<!-- Form grid End -->
			</div>
		</div>
	</div>
