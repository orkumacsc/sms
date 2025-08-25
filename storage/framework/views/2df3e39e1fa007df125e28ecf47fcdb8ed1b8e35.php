

<?php $__env->startSection('mainContent'); ?>
<?php $__env->startSection('title', 'Staff Dashboard'); ?>
	<div class="content-wrapper">
		<div class="container-full">
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<?php if(session('staff_profile')): ?>
						<?php echo $__env->make('Teachers.body.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php endif; ?>
					<div class="modal fade" id="ChangePassword" tabindex="-1" role="document"
						aria-labelledby="ChangePasswordModal" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered " role="document">
							<div class="modal-content box">
								<form method="post" action="javascript:void(0);" enctype="multipart/form-data">
									<div class="modal-header">
										<h5 class="modal-title" id="ChangePasswordModal"> <i
												class="text-secondary mdi mdi-lock-reset"></i> Change Password</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body box-body my-10">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<div class="controls">
														<input type="password" name="current_password" class="form-control"
															placeholder="Enter Your Current Password" required>
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<input type="password" name="password" class="form-control"
															placeholder="Enter Your New Password" required>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<input type="password" name="confirm_password" class="form-control"
															placeholder="Confirm New Password" required>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-danger" data-dismiss="modal"
											aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
										<input type="submit" value="Change Password" class="btn  btn-info">
									</div>
								</form>
							</div>
						</div>
					</div>

					<div class="modal fade" id="TeacherClasses" tabindex="-1" role="document"
						aria-labelledby="TeacherClassesModal" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered " role="document">
							<div class="modal-content box">
								<div class="table-responsive col-sm-12">
									<table id="" class="table table-bordered nowrap">
										<caption class="text-left font-weight-bold mb-2 text-muted"
											style="caption-side: top;">
											<p>
												My Classes
											</p>											
										</caption>
										<thead>
											<tr>
												<th>S/No</th>
												<th>Class Name</th>
												<th>
													Action
												</th>
											</tr>
										</thead>
										<tbody>
											<?php $__currentLoopData = $teacherClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $teacherClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php
													$class = $teacherClass->class()->first();
													$department = $teacherClass->department()->first();
													$arm = $teacherClass->arm()->first();
												?>
												<tr>
													<td><?php echo e($key + 1); ?></td>
													<td>
														<?php echo e($class->classname); ?>

														<?php echo e($department->name); ?>

														<?php echo e($arm->arm_name); ?>

													</td>
													<td>
														<form method="get" action="<?php echo e(route('teachers.students.view')); ?>">															
															<input type="hidden" name="school_classes_id"
																value="<?php echo e($class->id); ?>">
															<input type="hidden" name="departments_id"
																value="<?php echo e($department->id); ?>">
															<input type="hidden" name="school_arms_id"
																value="<?php echo e($arm->id); ?>">
															<input type="hidden" name="staff_id"
																value="<?php echo e($teacherClass->teacher_id); ?>">
															<button type="submit" class="btn btn-info btn-md"> <i class="mdi mdi-eye"></i> Enter Class</button>
														</form>
													</td>
												</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					<?php if(isset($teacherClasses) && $teacherClasses->isNotEmpty()): ?>
						<div class="col-12 col-md-6 col-xl-2">
							<a href="#" data-toggle="modal" data-target="#TeacherClasses">
								<div class="box overflow-hidden pull-up">
									<div class="box-body">
										<div class="icon bg-info-light rounded w-60 h-60">
											<i class="text-info mr-0 font-size-36 mdi mdi-school"></i>
										</div>
										<div>
											<p class="text-mute mt-20 mb-0 font-size-16">My Classes</p>
											<h3 class="text-white mb-0 font-weight-500"><?php echo e($teacherClasses->count()); ?></h3>
										</div>
									</div>
								</div>
							</a>
						</div>
					<?php endif; ?>

					<div class="col-12 col-md-6 col-xl-2">
						<a href="#" data-toggle="modal" data-target="#Profile">
							<div class="box overflow-hidden pull-up">
								<div class="box-body">
									<div class="icon bg-info-light rounded w-60 h-60">
										<i class="text-info mr-0 font-size-36 mdi mdi-school"></i>
									</div>
									<div>
										<p class="text-mute mt-20 mb-0 font-size-16">My Routines</p>
										<h3 class="text-white mb-0 font-weight-500">6</h3>
									</div>
								</div>
							</div>
						</a>
					</div>

					<div class="col-12 col-md-6 col-xl-2">
						<a href="#" data-toggle="modal" data-target="#Profile">
							<div class="box overflow-hidden pull-up">
								<div class="box-body">
									<div class="icon bg-info-light rounded w-60 h-60">
										<i class="text-info mr-0 font-size-36 mdi mdi-face-man-profile"></i>
									</div>
									<div>
										<p class="text-mute mt-20 mb-0 font-size-16">Profile</p>
										<h3 class="text-white mb-0 font-weight-500"></h3>
									</div>
								</div>
							</div>
						</a>
					</div>

					<div class="col-12 col-md-6 col-xl-2">
						<a href="#" data-toggle="modal" data-target="#ChangePassword">
							<div class="box overflow-hidden pull-up">
								<div class="box-body">
									<div class="icon bg-info-light rounded w-60 h-60">
										<i class="text-info mr-0 font-size-36 mdi mdi-lock-reset"></i>
									</div>
									<div>
										<p class="text-mute mt-20 mb-0 font-size-16">Change Password</p>
										<h3 class="text-white mb-0 font-weight-500"></h3>
									</div>
								</div>
							</div>
						</a>
					</div>

				</div>
			</section>
			<!-- /.content -->
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Teachers.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/Teachers/dashboard.blade.php ENDPATH**/ ?>