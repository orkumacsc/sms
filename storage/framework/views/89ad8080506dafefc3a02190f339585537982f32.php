

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

                <div class="col-sm-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">List of Staff and Subjects</h3>
                            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#StaffSubjectAssignmentModal">
                                Assign Subjects
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
                                                            <p class="badge badge-success"><?php echo e($subject->subject_name); ?></p>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <span>Not yet assigned Subject</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <form action="<?php echo e(route('staff.subjects.update', [$StaffSubject->id])); ?>" method="POST" class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <button type="submit" class="btn btn-info btn-md" onclick="return confirm('Are you sure you want to update this subject?')">Update</button>
                                                    </form>
                                                </td>                                            
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No staff subjects assigned yet.</td>
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