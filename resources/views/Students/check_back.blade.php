<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="{{ asset('backend/images/favicon.ico') }}">

	<title>GOSPEL INTERNATIONAL COLLEGE, ZAKI-BIAM | Check Result </title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">

	<!-- Style-->
	<link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">
</head>

<body class="hold-transition dark-skin theme-primary" oncontextmenu="return false" onkeydown="return false">

	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">

			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-md-12">
						<div class="content-top-agile pb-30">							
							<img src="{{ asset('backend/images/logo-wide-footer.png')}}"	/>
						</div>
						<div class="box-shadowed p-50 b-2 text-center">
							<p>
							{{$term}} | {{$academic_session}} ACADEMIC SESSION 
								<br /> Result not yet available for
								<h4>{{$students->surname}} {{$students->firstname}} {{$students->middlename}}</h4>
								Check back later!
							</p>
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