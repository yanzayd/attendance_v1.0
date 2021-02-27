<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="row">
<?php
$StudentTable = new \Student();
$UserTable    = NEW \User();
$StudentTable->select("WHERE status != 501 ORDER BY rollnumber ASC");
if($StudentTable->count()):
  	foreach($StudentTable->data() As $student_):
		   $student_rollnumber = $StudentTable->find($student_->rollnumber, 'name');
	?>
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30" id="card-<?= Hash::encryptToken($student_->id)?>">
					<div class="pd-20 card-box height-100-p">
						<div class="profile-photo">
							<img src="<?=DN?>/assets/vendors/images/studentIcon.png" alt="" class="avatar-photo">
							<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-body pd-5">
											<div class="img-container">
												<img id="image" src="<?=DN?>/assets/vendors/images/photo2.jpg" alt="Picture">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<h5 class="text-center h5 mb-0"><?=$student_->firstname.' '.$student_->lastname?></h5>
						<p class="text-center text-muted font-14"><?=$student_->email?></p>
						<p class="text-center text-muted font-14"><?=$student_->classes?></p>
						<p class="text-center text-muted font-14"><?=$student_->address?></p>
						<div class="text-center">
							<button type="button" style="Background: #2A3F54" class="btn btn-success dw dw-eye SubmitEdit" onclick="window.location.href='<?=DN?>/profile/student/<?= Hash::encryptToken($student_->id) ?>';" title="View"></button>
							<button type="button" style="Background: #218838" class="btn btn-success dw dw-edit2 SubmitEdit" onclick="window.location.href='<?=DN?>/edit/student/<?= Hash::encryptToken($student_->id) ?>';" title="Edit"></button>
							<button type="button" style="Background: #dc3545" class="btn btn-success dw dw-delete-3 SubmitDelete" data-arg="<?= Hash::encryptToken($student_->id) ?>" title="Delete"></button>
						</div>
					</div>
				</div>
<?php
endforeach;
endif;
?>
			</div>
			<!-- End Block -->
		</div>
	</div>
</div>
