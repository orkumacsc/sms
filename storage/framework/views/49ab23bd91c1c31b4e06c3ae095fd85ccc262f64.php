<form method="post" action="<?php echo e(route($routeName)); ?>">
    <?php echo csrf_field(); ?>
    <div class="modal-header">
        <h5 class="modal-title" id="AssignSubjectModal">
            <i class="text-secondary mdi mdi-calculator-variant-outline"></i>
            <?php echo e($title); ?>

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body box-body my-10">
        <div class="row">
            <div class="table-responsive col-sm-12">
                <table id="" class="table table-bordered nowrap">
                    <caption class="text-left font-weight-bold mb-2 text-muted" style="caption-side: top;">
                        <p>
                            All cross-curricular subjects are selected automatically.
                        </p>
                        <p>Tick appropriate subjects and categories to be added.</p>
                    </caption>
                    <thead>
                        <tr>
                            <th>S/No</th>
                            <th colspan="2">Subject Name</th>

                            <th>
                                Compulsory
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $SchoolSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $SchoolSubject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key + 1); ?></td>
                                <td><?php echo e($SchoolSubject->subject_name); ?>

                                </td>
                                <td>
                                    <input type="checkbox" id="_<?php echo e($SchoolSubject->id); ?>" name="subjects_id[<?php echo e($SchoolSubject->id); ?>][subject_id]"
                                        value="1" class="_checkboxes"
                                        <?php echo e(old("subjects_id.$SchoolSubject->id.subject_id") ? 'checked' : ''); ?>>
                                    <label for="_<?php echo e($SchoolSubject->id); ?>"></label>
                                </td>
                                <td>
                                    <input type="checkbox" id="_<?php echo e($SchoolSubject->id); ?>_compulsory" name="subjects_id[<?php echo e($SchoolSubject->id); ?>][is_compulsory]"
                                        value="1" class="_checkboxes"
                                        <?php echo e(old("subjects_id.$SchoolSubject->id.is_compulsory") ? 'checked' : ''); ?>>
                                    <label for="_<?php echo e($SchoolSubject->id); ?>_compulsory"></label>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <h5>Class Name<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="class_discipline_id" id="class_discipline_id" class="form-control p-10">
                            <option value="">Select Class</option>
                            <?php $__currentLoopData = $classDisciplines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classDiscipline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($classDiscipline['id']); ?>">
                                    <?php echo e($classDiscipline['name']); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <h5>Academic Session<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="academic_session_id" id="academic_session_id" class="form-control p-10">
                            <option value="">Select Academic Session</option>
                            <?php $__currentLoopData = $academicSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $academicSession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($academicSession->id); ?>">
                                    <?php echo e($academicSession->name); ?>

                                </option>
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
        <input type="submit" value="Add" class="btn  btn-info">
    </div>
</form><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/forms/add_discipline_subjects.blade.php ENDPATH**/ ?>