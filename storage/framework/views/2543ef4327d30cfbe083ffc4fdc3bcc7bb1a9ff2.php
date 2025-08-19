<!DOCTYPE html>
<html lang="en-UK">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="MiEduSoft Solutions | Educational Software Company in Benue State, Nigeria">
    <link rel="icon" href="<?php echo e(asset('backend/images/favicon.ico')); ?>">
    

    <title>GOSPEL INTERNATIONAL COLLEGE, ZAKIBIAM</title>
    
	<!-- Vendors Style--> 
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/vendors_css.css')); ?>">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/style.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/skin_color.css')); ?>">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     
  </head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed" oncontextmenu="return false">
	
<div class="wrapper">

  <?php echo $__env->make('Admission_Officer.body.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  
  <!-- Left side column. contains the logo and sidebar -->
  <?php echo $__env->make('Admission_Officer.body.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- Content Wrapper. Contains page content -->
  <?php echo $__env->yieldContent('mainContent'); ?>
  <!-- /.content-wrapper -->

  <?php echo $__env->make('Admission_Officer.body.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
  
</div>
<!-- ./wrapper -->
  	
	 
	<!-- Vendor JS -->
	<script src="<?php echo e(asset('backend/js/vendors.min.js')); ?>"></script>
  <script src="<?php echo e(asset('../assets/icons/feather-icons/feather.min.js')); ?>"></script>    
  <script src="<?php echo e(asset('backend/js/pages/validation.js')); ?>"></script>
  <script src="<?php echo e(asset('backend/js/pages/form-validation.js')); ?>"></script>	
	<script src="<?php echo e(asset('../assets/vendor_components/apexcharts-bundle/irregular-data-series.js')); ?>"></script>
  <script src="<?php echo e(asset('../assets/vendor_components/datatable/datatables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('backend/js/pages/data-table.js')); ?>"></script>

	<!-- MiEduSoft SMS -->
	<script src="<?php echo e(asset('backend/js/template.js')); ?>"></script>
	<script src="<?php echo e(asset('backend/js/pages/dashboard.js')); ?>"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


  <script>
  <?php if(Session::has('message')): ?>
    var type = "<?php echo e(Session::get('alert-type','info')); ?>"

    switch(type){
      case 'info':
      toastr.info(" <?php echo e(Session::get('message')); ?> ");
      break;

      case 'success':
      toastr.success(" <?php echo e(Session::get('message')); ?> ");
      break;

      case 'warning':
      toastr.warning(" <?php echo e(Session::get('message')); ?> ");
      break;

      case 'error':
      toastr.error(" <?php echo e(Session::get('message')); ?> ");
      break;
    
  }

  <?php endif; ?>

  </script>

  <script type="text/javascript">
    $(function(){
      $(document).on('click', '#delete', function(e){
        e.preventDefault();
        var link = $(this).attr("href");

                  Swal.fire({
          title: 'Are you sure?',
          text: "You want to delete this User?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete the user!'
          }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
            }
})

      })
    })
  </script>
	
	
</body>
</html>
<?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/Admission_Officer/master.blade.php ENDPATH**/ ?>