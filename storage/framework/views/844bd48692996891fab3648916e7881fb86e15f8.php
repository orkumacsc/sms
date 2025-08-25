<form method="post" action="<?php echo e(route('staff.teaching.assign')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="modal-header">
        <h5 class="modal-title" id="StaffEnrolmentModal">Teacher-Class-Subject Allocation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body box-body m-10">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="staff_id">Staff <span class="text-danger">*</span></label>
                    <select name="teacher_id" id="_staff_id" class="form-control" data-validation-required-message="Please select a staff member">
                        <option value="">Select Staff</option>
                        <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($_staff->id); ?>">
                                <?php echo e($_staff->surname); ?>, <?php echo e($_staff->firstname); ?><?php echo e($_staff->middlename ? " {$_staff->middlename}" : ''); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="school_subjects_id">Subjects <span class="text-danger">*</span></label>
                    <select name="school_subjects_id" id="subjects_id" class="form-control" data-validation-required-message="Please select at least one subject.">
                        
                    </select>
                </div>
            </div>            
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="school_classes_id">Class <span class="text-danger">*</span></label>
                    <select name="school_classes_id" id="school_classes_id" class="form-control" data-validation-required-message="Please select a class">
                        <option value="">Select Class</option>
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($class->id); ?>"><?php echo e($class->classname); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>                    
                </div>
            </div>
        </div>

        <div class="row" hidden id="departments_row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="departments_id">Discipline <span class="text-danger">*</span></label>
                    <select name="departments_id" id="departments_id" class="form-control" data-validation-required-message="Please select a discipline">
                        
                    </select>                    
                </div>
            </div>
        </div>

        <div class="row" hidden id="arms_row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="school_arms_id">Arm <span class="text-danger"></span></label>
                    <select name="school_arms_id" id="school_arms_id" class="form-control">
                        
                    </select>                    
                </div>
            </div>
        </div> 

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="academic_sessions_id">Academic Session <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" value="<?php echo e(currentAcademicSession()->name); ?>" readonly>
                    <input type="hidden" name="academic_sessions_id" value="<?php echo e(currentAcademicSession()->id); ?>">                                                
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 d-flex align-items-end">
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-info">
                        <i class="fa fa-check"></i> Assign
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                class="ti-arrow-left"> Cancel</i></button>
    </div>
</form>


<script>   
    $school_classes_id = document.getElementById('school_classes_id');   
    $departments_id = document.getElementById('departments_id');    
    $staff_id = document.getElementById('_staff_id');
    $arms_row = document.getElementById('arms_row');
    $departments_row = document.getElementById('departments_row');

    $staff_id.addEventListener('change', function() {
       fetch(`/api/staff/${this.value}/subjects`)
            .then(response => response.json())
            .then(data => {
                const subjectSelect = document.getElementById('subjects_id');
                subjectSelect.innerHTML = '<option value="">Select Subjects</option>';
                data.forEach(subjectItem => {
                    const option = document.createElement('option');
                    option.value = subjectItem.id;
                    option.textContent = subjectItem.subject_name;
                    subjectSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching subjects:', error));
    });

    $school_classes_id.addEventListener('change', function() {
       fetch(`/api/classes/${this.value}/disciplines-arms`)
            .then(response => response.json())
            .then(data => {
                if (data.disciplines) {
                    $departments_row.hidden = false;
                    $arms_row.hidden = true;
                    const disciplineSelect = document.getElementById('departments_id');
                    disciplineSelect.innerHTML = '<option value="">Select Discipline</option>';
                    data.disciplines.forEach(discipline => {
                        const option = document.createElement('option');
                        option.value = discipline.id;
                        option.textContent = discipline.name;
                        disciplineSelect.appendChild(option);
                    });
                } else if (data.schoolArms) {
                    $arms_row.hidden = false;
                    $departments_row.hidden = true;
                    const armsSelect = document.getElementById('school_arms_id');
                    armsSelect.innerHTML = '<option value="">Select Arm</option>';
                    data.schoolArms.forEach(arm => {
                        const option = document.createElement('option');
                        option.value = arm.id;
                        option.textContent = arm.arm_name;
                        armsSelect.appendChild(option);
                    });
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    });

</script><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/forms/teaching_assignments.blade.php ENDPATH**/ ?>