<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="row">
				<?php
		$AppUsersTable = new \AppUsers();
		$UserTypeTable = new \UserType();
		$AppUsersTable->select("WHERE status != 501 ORDER BY code ASC");
		if($AppUsersTable->count()):
			foreach($AppUsersTable->data() As $teacher_):
				$teacher_code = $AppUsersTable->find($teacher_->code, 'name');
		 ?>
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30" id="card-<?= Hash::encryptToken($teacher_->id)?>">
					<div class="pd-20 card-box height-100-p">
						<div class="profile-photo">
							<img src="<?=DN?>/assets/vendors/images/teacherIcon.jpeg" alt="" class="avatar-photo">
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
						<div class="text-center">
							<!-- <button type="button" style="Background: #2A3F54" class="btn btn-success dw dw-eye SubmitEdit" onclick="window.location.href='<?=DN?>/profile/teacher/<?= Hash::encryptToken($teacher_->id) ?>';" title="View"></button> -->
							<button disabled type="button" style="Background: #218838" class="btn btn-success dw dw-edit2 SubmitEdit" onclick="window.location.href='<?=DN?>/edit/teacher/<?= Hash::encryptToken($teacher_->id) ?>';" title="Edit"></button>
							<button disabled type="button" style="Background: #dc3545" class="btn btn-success dw dw-delete-3 SubmitDelete" data-arg="<?= Hash::encryptToken($teacher_->id) ?>" title="Delete"></button>
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
