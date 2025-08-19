<?php

$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

?>
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
          <div class="ulogo">
            <a href="<?php echo e(route('staff.dashboard')); ?>">
              <!-- logo for regular state and mobile devices -->
              <div class="d-flex align-items-center justify-content-center">					 	
                  <img src="<?php echo e(asset('backend/images/logo-dark.png')); ?>" alt="School Logo">                  
              </div>
            </a>
          </div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree"> 
		    <li class=" <?php echo e(($route == 'staff.dashboard')? 'active' : ''); ?> ">
          <a href="<?php echo e(route('staff.dashboard')); ?>">
            <i data-feather="pie-chart"></i>
			      <span>Dashboard</span>
          </a>
        </li> 
        
        <li class="treeview <?php echo e(($prefix == '/students')? 'active' : ''); ?>">
          <a href="javascript:void(0)">
            <i data-feather="users"></i>
            <span>Students</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(route('teachers.students.view')); ?>"><i class="ti-more"></i>View Students</a></li>           
          </ul>
        </li>       
        
        <li class="treeview <?php echo e(($prefix == '/attendance')? 'active' : ''); ?>">
          <a href="javascript:void(0)">
            <i data-feather="book"></i>
            <span>Class Attendance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(route('attendance.mark')); ?>"><i class="ti-more"></i>Mark Attendance</a></li>            
            <li><a href="<?php echo e(route('attendance.update')); ?>"><i class="ti-more"></i>Update Attendance</a></li>            
          </ul>
        </li>       

        <li class="treeview <?php echo e(($prefix == '/upload')? 'active' : ''); ?>">
          <a href="javascript:void(0)">
            <i data-feather="upload"></i>
            <span>Upload Assessments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
            <ul class="treeview-menu">
              <li><a href="<?php echo e(route('upload.assessment')); ?>"><i class="ti-more"></i>Upload Assessments</a></li>
              <li><a href="<?php echo e(route('update.assessment')); ?>"><i class="ti-more"></i>Update Uploaded Assessments</a></li>
            </ul>
        </li>

        <li class="treeview <?php echo e(($prefix == '/reports')? 'active' : ''); ?>">
          <a href="javascript:void(0)">
            <i data-feather="book-open"></i>
            <span>Reports Generation</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
            <ul class="treeview-menu">
              <li><a href="<?php echo e(route('reports.academic')); ?>"><i class="ti-more"></i>Academic Reports</a></li>
              <li><a href="<?php echo e(route('reports.attendance')); ?>"><i class="ti-more"></i>Attendance Reports</a></li>
              <li><a href="<?php echo e(route('reports.behavioural')); ?>"><i class="ti-more"></i>Behavioural Reports</a></li>
            </ul>
        </li>

        <li class="treeview <?php echo e(($prefix == '/announcements')? 'active' : ''); ?>">
          <a href="javascript:void(0)">
            <i data-feather="mail"></i>
            <span>Announcements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(route('announcements.compose',1)); ?>"><i class="ti-more"></i>Send Announcements</a></li>
            <li><a href="<?php echo e(route('announcements.sent',1)); ?>"><i class="ti-more"></i>Sent Announcements</a></li>
          </ul>
        </li>      

      </ul>
    </section>
  </aside>
<?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/Teachers/body/sidebar.blade.php ENDPATH**/ ?>