

<?php $__env->startSection('mainContent'); ?>

<div class="content-wrapper">
	<div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-sm-12">

					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">List of Classes</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>S/No</th>
											<th> <a href="">Class</a></th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $ClassArms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schoolclass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e($key + 1); ?></td>
												<td><?php echo e($schoolclass->classname); ?> <?php echo e($schoolclass->arm_name); ?></td>
												<td>
													<a class="text-success"
														href="<?php echo e(route('class_profile', "{$class_id}_{$schoolclass->id}")); ?>"
														onclick=""><i class="mr-2 ti-eye"></i> Enter Class
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
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/backend/setup/class_profile.blade.php ENDPATH**/ ?>