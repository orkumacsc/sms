

<?php $__env->startSection('mainContent'); ?>

<div class="content-wrapper">
	  <div class="container-full">
        
	  <section class="content">
        <div class="row">
          <!-- Forms -->
          <div class="modal fade" id="OnlineUpload" tabindex="-1" role="document" aria-labelledby="OnlineUploadModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content box">
                <form method="get" action="<?php echo e(route('cass_scores_form')); ?>" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
                  <div class="modal-header">
                    <h5 class="modal-title" id="StaffEnrolmentModal">Select Result Upload Criteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body box-body my-10">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                          <div class="form-group">
                              <h5>Class<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="class_id" id="class_id" required class="form-control p-10">
                                  <option value="">Select Class</option>
                                  <?php $__currentLoopData = $SchoolClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($Class->id); ?>"><?php echo e($Class->classname); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                              </select>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                          <div class="form-group">
                              <h5>Arm<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="arm_id" id="arm_id" required class="form-control p-10">
                                  <option value="">Select Arm</option>
                                  <?php $__currentLoopData = $ClassArms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Arm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($Arm->id); ?>"><?php echo e($Arm->arm_name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                              </select>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                          <div class="form-group">
                              <h5>Subjects<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="subject_id" id="subject_id" required class="form-control p-10">
                                  <option value="">Select Subject</option>
                                  <?php $__currentLoopData = $SchoolSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subjects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($subjects->id); ?>"><?php echo e($subjects->subject_name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                              </div>
                          </div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
                    <input type="submit" value="Enter Class" class="btn  btn-info">
                  </div>
                </form>							
              </div>
            </div>
          </div>
          
          <div class="modal fade" id="OfflineUpload" tabindex="-1" role="document" aria-labelledby="OfflineUploadModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content box">
                <form method="post" action="<?php echo e(route('upload_offline')); ?>" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
                  <div class="modal-header">
                    <h5 class="modal-title" id="OfflineUploadModal">Upload Offline Prefilled Scoresheet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body box-body my-10">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                          <div class="form-group">
                              <h5>Class<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="class_id" id="offline_class_id" required class="form-control p-10">
                                  <option value="">Select Class</option>
                                  <?php $__currentLoopData = $SchoolClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($Class->id); ?>"><?php echo e($Class->classname); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                              </select>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                          <div class="form-group">
                              <h5>Arm<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="class_arm_id" id="arm_id" required class="form-control p-10">
                                  <option value="">Select Arm</option>
                                  <?php $__currentLoopData = $ClassArms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Arm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($Arm->id); ?>"><?php echo e($Arm->arm_name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                              </select>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                          <div class="form-group">                            
                              <h5>Subjects<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="subject_id" id="offline_subject_id" required class="form-control p-10">
                                  <option value="">Select Subject</option>
                                  <?php $__currentLoopData = $SchoolSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subjects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($subjects->id); ?>"><?php echo e($subjects->subject_name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                              </div>
                          </div>
                      </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group"> 
                            <h5>Offline Scoresheet<span class="text-danger">*</span></h5>                                                   
                                <div class="controls">
                                    <input type="file" name="scoresheet" id="scoresheet" class="form-control" data-validation-required-message="Scoresheet File is required"> 
                                </div>
                            </div>
                        </div>  
                    </div>                                        
                                                        
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
                    <input type="submit" value="Upload" class="btn  btn-info">
                  </div>
                </form>							
              </div>
            </div>
          </div>

          <div class="modal fade" id="DownloadOffline" tabindex="-1" role="document" aria-labelledby="DownloadOfflineModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content box">
                <form method="get" action="<?php echo e(route('download_offline')); ?>" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
                  <div class="modal-header">
                    <h5 class="modal-title" id="StaffEnrolmentModal">Download Offline Scoresheet Upload File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body box-body my-10">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                          <div class="form-group">
                              <h5>Class<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="class_id" id="download_class_id" required class="form-control p-10">
                                  <option value="">Select Class</option>
                                  <?php $__currentLoopData = $SchoolClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($Class->id); ?>"><?php echo e($Class->classname); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                              </select>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                          <div class="form-group">
                              <h5>Arm<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="arm_id" id="arm_id" required class="form-control p-10">
                                  <option value="">Select Arm</option>
                                  <?php $__currentLoopData = $ClassArms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Arm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($Arm->id); ?>"><?php echo e($Arm->arm_name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                              </select>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                          <div class="form-group">                            
                              <h5>Subjects<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="subject_id" id="download_subject_id" required class="form-control p-10">
                                  <option value="">Select Subject</option>
                                  <?php $__currentLoopData = $SchoolSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subjects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($subjects->id); ?>"><?php echo e($subjects->subject_name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                              </div>
                          </div>
                      </div>
                    </div>                             
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
                    <input type="submit" value="Download Offline Scoresheet" class="btn  btn-info">
                  </div>
                </form>							
              </div>
            </div>
          </div>

          <div class="modal fade" id="UpdateUploadedCass" tabindex="-1" role="document" aria-labelledby="UpdateUploadedCassModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content box">
                <form method="get" action="<?php echo e(route('update_uploaded_cass')); ?>" enctype="multipart/form-data">                  
                  <div class="modal-header">
                  <h5 class="modal-title" id="StaffEnrolmentModal">Update Uploaded Result</h5>                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body box-body my-10">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                          <div class="form-group">
                              <h5>Class<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="class_id" id="class_id" required class="form-control p-10">
                                  <option value="">Select Class</option>
                                  <?php $__currentLoopData = $SchoolClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($Class->id); ?>"><?php echo e($Class->classname); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                              </select>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                          <div class="form-group">
                              <h5>Arm<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="class_arm_id" id="class_arm_id" required class="form-control p-10">
                                  <option value="">Select Arm</option>
                                  <?php $__currentLoopData = $ClassArms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Arm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($Arm->id); ?>"><?php echo e($Arm->arm_name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                              </select>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                          <div class="form-group">
                              <h5>Subjects<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="subject_id" id="subject_id" required class="form-control p-10">
                                  <option value="">Select Subject</option>
                                  <?php $__currentLoopData = $SchoolSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subjects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($subjects->id); ?>"><?php echo e($subjects->subject_name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                              </div>
                          </div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
                    <input type="submit" value="Enter Class" class="btn  btn-info">
                  </div>
                </form>							
              </div>
            </div>
          </div>

          <div class="modal fade" id="ViewUploadedCass" tabindex="-1" role="document" aria-labelledby="ViewUploadedCassModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content box">
                <form method="get" action="<?php echo e(route('view_cass_scores')); ?>" enctype="multipart/form-data"> 
                  <div class="modal-header">                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body box-body my-10">
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <h5>Session<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="academic_session_id" id="academic_session_id" required class="form-control p-10">
                              <option value="">Select Session</option>                                        
                                  <?php $__currentLoopData = $SchoolSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($Session->id); ?>" <?php echo e($Session->id == Active_Session()->id ? 'selected' : ''); ?>><?php echo e($Session->name); ?></option> 
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                       
                              </select>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <h5>Term<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="term_id" id="term" required class="form-control p-10">
                                  <option value="">Select Term</option>
                                  <?php $__currentLoopData = $SchoolTerm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($Term->id); ?>" <?php echo e($Term->id == Active_Term()->term_id ? 'selected' : ''); ?>><?php echo e($Term->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                              </select>
                              </div>
                          </div>
                      </div>                           
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <h5>Class<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="class_id" id="class_id" required class="form-control p-10">
                                  <option value="">Select Class</option>
                                  <?php $__currentLoopData = $SchoolClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($Class->id); ?>"><?php echo e($Class->classname); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                              </select>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                              <h5>Arm<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="class_arm_id" id="class_arm_id" required class="form-control p-10">
                                  <option value="">Select Arm</option>
                                  <?php $__currentLoopData = $ClassArms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Arm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($Arm->id); ?>"><?php echo e($Arm->arm_name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                              </select>
                              </div>
                          </div>
                      </div>                      
                    </div> 
                    <div class="row">
                      <div class="col-12">
                          <div class="form-group">
                              <h5>Subjects<span class="text-danger">*</span></h5>
                              <div class="controls">
                              <select name="subject_id" id="subject_id" required class="form-control p-10">
                                  <option value="">Select Subject</option>
                                  <?php $__currentLoopData = $SchoolSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subjects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($subjects->id); ?>"><?php echo e($subjects->subject_name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                              </div>
                          </div>
                      </div>
                    </div>                   
                  </div>                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
                    <input type="submit" value="View Uploaded Result" class="btn  btn-info">
                  </div>
                </form>							
              </div>
            </div>
          </div>
          <!-- /Forms -->

          <!-- Navigations -->
            <div class="col-12 col-md-6 col-xl-2">
              <a href="#" data-toggle="modal" data-target="#OnlineUpload">                
                <div class="box overflow-hidden pull-up">
                  <div class="box-body">							
                    <div class="icon bg-info-light rounded w-60 h-60">
                      <i class="text-info mr-0 font-size-24 mdi mdi-cloud-upload"></i>
                    </div>
                    <div>
                      <p class="text-mute mt-20 mb-0 font-size-16">Online Upload</p>
                      <h3 class="text-white mb-0 font-weight-500"></h3>
                    </div>
                  </div>
                </div>                
              </a>
            </div>	
            <div class="col-12 col-md-6 col-xl-2">
              <a href="#" data-toggle="modal" data-target="#OfflineUpload">                
                <div class="box overflow-hidden pull-up">
                  <div class="box-body">							
                    <div class="icon bg-info-light rounded w-60 h-60">
                      <i class="text-info mr-0 font-size-24 mdi mdi-cloud-upload"></i>
                    </div>
                    <div>
                      <p class="text-mute mt-20 mb-0 font-size-16">Offline Upload</p>
                      <h3 class="text-white mb-0 font-weight-500"></h3>
                    </div>
                  </div>
                </div>                
              </a>
            </div>
            <div class="col-12 col-md-6 col-xl-2">
              <a href="#" data-toggle="modal" data-target="#DownloadOffline">                
                <div class="box overflow-hidden pull-up">
                  <div class="box-body">							
                    <div class="icon bg-info-light rounded w-60 h-60">
                      <i class="text-info mr-0 font-size-24 mdi mdi-cloud-download"></i>
                    </div>
                    <div>
                      <p class="text-mute mt-20 mb-0 font-size-16">Download Offline Scoresheet</p>
                      <h3 class="text-white mb-0 font-weight-500"></h3>
                    </div>
                  </div>
                </div>                
              </a>
            </div>
            <div class="col-12 col-md-6 col-xl-2">
              <a href="#" data-toggle="modal" data-target="#UpdateUploadedCass">                
                <div class="box overflow-hidden pull-up">
                  <div class="box-body">							
                    <div class="icon bg-info-light rounded w-60 h-60">
                      <i class="text-info mr-0 font-size-24 mdi mdi-update"></i>
                    </div>
                    <div>
                      <p class="text-mute mt-20 mb-0 font-size-16">Update Uploaded CASS</p>
                      <h3 class="text-white mb-0 font-weight-500"></h3>
                    </div>
                  </div>
                </div>                
              </a>
            </div>
            <div class="col-12 col-md-6 col-xl-2">
              <a href="#" data-toggle="modal" data-target="#ViewUploadedCass">                
                <div class="box overflow-hidden pull-up">
                  <div class="box-body">							
                    <div class="icon bg-info-light rounded w-60 h-60">
                      <i class="text-info mr-0 font-size-24 mdi mdi-card-search"></i>
                    </div>
                    <div>
                      <p class="text-mute mt-20 mb-0 font-size-16">View Uploaded CASS</p>
                      <h3 class="text-white mb-0 font-weight-500"></h3>
                    </div>
                  </div>
                </div>                
              </a>
            </div>
            <!-- /Navigations -->

        </div>		  
		</section>
        
	  </div>
</div>

  <!-- <script src="<?php echo e(asset('backend/js/forms/CASS_entry.js')); ?>"></script>   -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/backend/Examination/request_form.blade.php ENDPATH**/ ?>