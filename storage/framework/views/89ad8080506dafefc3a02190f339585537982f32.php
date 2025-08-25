

<?php $__env->startSection('mainContent'); ?>
<?php $__env->startSection('title', 'Staff Subject Assignment'); ?>

<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- Staff Subject Assignment Modal -->
                <div class="modal fade" id="StaffSubjectAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="StaffSubjectAssignmentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content box">
                            <?php echo $__env->make('forms.staff_subject_assignment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="StaffClassAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="StaffClassAssignmentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content box">
                            <?php echo $__env->make('forms.teaching_assignments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Staff Subject Allocation</h4>
                            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#StaffSubjectAssignmentModal">
                                <i class="fa fa-plus"></i> New Assignment
                            </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/NO</th>
                                            <th>Staff ID</th>
                                            <th>Staff Name</th>
                                            <th>Subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $staffSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $StaffSubject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($key + 1); ?></td>
                                                <td><?php echo e($StaffSubject->staff_no); ?></td>
                                                <td>
                                                    <?php echo e($StaffSubject->surname); ?>, <?php echo e($StaffSubject->firstname); ?><?php echo e($StaffSubject->middlename ? ' ' . $StaffSubject->middlename : ''); ?>

                                                </td>
                                                <td>
                                                    <?php if($StaffSubject->subjects()->count()): ?>
                                                        <?php $__currentLoopData = $StaffSubject->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <p> <i class="fa fa-book"></i> <?php echo e($subject->subject_name); ?></p>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <span>Not yet assigned Subject</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <form action="javascript:void(0)" method="POST" class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <button type="submit" class="btn btn-info btn-md" onclick="return confirm('Are you sure you want to update this subject?')">Update</button>
                                                    </form>
                                                </td>                                            
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No staff subjects assigned yet.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- /.box-body -->
                    </div>
                </div>
                
                <div class="col-sm-12 col-lg-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Teacher-Class-Subject Allocation</h4>
                            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#StaffClassAssignmentModal">
                                <i class="fa fa-plus"></i> New Assignment
                            </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/NO</th>
                                            <th>Staff ID</th>
                                            <th>Staff Name</th>
                                            <th>Subject</th>
                                            <th>Class</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $teachingAssignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $teachingAssignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($key + 1); ?></td>
                                                <td><?php echo e($teachingAssignment->teacher->staff_no); ?></td>
                                                <td>
                                                    <?php echo e($teachingAssignment->teacher->surname); ?>, <?php echo e($teachingAssignment->teacher->firstname); ?><?php echo e($teachingAssignment->teacher->middlename ? ' ' . $teachingAssignment->teacher->middlename : ''); ?>

                                                </td>
                                                <td>
                                                    <?php if($teachingAssignment->subject): ?>
                                                        <p><i class="fa fa-book"></i> <?php echo e($teachingAssignment->subject->subject_name); ?></p>
                                                    <?php else: ?>
                                                        <span>Not yet assigned Subject</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($teachingAssignment->schoolClass && $teachingAssignment->arm || $teachingAssignment->department): ?>
                                                        <p><i class="fa fa-building"></i> <?php echo e($teachingAssignment->schoolClass->classname); ?> <?php echo e($teachingAssignment->arm?->arm_name); ?> <?php echo e($teachingAssignment->department?->name); ?></p>
                                                    <?php else: ?>
                                                        <span>Not yet assigned Class</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <form action="<?php echo e(route('teaching.assignments.update', [$teachingAssignment->id])); ?>" method="POST" class="d-inline">
                                                        <?php echo csrf_field(); ?>                                                        
                                                        <?php echo method_field('PUT'); ?>
                                                        <button type="submit" class="btn btn-info btn-md" onclick="return confirm('Are you sure you want to update this assignment?')">Update</button>
                                                    </form>
                                                </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No staff subjects assigned yet.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- /.box-body -->
                    </div>
                </div>    
            </div>
            <!-- /.row -->
        </section>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/backend/Staff/staff_subjects.blade.php ENDPATH**/ ?>