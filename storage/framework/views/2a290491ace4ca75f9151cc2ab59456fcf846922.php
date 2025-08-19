
<?php $__env->startSection('mainContent'); ?>
<?php $__env->startSection('title', 'My Students'); ?>
	<div class="content-wrapper">
		<div class="container-full">
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- Admission Form Modal -->
					<div class="modal fade" id="EnrolStudent" tabindex="-1" role="document"
						aria-labelledby="EnrolStudentModal" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
							<div class="modal-content box">

							</div>
						</div>
					</div>
					<!-- /Admission Form Modal -->

					<div class="col-12">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Students in my class</h3>
								<button type="button" class="btn btn-success pull-right" data-toggle="modal"
									data-target="#EnrolStudent">
									Mark Attendance
								</button>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="table-responsive">
									<table id="example"
										class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
										<thead>
											<tr>
												<th width="2%">S/No</th>
												<th>Admission No</th>
												<th>Full Name</th>
												<th>Gender</th>
												<th>Class</th>
												<th>House</th>
												<th>Date of Birth</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<tr>
													<td><?php echo e($key + 1); ?></td>
													<td><?php echo e($Student->admission_no); ?></td>
													<td><a href="<?php echo e(route('view_student_profile', $Student->students_id)); ?>"
															class="text-success"
															target="_blank"><?php echo e("{$Student->surname}, {$Student->firstname} {$Student->middlename}"); ?></a>
													</td>
													<td><?php echo e($Student->gendername ?? ''); ?></td>
													<td><?php echo e($Student->name ?? ''); ?></td>
													<td><?php echo e($Student->housename ?? ''); ?></td>
													<td><?php echo e($Student->date_of_birth ?? ''); ?></td>
													<td>
														<a href="<?php echo e(route('admission_letter', $Student->students_id)); ?>"
															target="_blank">
															<i class="text-warning mdi mdi-printer"></i>
														</a>
														<a href="<?php echo e(route('edit_student_record', $Student->students_id)); ?>"
															target="_blank">
															<i class="text-warning mdi mdi-pencil-box-outline"></i>
														</a>
														<a href="<?php echo e(route('suspend_student', $Student->students_id)); ?>"
															onclick="return confirm('Do you wish to suspend the selected student?')">
															<i class="text-warning mdi mdi-close-octagon"></i>
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
						<!-- /.box -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</section>
			<!-- /.content -->
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Teachers.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/Teachers/students/view.blade.php ENDPATH**/ ?>