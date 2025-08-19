

<?php $__env->startSection('mainContent'); ?>

<div class="content-wrapper">
	  <div class="container-full">
		
		<!-- Main content -->
		<section class="content">            
		  <div class="row">

          <div class="col-3">                    
          <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Add Grades</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="<?php echo e(route('store_marks_grades')); ?>">
                    <?php echo csrf_field(); ?>
                      <div class="row">						
                        <div class="col-md-12">
                            <div class="form-group">
								<h5>Grade Name <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="name" class="form-control" required> </div>								
							</div>
                        </div>
                      </div>
                      <div class="row">						
                        <div class="col-md-12">
                            <div class="form-group">
								<h5>Minimum Score<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="min_score" class="form-control" required> </div>								
							</div>
                        </div>
                      </div> 
                      <div class="row">						
                        <div class="col-md-12">
                            <div class="form-group">
								<h5>Maximum Score <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="max_score" class="form-control" required> </div>								
							</div>
                        </div>
                      </div> 
                      <div class="row">						
                        <div class="col-md-12">
                            <div class="form-group">
								<h5>Description<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="description" class="form-control" required> </div>								
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

			<div class="col-9">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Grade Scale</h3>                  
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>S/No</th>																
                                <th>Min Score</th>								
                                <th>Max Score</th>
                                <th>Grade</th>								
                                <th>Description</th>								
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                            <?php $__currentLoopData = $MarksGrade; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key+1); ?></td>
                                <td><?php echo e($Grade->name); ?></td>
                                <td><?php echo e($Grade->min_score); ?></td>
                                <td><?php echo e($Grade->max_score); ?></td>
                                <td><?php echo e($Grade->description); ?></td>
                                <td>
                                    <a href="">
                                        <i class="text-warning mdi mdi-pencil-box-outline"></i> 
                                    </a>
                                    <a href="">
                                        <i class="text-warning mdi mdi-delete"></i> 
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
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/backend/academics/marks_grades.blade.php ENDPATH**/ ?>