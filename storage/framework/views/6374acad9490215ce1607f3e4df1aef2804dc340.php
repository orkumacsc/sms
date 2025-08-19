

<?php $__env->startSection('mainContent'); ?>
<?php $__env->startSection('title', 'School Arms'); ?>

	<div class="content-wrapper">
		<div class="container-full">
			<!-- Main content -->
			<section class="content">
				<!-- Add new school arm modal -->
				<div class="modal fade" id="createClassArm" tabindex="-1" role="document"
					aria-labelledby="createClassArmModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content box">
							<?php echo $__env->make('forms.add_arm', ['routeName' => 'store_school_arm', 'title' => 'Add New School Arm'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					</div>
				</div>
				<!-- /Add new school arm modal -->

				<!-- Add arm to class modal -->
				<div class="modal fade" id="assignClassArmForm" tabindex="-1" role="document"
					aria-labelledby="createClassArmModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content box">
							<?php echo $__env->make('forms.add_discipline_arm', ['routeName' => 'store_discipline_arm', 'title' => 'Add Discipline\'s Arms'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					</div>
				</div>
				<!-- /Add arm to class modal -->

				<!-- Add New Class Modal -->
				<div class="modal fade" id="feesDiscountForm" tabindex="-1" role="document"
					aria-labelledby="feesDiscountModel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content box">
							<?php echo $__env->make('forms.add_class', ['routeName' => 'save_school_class', 'title' => 'Add New Class'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					</div>
				</div>
				<!-- /Add New Class Modal -->

				<!-- Add New Class Modal -->
				<div class="modal fade" id="ClassDisciplineModal" tabindex="-1" role="document"
					aria-labelledby="ClassDisciplineModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content box">
							<?php echo $__env->make('forms.add_class_discipline', ['routeName' => 'store_class_discipline', 'title' => 'Add Class Discipline'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					</div>
				</div>
				<!-- /Add New Class Modal -->

				<div class="row">
					<div class="col-sm-12 col-lg-6">
						<div class="row">
							<div class="col-sm-12">
								<div class="box">
									<div class="box-header with-border">
										<h3 class="box-title">Available Classes</h3>
										<div class="text-right">
											<button type="button" class="btn btn-info" data-toggle="modal"
												data-target="#feesDiscountForm">
												Add New Class
											</button>
										</div>
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
													<?php $__currentLoopData = $schoolClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schoolclass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<tr>
															<td><?php echo e($key + 1); ?></td>
															<td><?php echo e($schoolclass->classname); ?></td>
															<td>
																<div class="dropdown user user-menu">
																	<a href="#" class="btn btn-sm btn-light dropdown-toggle"
																		data-toggle="dropdown" title="View Actions">
																		<i class="ti-menu-alt"></i>
																	</a>
																	<div class="dropdown-menu dropdown-menu-right p-1"
																		style="min-width: 120px;">
																		<a class="dropdown-item text-success py-1 px-2"
																			href="<?php echo e(route('class_profile', $schoolclass->id)); ?>">
																			<i class="mdi mdi-delete"></i> Enter Class
																		</a>
																		<div class="dropdown-divider"></div>
																		<a class="dropdown-item text-info py-1 px-2" href="">
																			<i class="mdi mdi-delete"></i> Update
																		</a>
																		<div class="dropdown-divider"></div>
																		<a class="dropdown-item text-danger py-1 px-2" href="">
																			<i class="mdi mdi-delete"></i> Delete
																		</a>
																	</div>
																</div>
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
						</div>
						<!-- /.row -->
						<div class="row">
							<div class="col-sm-12">
								<div class="box">
									<div class="box-header with-border">
										<h3 class="box-title">Available Arms</h3>
										<div class="text-right">
											<button type="button" class="btn btn-info" data-toggle="modal"
												data-target="#createClassArm">
												Add New Arm
											</button>
										</div>
									</div>
									<!-- /.box-header -->
									<div class="box-body">
										<div class="table-responsive">
											<table id="example1" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>S/No</th>
														<th> <a href="">Arm Name</a></th>
														<th> <a href="">Date Created</a></th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php $__currentLoopData = $schoolArms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $school_arm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<tr>
															<td><?php echo e($key + 1); ?></td>
															<td><?php echo e($school_arm->arm_name); ?></td>
															<td><?php echo e($school_arm->created_at); ?></td>
															<td>
																<div class="dropdown user user-menu">
																	<a href="#" class="btn btn-sm btn-light dropdown-toggle"
																		data-toggle="dropdown" title="View Actions">
																		<i class="ti-menu-alt"></i>
																	</a>
																	<div class="dropdown-menu dropdown-menu-right p-1"
																		style="min-width: 120px;">
																		<a class="dropdown-item text-warning py-1 px-2" href="">
																			<i class="mdi mdi-delete"></i> Update
																		</a>
																		<div class="dropdown-divider"></div>
																		<a class="dropdown-item text-danger py-1 px-2" href="">
																			<i class="mdi mdi-delete"></i> Remove
																		</a>
																	</div>
																</div>
															</td>
														</tr>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- /.box-body -->
								</div>
							</div>
						</div>
					</div>
					<!-- /.col -->

					<div class="col-sm-12 col-lg-6">
						<!-- Class Disciplines -->
						<div class="row">
							<div class="col-sm-12">
								<div class="box">
									<div class="box-header with-border">
										<h3 class="box-title">Class and Disciplines</h3>
										<div class="text-right">
											<button type="button" class="btn btn-info" data-toggle="modal"
												data-target="#ClassDisciplineModal">
												Add Class Disciplines
											</button>
										</div>
									</div>
									<!-- /.box-header -->

									<div class="box-body">
										<div class="table-responsive">
											<table id="example" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>S/No</th>
														<th>Class Name</th>
														<th>Discipline Name</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php $__currentLoopData = $classDisciplines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $classDiscipline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<tr>
															<td><?php echo e($key + 1); ?></td>
															<td><?php echo e($classDiscipline->classname ?? ''); ?></td>
															<td>
																<?php $__currentLoopData = $classDiscipline->disciplines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discipline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																	<?php echo e($discipline->name ?? ''); ?><?php if(!$loop->last): ?>, <?php endif; ?>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</td>
															<td>
																<div class="dropdown user user-menu">
																	<a href="#" class="btn btn-sm btn-light dropdown-toggle"
																		data-toggle="dropdown" title="View Actions">
																		<i class="ti-menu-alt"></i>
																	</a>
																	<div class="dropdown-menu dropdown-menu-right p-1"
																		style="min-width: 120px;">
																		<a class="dropdown-item text-warning py-1 px-2" href="">
																			<i class="mdi mdi-delete"></i> Update
																		</a>
																		<div class="dropdown-divider"></div>
																		<a class="dropdown-item text-danger py-1 px-2" href="">
																			<i class="mdi mdi-delete"></i> Remove
																		</a>
																	</div>
																</div>
															</td>
														</tr>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- /.box-body -->
								</div>
							</div>
						</div>
						<!-- /Class Disciplines -->

						<!--  Discipline and Arms -->
						<div class="row">
							<div class="col-sm-12">
								<div class="box">
									<div class="box-header with-border">
										<h3 class="box-title">Discipline and Arms</h3>
										<div class="text-right">
											<button type="button" class="btn btn-info" data-toggle="modal"
												data-target="#assignClassArmForm">
												Add Discipline's Arms
											</button>
										</div>
									</div>
									<!-- /.box-header -->

									<div class="box-body">
										<div class="table-responsive">
											<table id="example" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>S/No</th>
														<th>Discipline Name</th>
														<th>Arms Added</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php $__currentLoopData = $disciplineArms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $disciplineArm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<tr>
															<td><?php echo e($key + 1); ?></td>
															<td><?php echo e($disciplineArm->name); ?></td>
															<td>
																<?php $__currentLoopData = $disciplineArm->arms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																	<?php echo e($arm->arm_name); ?><?php if(!$loop->last): ?>, <?php endif; ?>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</td>
															<td>
																<div class="dropdown d-inline-block">
																	<a href="#" class="btn btn-sm btn-light dropdown-toggle"
																		data-toggle="dropdown" title="View Actions">
																		<i class="ti-menu-alt"></i>
																	</a>
																	<div class="dropdown-menu dropdown-menu-right p-1"
																		style="min-width: 120px;">
																		<a class="dropdown-item text-warning py-1 px-2" href="">
																			<i class="mdi mdi-delete"></i> Remove
																		</a>
																	</div>
																</div>
															</td>
														</tr>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- /.box-body -->
								</div>
							</div>
						</div>
						<!-- /Discipline and Arms -->

					</div>
				</div>


			</section>
			<!-- /.content -->
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/backend/setup/school_arms.blade.php ENDPATH**/ ?>