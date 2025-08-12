

<?php $__env->startSection('mainContent'); ?>

<div class="content-wrapper">
	  <div class="container-full">
		
		<!-- Main content -->
		<section class="content">            
		  <div class="row">
				<!-- Add New Class Modal -->
				<div class="modal fade" id="feesDiscountForm" tabindex="-1" role="document" aria-labelledby="feesDiscountModel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content box">
							<form method="post" action="<?php echo e(route('save_school_class')); ?>">
								<?php echo csrf_field(); ?>
								<div class="modal-header bg-info">
									<h5 class="modal-title" id="feesDiscountModal">Add New Class</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="tru">&times;</span>
									</button>
								</div>
								<div class="modal-body box-body">
									<div class="row">						
										<div class="col-md-12">
											<div class="form-group">
												<h5>Class <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="class" class="form-control" required> 
												</div>								
											</div>
											
											<div class="form-group">
												<h5>Session <span class="text-danger">*</span></h5>
												<div class="controls">
													<select name="session" class="form-control">
														<?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<option value="<?php echo e($session->id); ?>">
															<?php echo e($session->name); ?>

														</option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</select>
												</div>
											</div>
										</div> 																			
									</div>					
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
									<input type="submit" value="Save Class" class="btn  btn-info">
								</div>
							</form>								
						</div>
					</div>
				</div>			
				<!-- /Add New Class Modal -->

			<div class="col-sm-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">List of Classes</h3>
				  	<div class="text-right">
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#feesDiscountForm">
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
                            <?php $__currentLoopData = $allData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schoolclass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key+1); ?></td>
                                <td><?php echo e($schoolclass->classname); ?></td>
                                <td>									
									<ul class="nav navbar-nav">
										<li class="dropdown user user-menu">	
											<a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown" title="View Actions">
												<i class="ti-menu-alt"></i>
											</a>
											<ul class="dropdown-menu animated flipInX">
												<li class="user-body">
													<a class="dropdown-item text-success" href="<?php echo e(route('class_profile',$schoolclass->id)); ?>" onclick=""><i class="mr-2 ti-eye"></i> Enter Class</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item text-warning" href=""><i class="mr-2 mdi mdi-pencil-box-outline"></i> Edit Class</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item text-danger" href=""><i class="mr-2 mdi mdi-delete"></i> Delete Class</a>
												</li>
											</ul>
										</li>			  
									</ul> 									                           
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
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/backend/setup/school_classes.blade.php ENDPATH**/ ?>