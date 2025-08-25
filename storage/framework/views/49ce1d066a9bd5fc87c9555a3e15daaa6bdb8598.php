

<?php $__env->startSection('mainContent'); ?>

<div class="content-wrapper">
	  <div class="container-full">
      <section class="content">
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">View Student By Houses</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="get" action="<?php echo e(route('student_houses')); ?>">
                    
					<div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <h5>Houses<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="id" id="class" required class="form-control p-10">
                                        <option value="">Select House</option>
                                        <?php $__currentLoopData = $Houses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $House): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($House->id); ?>"><?php echo e($House->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                                    </select>
                                    </div>
                                </div>
                            </div>
							<div class="col-sm-4">
								<div class="form-group">									
									<div class="text-xs-right pt-25">
										<input type="submit" value="View Students" class="btn  btn-info">
									</div>
								</div>
							</div>
							
                        </div>                      
						
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		</section>
		<section class="content">

		  <div class="row"> 

			<div class="col-12">

			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">List of Students</h3>                  
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
						<thead>
							<tr>
								<th width="2%">S/No</th>
								<th>Admission No</th>
								<th>Full Name</th>
								<th>Gender</th>
								<th>Class</th>
								<th>House</th>								
							</tr>
						</thead>
						<tbody>
                            <?php $__currentLoopData = $Students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key+1); ?></td>
                                <td><?php echo e($Student->admission_no); ?></td>
                                <td><a href="<?php echo e(route('user.view_profile',$Student->id)); ?>" class="text-success"><?php echo e($Student->surname.', '.$Student->firstname.' '.$Student->middlename); ?></a></td>
								<td><?php echo e($Student->gendername); ?></td>
                                <td><?php echo e($Student->classname); ?></td>
								<td><?php echo e($Student->name); ?></td>								
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
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/backend/admin/StudentManagement/students_houses.blade.php ENDPATH**/ ?>