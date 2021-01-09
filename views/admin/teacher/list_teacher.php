<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="row">
				<?php
		$TeacherTable = new \Teacher();
		$UserTable    = NEW \User();
		$TeacherTable->select("WHERE status != 501 ORDER BY code ASC");
		if($TeacherTable->count()):
			foreach($TeacherTable->data() As $teacher_):
				$teacher_code = $TeacherTable->find($teacher_->code, 'name');
		 ?>
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
					<div class="pd-20 card-box height-100-p">
						<div class="profile-photo">
							<a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
							<img src="<?=DN?>/assets/vendors/images/photo1.jpg" alt="" class="avatar-photo">
							<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-body pd-5">
											<div class="img-container">
												<img id="image" src="<?=DN?>/assets/vendors/images/photo2.jpg" alt="Picture">
											</div>
										</div>
										<div class="modal-footer">
											<input type="submit" value="Update" class="btn btn-primary">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<h5 class="text-center h5 mb-0"><?=$teacher_->firstname.' '.$teacher_->lastname?></h5>
						<p class="text-center text-muted font-14"><?=$teacher_->email?></p>
						<p class="text-center text-muted font-14"><?=$teacher_->qualification?></p>
						<p class="text-center text-muted font-14"><?=$teacher_->code?></p>
						<div class="profile-social">
							<ul class="clearfix">
							<button type="button" name="view" class="btn btn-info">View</button>
							<button type="button" name="delete" class="btn btn-danger">Delete</button>
							<button type="button" name="edit" class="btn btn-success">Edit</button>
							</ul>
						</div>
					</div>
				</div>
				<?
				endforeach;
		  endif;
		 ?>
			</div>
		</div>
	</div>
</div>
