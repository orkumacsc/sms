

<?php $__env->startSection('mainContent'); ?>

<div class="content-wrapper">
  <div class="container-full">
    <!-- Score Entry Request Form -->
    <section class="content">
      <div class="row">

        <div class="modal fade" id="ComputeResult" tabindex="-1" role="document" aria-labelledby="ComputeResultModal"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content box">
              <form method="post" action="<?php echo e(route('store_compute_result')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                  <h5 class="modal-title" id="ComputeResultModal"> <i
                      class="text-secondary mdi mdi-calculator-variant-outline"></i> Publish Students' Results</h5>
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
                          <select name="academic_session_id" id="academic_session_id" required
                            class="form-control p-10">
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
                <option value="<?php echo e($Term->id); ?>" <?php echo e($Term->id == Active_Term()->term_id ? 'selected' : ''); ?>>
                  <?php echo e($Term->name); ?>

                </option>
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
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                      class="ti-arrow-left"> Cancel</i></button>
                  <input type="submit" value="Publish Results" class="btn  btn-info">
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal fade" id="BroadsheetForm" tabindex="-1" role="document" aria-labelledby="BroadsheetFormModal"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content box">
              <form method="get" action="<?php echo e(route('broadsheet')); ?>" enctype="multipart/form-data">                
                <div class="modal-header">
                  <h5 class="modal-title" id="BroadsheetFormModal"> <i
                      class="text-secondary mdi mdi-microsoft-excel"></i> Broadsheet Report</h5>
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
                          <select name="academic_session_id" id="academic_session_id" required
                            class="form-control p-10">
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
                <option value="<?php echo e($Term->id); ?>" <?php echo e($Term->id == Active_Term()->term_id ? 'selected' : ''); ?>>
                  <?php echo e($Term->name); ?>

                </option>
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
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                      class="ti-arrow-left"> Cancel</i></button>
                  <input type="submit" value="Generate Broadsheet" class="btn  btn-info">
                </div>
              </form>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="AnnualBroadsheetForm" tabindex="-1" role="document" aria-labelledby="AnnualBroadsheetFormModal"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content box">
              <form method="get" action="<?php echo e(route('annual_broadsheet')); ?>" enctype="multipart/form-data">                
                <div class="modal-header">
                  <h5 class="modal-title" id="BroadsheetFormModal"> <i
                      class="text-secondary mdi mdi-microsoft-excel"></i> Annual Broadsheet Report</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body box-body my-10">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <h5>Session<span class="text-danger">*</span></h5>
                        <div class="controls">
                          <select name="academic_session_id" id="academic_session_id" required
                            class="form-control p-10">
                            <option value="">Select Session</option>
                              <?php $__currentLoopData = $SchoolSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($Session->id); ?>" <?php echo e($Session->id == Active_Session()->id ? 'selected' : ''); ?>><?php echo e($Session->name); ?></option>
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
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                      class="ti-arrow-left"> Cancel</i></button>
                  <input type="submit" value="Generate Broadsheet" class="btn  btn-info">
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal fade" id="ClassReportCards" tabindex="-1" role="document"
          aria-labelledby="ClassReportCardsModal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content box">
              <form method="get" action="<?php echo e(route('class_report_cards')); ?>" enctype="multipart/form-data">                
                <div class="modal-header">
                  <h5 class="modal-title" id="ClassReportCardsModal"> <i
                      class="text-secondary mdi mdi-microsoft-excel"></i> Class Report Cards</h5>
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
                          <select name="academic_session_id" id="academic_session_id" required
                            class="form-control p-10">
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
                <option value="<?php echo e($Term->id); ?>" <?php echo e($Term->id == Active_Term()->term_id ? 'selected' : ''); ?>>
                  <?php echo e($Term->name); ?>

                </option>
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
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                      class="ti-arrow-left"> Cancel</i></button>
                  <input type="submit" value="Generate Report Cards" class="btn  btn-info">
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal fade" id="StudentsReportCards" tabindex="-1" role="document"
          aria-labelledby="StudentsReportCardsModal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content box">
              <form method="get" action="<?php echo e(route('student_report_card')); ?>" enctype="multipart/form-data">                
                <div class="modal-header">
                  <h5 class="modal-title" id="StudentsReportCardsModal"> <i
                      class="text-secondary mdi mdi-microsoft-excel"></i> Students Report Card</h5>
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
                          <select name="academic_session_id" id="s_academic_session_id" required
                            class="form-control p-10">
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
                <option value="<?php echo e($Term->id); ?>" <?php echo e($Term->id == Active_Term()->term_id ? 'selected' : ''); ?>>
                  <?php echo e($Term->name); ?>

                </option>
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
                          <select name="class_id" id="s_class_id" required class="form-control p-10">
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
                          <select name="class_arm_id" id="s_class_arm_id" required class="form-control p-10">
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
                    <div class="col-md-12">
                      <div class="form-group">
                        <h5>Student's Name<span class="text-danger">*</span></h5>
                        <div class="controls">
                          <select name="student_id" id="s_student_id" required class="form-control p-10">


                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                      class="ti-arrow-left"> Cancel</i></button>
                  <input type="submit" value="Generate Report Card" class="btn  btn-info" id="disable">
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal fade" id="AnnualStudentsReportCards" tabindex="-1" role="document" aria-labelledby="AnnualStudentsReportCardsModal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content box">
              <form method="get" action="<?php echo e(route('annual_student_report')); ?>" enctype="multipart/form-data">                
                <div class="modal-header">
                  <h5 class="modal-title" id="StudentsReportCardsModal"> <i
                      class="text-secondary mdi mdi-microsoft-excel"></i>Annual Students Report Card</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body box-body my-10">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <h5>Session<span class="text-danger">*</span></h5>
                        <div class="controls">
                          <select name="academic_session_id" id="annual_academic_session_id" required
                            class="form-control p-10">
                            <option value="">Select Session</option>
                            <?php $__currentLoopData = $SchoolSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($Session->id); ?>" <?php echo e($Session->id == Active_Session()->id ? 'selected' : ''); ?>><?php echo e($Session->name); ?></option>
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
                          <select name="class_id" id="annual_class_id" required class="form-control p-10">
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
                          <select name="class_arm_id" id="annual_class_arm_id" required class="form-control p-10">
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
                    <div class="col-md-12">
                      <div class="form-group">
                        <h5>Student's Name<span class="text-danger">*</span></h5>
                        <div class="controls">
                          <select name="student_id" id="annual_student_id" required class="form-control p-10">


                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                      class="ti-arrow-left"> Cancel</i></button>
                  <input type="submit" value="Generate Report Card" class="btn  btn-info" id="disable">
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal fade" id="UpdateSubjectsInfo" tabindex="-1" role="document"
          aria-labelledby="UpdateSubjectsInfoModal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content box">
              <form method="get" action="<?php echo e(route('update_class_info')); ?>" enctype="multipart/form-data">                
                <div class="modal-header">
                  <h5 class="modal-title" id="UpdateSubjectsInfoModal"> <i
                      class="text-secondary mdi mdi-microsoft-excel"></i> Update Total Subjects Offered in Class</h5>
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
                          <select name="academic_session_id"  required
                            class="form-control p-10">
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
                        <h5>Class<span class="text-danger">*</span></h5>
                        <div class="controls">
                          <select name="class_id" required class="form-control p-10">
                            <option value="">Select Class</option>
                            <?php $__currentLoopData = $SchoolClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($Class->id); ?>"><?php echo e($Class->classname); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                      </div>
                    </div>                    
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <h5>Number of Subjects<span class="text-danger">*</span></h5>
                        <div class="controls">
                          <input type="number" name="total_subjects_offered" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                      class="ti-arrow-left"> Cancel</i></button>
                  <input type="submit" value="Save Subjects Offered" class="btn  btn-info" id="disable">
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6 col-xl-2">
          <a href="#" data-toggle="modal" data-target="#ComputeResult">
            <div class="box overflow-hidden pull-up">
              <div class="box-body">
                <div class="icon bg-info-light rounded w-60 h-60">
                  <i class="text-info mr-0 font-size-36 mdi mdi-calculator-variant-outline"></i>
                </div>
                <div>
                  <p class="text-mute mt-20 mb-0 font-size-16">Publish Results</p>
                  <h3 class="text-white mb-0 font-weight-500"></h3>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-12 col-md-6 col-xl-2">
          <a href="#" data-toggle="modal" data-target="#BroadsheetForm">
            <div class="box overflow-hidden pull-up">
              <div class="box-body">
                <div class="icon bg-info-light rounded w-60 h-60">
                  <i class="text-info mr-0 font-size-36 mdi mdi-microsoft-excel"></i>
                </div>
                <div>
                  <p class="text-mute mt-20 mb-0 font-size-16">Termly Broadsheet Report</p>
                  <h3 class="text-white mb-0 font-weight-500"></h3>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-12 col-md-6 col-xl-2">
          <a href="#" data-toggle="modal" data-target="#AnnualBroadsheetForm">
            <div class="box overflow-hidden pull-up">
              <div class="box-body">
                <div class="icon bg-info-light rounded w-60 h-60">
                  <i class="text-info mr-0 font-size-36 mdi mdi-microsoft-excel"></i>
                </div>
                <div>
                  <p class="text-mute mt-20 mb-0 font-size-16">Annual Broadsheet Report</p>
                  <h3 class="text-white mb-0 font-weight-500"></h3>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-12 col-md-6 col-xl-2">
          <a href="#" data-toggle="modal" data-target="#ClassReportCards">
            <div class="box overflow-hidden pull-up">
              <div class="box-body">
                <div class="icon bg-info-light rounded w-60 h-60">
                  <i class="text-info mr-0 font-size-36 mdi mdi-file-chart"></i>
                </div>
                <div>
                  <p class="text-mute mt-20 mb-0 font-size-16">Termly Class Report Cards</p>
                  <h3 class="text-white mb-0 font-weight-500"></h3>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-12 col-md-6 col-xl-2">
          <a href="#" data-toggle="modal" data-target="#StudentsReportCards">
            <div class="box overflow-hidden pull-up">
              <div class="box-body">
                <div class="icon bg-info-light rounded w-60 h-60">
                  <i class="text-info mr-0 font-size-36 mdi mdi-file-chart"></i>
                </div>
                <div>
                  <p class="text-mute mt-20 mb-0 font-size-16">Termly Students Report Card</p>
                  <h3 class="text-white mb-0 font-weight-500"></h3>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-12 col-md-6 col-xl-2">
          <a href="#" data-toggle="modal" data-target="#AnnualStudentsReportCards">
            <div class="box overflow-hidden pull-up">
              <div class="box-body">
                <div class="icon bg-info-light rounded w-60 h-60">
                  <i class="text-info mr-0 font-size-36 mdi mdi-file-chart"></i>
                </div>
                <div>
                  <p class="text-mute mt-20 mb-0 font-size-16">Annual Students Report Card</p>
                  <h3 class="text-white mb-0 font-weight-500"></h3>
                </div>
              </div>
            </div>
          </a>
        </div>

         <div class="col-12 col-md-6 col-xl-2">
          <a href="#" data-toggle="modal" data-target="#UpdateSubjectsInfo">
            <div class="box overflow-hidden pull-up">
              <div class="box-body">
                <div class="icon bg-info-light rounded w-60 h-60">
                  <i class="text-info mr-0 font-size-36 mdi mdi-file-chart"></i>
                </div>
                <div>
                  <p class="text-mute mt-20 mb-0 font-size-16">Update Subjects Offered</p>
                  <h3 class="text-white mb-0 font-weight-500"></h3>
                </div>
              </div>
            </div>
          </a>
        </div>

      </div>
    </section>
    <!-- /Score Entry Request Form -->
  </div>
</div>

<script>
  $(document).ready(() => {
    $('#s_class_arm_id').change(() => {
      let class_id = s_class_id.value;
      let class_arm_id = s_class_arm_id.value;
      let academic_session_id = s_academic_session_id.value
      let url = '/GetStudents/' + class_id + '_' + class_arm_id + '_' + academic_session_id;
      $.ajax({
        url: url,
        method: 'GET',
        data: {},
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
          $('#s_student_id').empty();

          if (response.length > 0) {

            response.forEach(Student => {
              $('#s_student_id').append('<option value="' + Student.id + '">' + Student.surname + ', ' + Student.firstname + ' ' + (Student.middlename ?? '') + '</option>');
            });

          } else {

            $('#$s_student_id').append('<option value="">There is not student in the selected class</option>');

          }
        },
        error: function (response) {
          // $('#s_student_id').append('<option>' + response + '</option>');
        }
      });
    });
  });

  $(document).ready(() => {
    $('#annual_class_arm_id').change(() => {
      let class_id = annual_class_id.value;
      let class_arm_id = annual_class_arm_id.value;
      let academic_session_id = annual_academic_session_id.value
      let url = '/GetStudents/' + class_id + '_' + class_arm_id + '_' + academic_session_id;
      $.ajax({
        url: url,
        method: 'GET',
        data: {},
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
          $('#annual_student_id').empty();

          if (response.length > 0) {

            response.forEach(Student => {
              $('#annual_student_id').append('<option value="' + Student.id + '">' + Student.surname + ', ' + Student.firstname + ' ' + (Student.middlename ?? '') + '</option>');
            });

          } else {

            $('#$annual_student_id').append('<option value="">There is not student in the selected class</option>');

          }
        },
        error: function (response) {
          // $('#s_student_id').append('<option>' + response + '</option>');
        }
      });
    });
  });
  

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/Examination_Officer/result_index.blade.php ENDPATH**/ ?>