

<?php $__env->startSection('mainContent'); ?>

<div class="content-wrapper">
	  <div class="container-full">
		
		<!-- Main content -->
		<section class="content">            
		  <div class="row">

          <div class="col-xl-8">                    
          <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">School Details</h4>		  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="<?php echo e(route('schoolsetup')); ?>">
                    <?php echo csrf_field(); ?>
					<div class="row">
						<div class="col-md-12">
                            <div class="form-group">
								<h5>SCHOOL LOGO <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="file" name="school_logo" class="form-control" required> </div>								
							</div>
                        </div>  
					</div>
                    <div class="row">                        					
                        <div class="col-md-12">
                            <div class="form-group">
								<h5>SCHOOL NAME <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="school_name" class="form-control" required> </div>								
							</div>
                        </div>                        
                    </div> 
                    <div class="row">
						<div class="col-md-4">
								<div class="form-group">
									<h5>SCHOOL CODE <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="school_code" class="form-control" required> </div>								
								</div>
							</div>	
							<div class="col-md-8">
								<div class="form-group">
									<h5>SCHOO MOTTO <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="school_motto" class="form-control" required> </div>								
								</div>
							</div>
                    </div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<h5>SCHOOL ADDRESS <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="school_address" class="form-control" required> 
								</div>								
							</div>
						</div> 
					</div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
								<h5>SCHOOL MOBILE NO <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="school_mobile_no" class="form-control" required> </div>								
							</div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
								<h5>SCHOOL eMAIL <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="email" name="school_email" class="form-control" required> </div>								
							</div>
                        </div>    
                    </div>

						<div class="text-xs-right pull-right">
							<input type="submit" value="Save School Details" class="btn  btn-info">
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

		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/backend/setup/schoolsetup.blade.php ENDPATH**/ ?>