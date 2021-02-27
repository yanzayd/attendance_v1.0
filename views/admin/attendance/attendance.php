<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
        <div class="card-box mb-30">
          <div class="pd-20">
            <h4 class="text-blue h4">General Attendance</h4>
						<section class="content-header">
				<button class="btn btn-primary btn-sm col-lg-3" style="background: #2A3F54; " data-toggle="modal" data-target="#addAttendance"><i class="fa  fa-plus"> </i>  New Attendance</button><br>
				<!-- MODAL -->
<div class="modal fade bd-example-modal-lg" id="addAttendance" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
			<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Attendance Recording</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label>Names:</label>
								<input  name="name"  type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Email:</label>
								<input  name="email"  type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Gender:</label>
								<input name="gender"  type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Class and Section:</label>
								<input name="classSection"  type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Responsable Phone:</label>
								<input id="address" name="address" type="text" class="form-control">
							</div>
						</div>
					</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



      </div>
    </div>
  </div>
</div>
				<!-- MODAL -->
			</section>
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
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>
