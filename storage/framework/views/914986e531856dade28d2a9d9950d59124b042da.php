<form method="post" action="<?php echo e(route('store_student_enrolment')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="modal-header">
        <h5 class="modal-title" id="StaffEnrolmentModal">NEW STUDENT ENROLMENT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>                    
    </div>
    <div class="modal-body box-body m-10">
        <div class="col-sm-12 col-xl-4">
            <h5 class="text-success">STUDENTS IN CLASS SELECTED: <i id="admitted_students" class="text-white"></i></h5>	
        </div>	  
        <fieldset class="border p-10 p-lg-30 mb-30">
            <legend class="w-auto"> STUDENT PASSPORT</legend>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">                                                    
                        <div class="controls text-center">
                            <label for="file">
                                <img src="<?php echo e(asset('backend/images/passport.png')); ?>" alt="Student Passport" id="OuputStudentPassport" class="pb-20">
                                <input type="file" name="StudentPassport" id="StudentPassport" class="form-control"> 
                            </label>                                        
                        </div>
                    </div>
                </div>  
            </div>                                          
        </fieldset>

        <div class="row">                                                
            <div class="col-sm-6">
                <div class="form-group">
                    <h5>Class<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="class_admitted" id="class_admitted" data-validation-required-message="Please Select Student Class" class="form-control">
                            <option value="">Select Class</option>
                            <?php $__currentLoopData = $SchoolClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $school_classes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($school_classes->id); ?>"><?php echo e($school_classes->classname); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h5>Class Arm<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="class_arm" id="class_arm" data-validation-required-message="Please Select Student Class Arm" class="form-control">
                            <option value="">Select Class Arm</option>
                            <?php $__currentLoopData = $ClassArms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $class_arm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($class_arm->id); ?>"><?php echo e($class_arm->arm_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>    

        <div class="row">
            <div class="col-sm-4">
                    <div class="form-group">
                        <h5>Surname<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="surname" class="form-control" data-validation-required-message="Pleas Enter Student Surname"> </div>
                            <div class="form-control-feedback"><small></small></div>
                    </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Firstname<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="firstname" class="form-control" data-validation-required-message="Pleas Enter Student First Name"> </div>
                        <div class="form-control-feedback"><small></small></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Middlename</h5>
                    <div class="controls">
                        <input type="text" name="middlename" class="form-control"> </div>
                        <div class="form-control-feedback"><small></small></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                <h5>Gender<span class="text-danger">*</span></h5>
                <div class="controls">
                    <select name="gender" id="gender" required class="form-control">                                        
                        <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($gender->id); ?>"><?php echo e($gender->gendername); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                     
                    </select>
                </div>
            </div>
            </div>                            
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Date of Birth</h5>
                    <div class="controls">
                    <input type="date" name="dob" class="form-control" > </div>
                    <div class="form-control-feedback"><small></small></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Complexion<span class="text-danger"></span></h5>
                    <div class="controls">
                    <select name="complexion" id="complexion" class="form-control">
                        <option value="">Select Complexion</option>
                        <?php $__currentLoopData = $Complexions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $complexion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($complexion->id); ?>"><?php echo e($complexion->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                           
                    </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Nationality<span class="text-danger"></span></h5>
                    <div class="controls">
                    <select name="country" id="country" class="form-control">                                        
                        <?php $__currentLoopData = $Countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Country->id); ?>"><?php echo e($Country->name); ?></option> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                       
                    </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>State Of Origin<span class="text-danger"></span></h5>
                    <div class="controls">
                    <select name="state_id" id="state_id" class="form-control">
                        <option value="">Select State</option>
                        <?php $__currentLoopData = $States; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $State): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($State->id); ?>" <?php echo e(($State->name == 'Benue')? 'selected' : ''); ?>><?php echo e($State->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                    </select>
                    </div>
                </div>
            </div>

        
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Local Govt of Origin<span class="text-danger"></span></h5>
                    <div class="controls">
                    <select name="lga" id="lga" class="form-control">
                        <option value="">Select LGA</option>
                        <?php $__currentLoopData = $LGAs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $local): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($local->id); ?>" <?php echo e(($local->name == 'Ukum')? 'selected' : ''); ?>><?php echo e($local->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                          
                    </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Home Town</h5>
                    <div class="controls">
                    <input type="text" name="home_town" class="form-control"> </div>
                    <div class="form-control-feedback"><small></small></div>
                </div>
            </div>

            <div class="col-sm-4">
                    <div class="form-group">
                        <h5>Tribe<span class="text-danger"></span></h5>
                        <div class="controls">
                        <select name="tribe" id="tribe" class="form-control">                                            
                            <?php $__currentLoopData = $Tribes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Tribe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($Tribe->id); ?>"><?php echo e($Tribe->name); ?></option> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>
                    </div>
            </div>

            <div class="col-sm-4">
                    <div class="form-group">
                        <h5>Religion<span class="text-danger"></span></h5>
                        <div class="controls">
                            <select name="religion" id="religion" class="form-control">                                                
                                <?php $__currentLoopData = $Religions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Religion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($Religion->id); ?>"><?php echo e($Religion->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                
                            </select>
                        </div>
                    </div>
            </div>

        </div>
        
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Height<span class="text-danger"></span></h5>
                    <div class="controls">
                    <select name="height" id="height" class="form-control">
                        <option value="">Select Height (ft)</option>
                        <option value="1.5">1.5</option>                                                            
                    </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Weight<span class="text-danger"></span></h5>
                    <div class="controls">
                    <select name="weight" id="weight" class="form-control">
                        <option value="">Select Weight (kg)</option>
                        <option value="76">76</option>                                                            
                    </select>
                    </div>
                </div>
            </div>                            
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>House<span class="text-danger">*</span></h5>
                    <div class="controls">
                    <select name="house" id="house" required class="form-control">                                         
                        <?php $__currentLoopData = $Houses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $House): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                       
                        <option value="<?php echo e($House->id); ?>"><?php echo e($House->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            
                    </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-12">
                <div class="form-group">
                    <h5>Address</h5>
                    <div class="controls">
                    <input type="text" name="address" class="form-control" > </div>
                    <div class="form-control-feedback"><small></small></div>
                </div>
            </div>
        </div>

        <h5 class="mt-20 mb-10">PREVIOUS SCHOOL INFORMATION</h5><hr />
        
        <div class="row">
            <div class="col-sm-8">
                    <div class="form-group">
                        <h5>School Name<span class="text-danger"></span></h5>
                        <div class="controls">
                            <input type="text" name="school_name" class="form-control" > </div>
                            <div class="form-control-feedback"><small></small></div>
                    </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Class<span class="text-danger"></span></h5>
                    <div class="controls">
                        <input type="text" name="last_class" class="form-control"> </div>
                        <div class="form-control-feedback"><small></small></div>
                </div>
            </div>
        </div>


        <h5 class="mt-20 mb-10">PARENT/GUARDIAN INFORMATION</h5>
        <hr />
        
        <div class="row">
            <div class="col-sm-4">
                    <div class="form-group">
                        <h5>Surname<span class="text-danger"></span></h5>
                        <div class="controls">
                            <input type="text" name="pg_surname" class="form-control" > </div>
                            <div class="form-control-feedback"><small></small></div>
                    </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Firstname<span class="text-danger"></span></h5>
                    <div class="controls">
                        <input type="text" name="pg_firstname" class="form-control" > </div>
                        <div class="form-control-feedback"><small></small></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Middlename</h5>
                    <div class="controls">
                        <input type="text" name="pg_middlename" class="form-control"> </div>
                        <div class="form-control-feedback"><small></small></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                    <div class="form-group">
                        <h5>Occupation<span class="text-danger"></span></h5>
                        <div class="controls">
                            <input type="text" name="pg_occupation" class="form-control" > </div>
                            <div class="form-control-feedback"><small></small></div>
                    </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Mobile No.<span class="text-danger"></span></h5>
                    <div class="controls">
                        <input type="number" name="pg_mobile_no" class="form-control" > </div>
                        <div class="form-control-feedback"><small></small></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>eMail Address</h5>
                    <div class="controls">
                        <input type="email" name="pg_email" class="form-control" > </div>
                        <div class="form-control-feedback"><small></small></div>
                </div>
            </div>
        </div>
        
        <div class="row">

            <div class="col-sm-12">
                <div class="form-group">
                    <h5>Address</h5>
                    <div class="controls">
                    <input type="text" name="pg_address" class="form-control" > </div>
                    <div class="form-control-feedback"><small></small></div>
                </div>
            </div>
        </div>             
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
        <input type="submit" value="Save Student" class="btn  btn-info" >
    </div>
</form>				<?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/forms/admission_form.blade.php ENDPATH**/ ?>