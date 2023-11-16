<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('backend/images/favicon.ico') }}">

    <title>GOSPEL INTERNATIONAL COLLEGE, ZAKI-BIAM | Log in </title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">	

</head>
<body class="hold-transition dark-skin theme-primary">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-5 col-md-6 col-12">

						<div class="p-50 box-shadowed b-2">
							<div class="content-top-agile pb-30">							
								<img src="{{ asset('backend/images/logo-wide-footer.png')}}"	/>
							</div>
							<div class="content-top-agile p-10">							
								<h4 class="text-white">Login Details</h4>							
							</div>
                            <form method="POST" action="{{ route('login') }}">
                            @csrf
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
										</div>
										<input type="text" id="email" class="form-control pl-15 bg-transparent text-white plc-white" name="email" required autofocus placeholder="Admission No.">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text  bg-transparent text-white"><i class="ti-lock"></i></span>
										</div>
										<input type="password" id="password" class="form-control pl-15 bg-transparent text-white plc-white" name="password" required autocomplete placeholder="Password">
									</div>
								</div>
								  <div class="row">
									<div class="col-6">
									  <div class="checkbox text-white">
										<input type="checkbox" id="basic_checkbox_1" >
										<label for="basic_checkbox_1">Remember Me</label>
									  </div>
									</div>
									<!-- /.col -->
									<div class="col-6">
									 <div class="fog-pwd text-right">
										<a href="{{ route('password.request') }}" class="text-white hover-info"><i class="ion ion-locked"></i> Forgot Password?</a><br>
									  </div>
									</div>
									<!-- /.col -->
									<div class="col-12 text-center">
									  <button type="submit" class="btn btn-info btn-rounded mt-10 text-white">SIGN IN</button>
									</div>
									<!-- /.col -->
								  </div>
							</form>											

							<div class="text-center">
								<p class="mt-15 mb-0 text-white">Don't have an account? <a href="#" class="text-white ml-5">Sign Up</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Vendor JS -->
	<script src="{{ asset('backend/js/vendors.min.js') }}"></script>
    <script src="{{ asset('../assets/icons/feather-icons/feather.min.js')}}"></script>	

</body>
</html>
