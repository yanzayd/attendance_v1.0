<body>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">List of Class</h4>
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
									<th>ID</th>
									<th>Code</th>
									<th>Name</th>
									<th>Section</th>
									<th>Created By</th>
									<th>Creation Date</th>
									<th>Action</th>

								</tr>
							</thead>
							<tbody>
<?php
# Load Classes Data
$ClassesTable = new \Classes();
$ClassesTable->select("ORDER BY id ASC");

 if($ClassesTable->count()): $count_=0;
	 foreach($ClassesTable->data() As $class_): $count_++;
		$class_id = $ClassesTable->find($class_->id, 'name');

		$UserTypeTable = new \UserType(); # instanciation of the user type
		$UserTypeTable->select("WHERE id=?", array($session_user_data->user_type_id));
		if($UserTypeTable->count()):
			foreach($UserTypeTable->data() As $user_type):
?>
								<tr id="<?= Hash::encryptToken($class_->id) ?>">
									<td><?=$count_?></td>
									<td><?=$class_->id?></td>
									<td><?=$class_->code?></td>
									<td><?=$class_->name?></td>
									<td><?=$class_->section?></td>
									<td><?=$user_type->name?></td>
									<td><?=$class_->c_date?></td>
									<td>
										<div class="btn-group mr-1 mt-2">
											 <button class="btn btn-secondary btn-sm" type="button">
													Action
												</button>
												<button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													 <i class="mdi mdi-chevron-down"></i>
												</button>
														<div class="dropdown-menu">
															 <a  class="dropdown-item dw dw-eye SubmitDelete"  data-arg="<?= Hash::encryptToken($class_->id) ?>" href="#">Delete</a>
															 <a  class="dropdown-item dw dw-edit2 SubmitEdit" class="dw dw-edit2"  href="<?=DN?>/edit/class/<?= Hash::encryptToken($class_->id) ?>">Edit</a>
														</div>
											</div>
									</td>
								</tr>
<?php
			endforeach;
		endif;
endforeach;
endif;
?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</html>
