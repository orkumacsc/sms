<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description"
		content="Login to Gospel International College, Zaki-Biam Portal. Access your account to manage your profile, view results, and more.">
	<meta name="author" content="Micomm Edusoft Solutions | Educational Software Company">
	<meta name="robots" content="noindex, nofollow">
	<link rel="icon" href="<?php echo e(asset('backend/images/favicon.ico')); ?>">

	<title>Login | Gospel International College, Zaki-Biam Portal</title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/vendors_css.css')); ?>">

	<!-- Style-->
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/style.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/skin_color.css')); ?>">

</head>

<body class="hold-transition dark-skin theme-primary">
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-5 col-md-6 col-12">
						<div class="p-50 box-shadowed b-2">
							<div class="content-top-agile pb-30">
								<img src="<?php echo e(asset('backend/images/logo-wide-footer.png')); ?>"
									alt="Gospel International College Zaki-Biam logo featuring the school name in bold modern lettering, set against a clean background, conveying a welcoming and professional atmosphere" />
							</div>
							<div class="content-top-agile p-10">
								<h4 class="text-white">Login Details</h4>
							</div>
							<?php if(session('status')): ?>
								<div class="alert alert-success">
									<?php echo e(session('status')); ?>

								</div>
							<?php endif; ?>

							<?php if($errors->any()): ?>
								<div class="alert alert-danger">
									<ul class="mb-0">
										<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<li><?php echo e($error); ?></li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>
								</div>
							<?php endif; ?>

							<form method="POST" action="<?php echo e(route('login')); ?>">
								<?php echo csrf_field(); ?>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-white"><i
													class="ti-user"></i></span>
										</div>
										<input type="text" id="email"
											class="form-control pl-15 bg-transparent text-white plc-white" name="email"
											value="<?php echo e(old('email')); ?>" required autofocus placeholder="eMail">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text  bg-transparent text-white"><i
													class="ti-lock"></i></span>
										</div>
										<input type="password" id="password"
											class="form-control pl-15 bg-transparent text-white plc-white"
											name="password" required autocomplete="current-password"
											placeholder="Password">
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<div class="checkbox text-white">
											<input type="checkbox" id="basic_checkbox_1" name="remember_me">
											<label for="basic_checkbox_1">Remember Me</label>
										</div>
									</div>
									<!-- /.col -->
									<div class="col-6">
										<div class="fog-pwd text-right">
											<a href="javascript:void(0);" class="text-white hover-info"
												id="forgotPasswordLink" data-toggle="tooltip" data-placement="left"
												title="Please contact the school administrator to reset your password.">
												<i class="ion ion-locked"></i> Forgot Password?
											</a><br>
										</div>
									</div>

									<!-- /.col -->
									<div class="col-12 text-center">
										<button type="submit" class="btn btn-info btn-rounded mt-10 text-white">
											SIGNIN
										</button>
									</div>
									<!-- /.col -->
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Vendor JS -->
	<script src="<?php echo e(asset('backend/js/vendors.min.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/icons/feather-icons/feather.min.js')); ?>"></script>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			var link = document.getElementById('forgotPasswordLink');
			link.addEventListener('click', function (e) {
				e.preventDefault();
				link.setAttribute('data-original-title', link.getAttribute('title'));
				$(link).tooltip('show');
				setTimeout(function () {
					$(link).tooltip('hide');
				}, 6000);
			});
		});
	</script>

</body>

</html><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/auth/login.blade.php ENDPATH**/ ?>