

<?php $__env->startSection('mainContent'); ?>

<div class="content-wrapper">
	  <div class="container-full">
		
		<!-- Main content -->
		<section class="content">            
		  <div class="row">		  
          <div class="col-4">                    
          <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Add Assessment Types</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="<?php echo e(route('store_assessment_type')); ?>">
                    <?php echo csrf_field(); ?>
                      <div class="row">						
                        <div class="col-md-12">
                            <div class="form-group">
								<h5>Assessment Type <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="name" class="form-control" required> </div>								
							</div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
								<h5>Percentage<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="number" name="percentage" class="form-control" required> </div>								
							</div>
                        </div>
                      </div>                      
						<div class="text-xs-right">
							<input type="submit" value="Add" class="btn  btn-info">
						</div>
					</form>
					
				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->			  
			</div>
			
			<!-- /.box-body -->
		  </div>

		  
		  
          </div>

			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Class List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table class="table table-bordered">
						<thead>
							<tr>
								<th>S/No</th>
								<th>Assessments</th>
                                <th>Total Score</th>								
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                            <?php $__currentLoopData = $assTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $assType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key+1); ?></td>
                                <td><?php echo e($assType->name); ?></td>
                                <td><?php echo e($assType->percentage); ?></td>
                                <td>
                                    <a class="btn btn-info" href="">Edit</a>
                                    <a class="btn btn-danger" href="">Delete</a>
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
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/backend/Examination/ass_type_add.blade.php ENDPATH**/ ?>