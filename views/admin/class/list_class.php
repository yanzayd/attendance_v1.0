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
									<th>Created By</th>
									<th>Creation Date</th>

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
?>
								<tr >
									<td><?=$count_?></td>
									<td><?=$class_->id?></td>
									<td><?=$class_->code?></td>
									<td><?=$class_->name?></td>
									<td><?=$class_->registered_by?></td>
									<td><?=$class_->c_date?></td>
								</tr>
<?php
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
