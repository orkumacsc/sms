
<?php $__env->startSection('mainContent'); ?>
<?php $__env->startSection('title', 'Staff Class Assignment'); ?>

<div class="content-wrapper">
	<div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<!-- Admission Form Modal -->
				<div class="modal fade" id="AppointClassTeacher" tabindex="-1" role="document"
					aria-labelledby="EnrolStudentModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content box">
							<?php echo $__env->make('forms.staff_class_assignment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>			
						</div>
					</div>
				</div>
				<!-- /Admission Form Modal -->

				<div class="col-12">
					<div class="box">
					    <div class="box-header with-border">
                            <h3 class="box-title">List of Form Masters</h3>
                            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#AppointClassTeacher">
                                Appoint Class Teacher
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
											<th>Staff ID</th>
                                            <th>Full Name</th>
                                            <th>Gender</th>
                                            <th>Class Assigned</th>                                            
											<th>Action</i></th>
										</tr>
									</thead>
									<tbody>
										<?php $__empty_1 = true; $__currentLoopData = $classTeachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $classTeacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
											<tr>
												<td><?php echo e($key + 1); ?></td>
												<td><?php echo e($classTeacher->staff_no); ?></td>
												<td>
                                                    <?php echo e("{$classTeacher->surname}, {$classTeacher->firstname} {$classTeacher->middlename}"); ?>

												</td>
												<td><?php echo e($classTeacher->gender); ?></td>
												<td><?php echo e($classTeacher->classGroup()->first()->classname ?? 'Not Assigned Class'); ?></td>
												<td>
													<form action="<?php echo e(route('staff.classes.update', $classTeacher->id)); ?>" method="POST" class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <button type="submit" class="btn btn-info btn-md" onclick="return confirm('Are you sure you want to update this class assignment?')">Update</button>
													</form>
													<a href="<?php echo e(route('staff.classes.delete', $classTeacher->id)); ?>"
                                                        class="text-danger" onclick="return confirm('Are you sure you want to delete this class assignment?')">
                                                        <i class="mdi mdi-delete"></i>
													</a>
												</td>
											</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
											<tr>
												<td colspan="6" class="text-center">No Staff Found</td>
											</tr>
										<?php endif; ?>
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
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/backend/Staff/staff_classes.blade.php ENDPATH**/ ?>