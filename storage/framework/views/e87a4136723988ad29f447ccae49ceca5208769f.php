

<?php $__env->startSection('mainContent'); ?>

<div class="content-wrapper">
	  <div class="container-full">
		
		<!-- Main content -->
		<section class="content">            
		  
          <div class="row">                    
          <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Assign Assessment To Scoresheet</h4>			  
        </div>
        <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
            <div class="col">
              <form method="post" action="<?php echo e(route('store_asign_assessment')); ?>">
                <?php echo csrf_field(); ?>
              <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Assessment<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <select name="asstype" id="sid" required class="form-control p-10">
                                        <option value="">Select Assessment</option>                                        
                                            <?php $__currentLoopData = $assTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $AssType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($AssType->id); ?>"><?php echo e($AssType->name); ?> (<?php echo e($AssType->percentage); ?>)</option> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                       
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Class<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <select name="class" id="class" required class="form-control p-10">
                                            <option value="">Select Class</option>
                                            <?php $__currentLoopData = $Classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($Class->id); ?>"><?php echo e($Class->classname); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                                        </select>
                                        </div>
                                    </div>
                                </div>
                  <div class="col-sm-4">
                    <div class="form-group">									
                      <div class="text-xs-right pt-25">
                        <input type="submit" value="Generate Exam Cards" class="btn  btn-info">
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
          </div>

			<div class="row">
			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Class List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                    
					<div class="table-responsive">
                    
                      <?php $__currentLoopData = $Classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <h3 class="mt-30"><?php echo e($Class->classname); ?></h3>
                      
                      <table class="table table-bordered">
                        
                            <tr>
                                <th>Records</th>
                            <?php $__currentLoopData = $Assessments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Ass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($Ass->class_id == $Class->id): ?>                            
								            <td><?php echo e($Ass->name); ?> (<?php echo e($Ass->percentage); ?>)</td>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td>Total (100)</td>
                            </tr>
                            <tr>
                                <th>Remove</th>
                                <?php $__currentLoopData = $Assessments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Ass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($Ass->class_id == $Class->id): ?>                            
                                    <td><a href="<?php echo e($Ass->id); ?>" >Delete</a></td>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <td>/</td>
                            </tr>
					  </table>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
                    
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->         
			</div>
			<!-- /.row -->

		</section>
		<!-- /.content -->
	  
	  </div>
  </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/backend/Examination/assessment.blade.php ENDPATH**/ ?>