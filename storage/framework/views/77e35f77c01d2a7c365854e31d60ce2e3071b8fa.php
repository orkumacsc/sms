<?php

$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

?>

<aside class="main-sidebar">

    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
          <div class="ulogo">
            <a href="<?php echo e(route('admin_dashboard')); ?>">
              <!-- logo for regular state and mobile devices -->
              <div class="d-flex align-items-center justify-content-center">					 	
                  <img src="<?php echo e(asset('backend/images/logo-dark.png')); ?>" alt="">
                  <h3><?php echo e(@Auth::user()->name); ?></h3>
              </div>
            </a>
          </div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree"> 
		    <li class=" <?php echo e(($route == 'admin_dashboard') ? 'active' : ''); ?> ">
          <a href="<?php echo e(route('admin_dashboard')); ?>">
            <i data-feather="pie-chart"></i>
			      <span>Dashboard</span>
          </a>
        </li>
        
        <li class="treeview <?php echo e(($prefix == '/users')? 'active' : ''); ?>">
          <a href="javascript:void(0)">
            <i data-feather="users"></i>
            <span>Roles & Permission</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">            
            <li><a href="<?php echo e(route('user.view')); ?>"><i class="ti-more"></i>View User Roles</a></li>
          </ul>
        </li>  
        
        
        
        <li class="treeview <?php echo e(($prefix == '/students')? 'active' : ''); ?>">
          <a href="javascript:void(0)">
            <i data-feather="users"></i>
            <span>Student Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">  
            <li><a href="<?php echo e(route('student_view')); ?>"><i class="ti-more"></i>List of Student</a></li>           
            <li><a href="<?php echo e(route('generate_reg_no')); ?>"><i class="ti-more"></i>Generate Roll No</a></li>                       
            <li><a href="<?php echo e(route('student_houses')); ?>"><i class="ti-more"></i>Students Houses</a></li>
            <li><a href="<?php echo e(route('student_promotion_index')); ?>"><i class="ti-more"></i>Promote Students</a></li>
          </ul>
        </li> 

        
        <li class="<?php echo e(($prefix == '/staff')? 'active' : ''); ?>">
          <a href="<?php echo e(route('staff')); ?>">
            <i data-feather="users"></i>
            <span>Staff</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>          
        </li> 
        

        
        <li class="treeview <?php echo e(($prefix == '/academics')? 'active' : ''); ?>">
          <a href="javascript:void(0)">
            <i data-feather="book-open"></i>
            <span>Academics</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(route('school_subjects')); ?>"><i class="ti-more"></i>Subjects Management</a></li> 
            <li><a href="<?php echo e(route('marks_grades')); ?>"><i class="ti-more"></i>Marks Grade</a></li>
          </ul>
        </li>
        
        <li class="treeview <?php echo e(($prefix == '/Assessment')? 'active' : ''); ?>">
          <a href="javascript:void(0)">
            <i data-feather="edit"></i>
            <span>Assessment</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(route('ass_registration')); ?>"><i class="ti-more"></i>Add Ass Type</a></li>
            <li><a href="<?php echo e(route('asign_assessment')); ?>"><i class="ti-more"></i>Assign Assessment</a></li>
            <li><a href="<?php echo e(route('score_sheet_form')); ?>"><i class="ti-more"></i>Score Sheets</a></li>          
            <li><a href="<?php echo e(route('input_cass_scores')); ?>"><i class="ti-more"></i>Upload CASS Scores</a></li>
          </ul>
        </li>
        

        
        <li class="treeview <?php echo e(($prefix == '/Examination')? 'active' : ''); ?>">
          <a href="javascript:void(0)">
            <i data-feather="edit"></i>
            <span>Examination</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(route('ExamCard')); ?>"><i class="ti-more"></i>Exam Cards</a></li>            
            <li><a href="<?php echo e(route('exam_attendance')); ?>"><i class="ti-more"></i>Attendance Sheets</a></li>            
          </ul>
        </li>       
        
        
        <li class="<?php echo e(($prefix == '/ResultManagement')? 'active' : ''); ?>">
          <a href="<?php echo e(route('compute_result')); ?>">
            <i data-feather="edit"></i>
            <span>Result Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>         
        </li>       
        
        
        <li class="treeview <?php echo e(($prefix == '/setup')? 'active' : ''); ?>">
          <a href="javascript:void(0)">
            <i data-feather="settings"></i>
            <span>School Configurations</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(route('schoolsetup.index')); ?>"><i class="ti-more"></i>School Information</a></li>
            <li><a href="<?php echo e(route('school_class')); ?>"><i class="ti-more"></i>Class</a></li>
            <li><a href="<?php echo e(route('school_arm')); ?>"><i class="ti-more"></i>Arm</a></li>
            <li><a href="<?php echo e(route('academic_session')); ?>"><i class="ti-more"></i>Sessions & Terms</a></li>            
          </ul>
        </li>
        

        
        <li class="treeview <?php echo e(($prefix == '/setup')? 'active' : ''); ?>">
          <a href="javascript:void(0)">
            <i data-feather="settings"></i>
            <span>School Fees Setup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(route('feesgroup')); ?>"><i class="ti-more"></i>School Fees Group</a></li>            
            <li><a href="<?php echo e(route('fees_type')); ?>"><i class="ti-more"></i>School Fees Type</a></li>
            <li><a href="<?php echo e(route('assign_class_fees')); ?>"><i class="ti-more"></i>Assign School Fees</a></li>            
            <li><a href="<?php echo e(route('feesdiscount')); ?>"><i class="ti-more"></i>Fees Discount</a></li>
            <li><a href="<?php echo e(route('payfees')); ?>"><i class="ti-more"></i>Pay School Fees</a></li>
          </ul>
        </li>
        
      </ul>
    </section>

  </aside>
<?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/admin/body/sidebar.blade.php ENDPATH**/ ?>