<form method="post" action="<?php echo e(route($routeName)); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
	<div class="modal-header">
		<h5 class="modal-title" id="AssignSubjectModal"> 
			<i class="text-secondary mdi mdi-calculator-variant-outline"></i> <?php echo e($title); ?>

		</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body box-body my-10">
		<div class="row">
			<div class="table-responsive col-sm-12">
				<table id="" class="table table-bordered nowrap">
					<thead>
						<tr>
							<th>S/No</th>
							<th>Discipline Name</th>
							<th>
								<input type="checkbox" name="" id="_selectAllCheckbox" />
								<label for="_selectAllCheckbox">Tick All</label>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $disciplines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $discipline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($key + 1); ?></td>
								<td><?php echo e($discipline->name); ?>

								</td>
								<td>
									<input type="checkbox" id="_<?php echo e($discipline->id); ?>" name="discipline_id[]" value="<?php echo e($discipline->id); ?>"
										class="_checkboxes">
									<label for="_<?php echo e($discipline->id); ?>"></label>
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<h5>School Class<span class="text-danger">*</span></h5>
					<div class="controls">
						<select name="class_id" id="class_id" required class="form-control p-10">
							<option value="">Select School Class</option>
							<?php $__currentLoopData = $schoolClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schoolClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($schoolClass->id); ?>"><?php echo e($schoolClass->classname); ?>

								</option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				</div>
			</div>
		</div>		
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
				class="ti-arrow-left"> Cancel</i></button>
		<input type="submit" value="Add" class="btn  btn-info">
	</div>
</form>

<script>	
	document.getElementById('_selectAllCheckbox')
		.addEventListener('change', function () {
			let checkboxes =
				document.querySelectorAll('._checkboxes');
			checkboxes.forEach(function (checkbox) {
				checkbox.checked = this.checked;
			}, this);
		});
</script><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/forms/add_class_discipline.blade.php ENDPATH**/ ?>