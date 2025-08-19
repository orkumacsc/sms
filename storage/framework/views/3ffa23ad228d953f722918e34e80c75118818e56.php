<form method="post" action="<?php echo e(route($routeName)); ?>">
    <?php echo csrf_field(); ?>
    <div class="modal-header">
        <h5 class="modal-title" id="createClassArmModal"><?php echo e($title); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body box-body my-10">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h5>School Arm <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="arm_name" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                class="ti-arrow-left"> Cancel</i></button>
        <input type="submit" value="Add Arm" class="btn  btn-info">
    </div>
</form><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/forms/add_arm.blade.php ENDPATH**/ ?>