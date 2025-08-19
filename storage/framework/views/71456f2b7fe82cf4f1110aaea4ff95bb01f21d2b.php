<form method="post" action="<?php echo e(route('staff.classes.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="modal-header">
        <h5 class="modal-title" id="StaffEnrolmentModal">Form Master Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body box-body m-10">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="staff_id">Staff <span class="text-danger">*</span></label>
                    <select name="staff_id" id="staff_id" class="form-control" data-validation-required-message="Please select a staff member">
                        <option value="">Select Staff</option>
                        <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($_staff->id); ?>">
                                <?php echo e($_staff->surname); ?>,
                                <?php echo e($_staff->firstname); ?><?php echo e($_staff->middlename ? ' ' . $_staff->middlename : ''); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>                    
                </div>
            </div>                     
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="class_id">Class <span class="text-danger">*</span></label>
                    <select name="class_id" id="class_id" class="form-control" data-validation-required-message="Please select a class">
                        <option value="">Select Class</option>
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($class->id); ?>"><?php echo e($class->classname); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="class_id">Discipline <span class="text-danger">*</span></label>
                    <select name="class_id" id="class_id" class="form-control" data-validation-required-message="Please select a discipline">
                        <option value="">Select Discipline</option>
                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="class_id">Arm <span class="text-danger">*</span></label>
                    <select name="class_id" id="class_id" class="form-control" data-validation-required-message="Please select an arm">
                        <option value="">Select Arm</option>
                        <?php $__currentLoopData = $arms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($arm->id); ?>"><?php echo e($arm->arm_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="academic_session">Academic Session <span class="text-danger">*</span></label>
                    <select name="academic_session" id="academic_session" class="form-control" data-validation-required-message="Please select an academic session">
                        <option value="">Select Academic Session</option>
                        <?php $__currentLoopData = $schoolSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($session->id); ?>"><?php echo e($session->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>                    
                </div>
            </div>
        </div>

        <div class="row">
             <div class="col-sm-12">
                <div class="form-group">
                    <input type="submit" value="Appoint" class="btn btn-info">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                class="ti-arrow-left"> Cancel</i></button>        
    </div>
</form><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/forms/staff_class_assignment.blade.php ENDPATH**/ ?>