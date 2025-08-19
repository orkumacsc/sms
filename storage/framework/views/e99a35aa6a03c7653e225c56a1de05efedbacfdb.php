

<?php $__env->startSection('mainContent'); ?>

<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
			<!-- row -->
			<div class="row">
				<!-- Form Modals Section -->
				<div class="modal fade" id="CreateSubject" tabindex="-1" role="document"
					aria-labelledby="CreateSubjectModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content box">
							<form method="post" action="<?php echo e(route('store_school_subject')); ?>"
								enctype="multipart/form-data">
								<?php echo csrf_field(); ?>
								<div class="modal-header">
									<h5 class="modal-title" id="CreateSubjectModal"> 
										<i class="text-secondary mdi mdi-calculator-variant-outline"></i> 
										Add School Subjects
									</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body box-body my-10">
									<div class="row items-baseline">
										<div class="col-md-12">
											<div class="form-group">
												<h5>SUBJECT NAME<span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="subject_name" class="form-control"
														placeholder="Enter Subject Name Here" required>
												</div>
											</div>
										</div>
									</div>
									<div class="row items-baseline">
										<div class="col-md-12">
											<div class="form-group">
												<h5>CROSS-CURRICULAR<span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="checkbox" name="cross_curricular" id="cross_curricular" value="1">
													<label for="cross_curricular">Is this subject cross-curricular? i.e Compulsory for all classes?</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal"
										aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
									<input type="submit" value="Add" class="btn  btn-info">
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="modal fade" id="AssignSubject" tabindex="-1" role="document"
					aria-labelledby="AssignSubjectModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content box">
							<form method="post" action="<?php echo e(route('store_class_subject')); ?>"
								enctype="multipart/form-data">
								<?php echo csrf_field(); ?>
								<div class="modal-header">
									<h5 class="modal-title" id="AssignSubjectModal"> 
										<i class="text-secondary mdi mdi-calculator-variant-outline"></i> 
										Add Class Subjects
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
														<th>SUBJECT NAME</th>
														<th>
															<input type="checkbox" name="" id="selectAllCheckbox" />
															<label for="selectAllCheckbox">Tick All</label>
														</th>
													</tr>
												</thead>

												<tbody>
													<?php $__currentLoopData = $SchoolSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $smSubject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                            
														<tr>
															<td><?php echo e($key + 1); ?></td>
															<td><?php echo e($smSubject->subject_name); ?>

															</td>
															<td>
																<input type="checkbox" id="<?php echo e($smSubject->id); ?>"
																	name="subject_id[<?php echo e($smSubject->id); ?>]"
																	class="checkboxes">
																<label for="<?php echo e($smSubject->id); ?>"></label>
															</td>
														</tr>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</tbody>
											</table>

										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<h5>CLASS<span class="text-danger">*</span></h5>
												<div class="controls">
													<select name="class_id" id="class_id" required
														class="form-control p-10">
														<option value="">SELECT CLASS</option>
														<?php $__currentLoopData = $SchoolClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $smClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($smClass->id); ?>"><?php echo e($smClass->classname); ?>

															</option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<h5>DEPARTMENT<span class="text-danger">*</span></h5>
												<div class="controls">
													<select name="department_id" id="department_id"
														class="form-control p-10">
														<option value="">SELECT DEPARTMENT</option>
														<?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($department->id); ?>">
																<?php echo e($department->name); ?>

															</option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal"
										aria-label="close"><i class="ti-arrow-left"> CANCEL</i></button>
									<input type="submit" value="SAVE ASSIGNED SUBJECTS" class="btn  btn-info">
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="modal fade" id="AddDisciplineSubjectsModal" tabindex="-1" role="document"
					aria-labelledby="AddDisciplineSubjects" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-md" role="document">
						<div class="modal-content box">
							<?php echo $__env->make('forms.add_discipline_subjects', ['routeName' => 'store_discipline_subjects', 'title' => 'Add Discipline Subjects'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					</div>
				</div>
				<!-- /Form Modals Section -->

				<!-- Subjects Section -->
				<div class="col-lg-5 col-md-12">
					<!-- Subject List Box -->
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">School Subjects</h3>
							<div class="text-right">
								<button type="button" class="btn btn-info" data-toggle="modal"
									data-target="#CreateSubject">
									Add Subject
								</button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table id="example1"
									class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
									<thead>
										<tr>
											<th>S/No</th>
											<th> <a href="">Subject Name</a></th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $SchoolSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $smSubjects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e($key + 1); ?></td>
												<td><?php echo e($smSubjects->subject_name); ?></td>
												<td class="text-center">
													<a href=""><i class="text-warning mdi mdi-pencil-box-outline"></i></a>
													<a href=""
														onclick="return confirm('Are You Sure You Want To Delete The Selected Student')">
														<i class="text-danger mdi mdi-delete"></i>
													</a>
												</td>
											</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- / Subject List Box -->
				</div>
				<!-- /Subjects Section -->

				<!-- Assign Subjects to Class Section -->
				<div class="col-lg-7 col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Class and Subjects</h3>
							<div class="text-right">
								<button type="button" class="btn btn-info" data-toggle="modal"
									data-target="#AddDisciplineSubjectsModal">
									Add Discipline Subjects
								</button>
								<button type="button" class="btn btn-info" data-toggle="modal"
									data-target="#AssignSubject">
									Add Class Subjects
								</button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table id="example"
									class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
									<thead>
										<tr>
											<th>S/No</th>
											<th>Subject Name</th>
											<th>Department</th>											
											<th>Class</th>
										</tr>
									</thead>
									<tbody>
										<?php if(isset($disciplineSubjects) && count($disciplineSubjects) > 0): ?>
											<?php $__currentLoopData = $disciplineSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $disciplineSubject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<tr>
													<td><?php echo e($key + 1); ?></td>
													<td><?php echo e($disciplineSubject->subject_name ?? ''); ?></td>
													<td><?php echo e($disciplineSubject->department ?? ''); ?></td>
													<td><?php echo e($disciplineSubject->classname ?? ''); ?></td>
												</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<tr>
												<td colspan="4" class="text-center">No class subjects found.</td>
											</tr>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- /.box-body -->
					</div>

				</div>
				<!-- /Assign Subjects to Class Section -->
			</div>
			<!-- /.row -->
		</section>
		<!-- /.content -->
	</div>
</div>

<script>	
	document.getElementById('selectAllCheckbox')
		.addEventListener('change', function () {
			let checkboxes =
				document.querySelectorAll('.checkboxes');
			checkboxes.forEach(function (checkbox) {
				checkbox.checked = this.checked;
			}, this);
		});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/backend/academics/school_subjects.blade.php ENDPATH**/ ?>