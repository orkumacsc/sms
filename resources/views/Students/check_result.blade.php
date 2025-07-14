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

<body class="hold-transition dark-skin theme-primary" oncontextmenu="return false">

	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">

			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-md-6">
						<div class="content-top-agile pb-30">
							<img src="{{ asset('backend/images/logo-wide-footer.png')}}" />
						</div>
						<div class="p-50 box-shadowed b-2">
							<form method="get" action="{{ route('check_result') }}">
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<h5>Admission Number<span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="text" name="admission_number" id="admission_number"
													class="form-control" placeholder="Enter Your Admission Number Here"
													required>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<h5>Result Type<span class="text-danger">*</span></h5>
											<div class="controls">
												<select name="result_type" id="result_type" required
													class="form-control p-10">
													<option value="">Select Result Type</option>
													<option value="1">Termly</option>
													<option value="2">Annual</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row" id="termly">
									<div class="col-md-6">
										<div class="form-group">
											<h5>Academic Session<span class="text-danger">*</span></h5>
											<div class="controls">
												<select name="academic_session_id" id="academic_session_id" required
													class="form-control p-10">
													<option value="">Select Academic Session</option>
													@foreach($school_academic_sessions as $key => $academic_session)
														<option value="{{ $academic_session->id }}"
															{{$academic_session->id == Active_Session()->id ? 'selected' : ''}}>{{ $academic_session->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<h5>Term<span class="text-danger">*</span></h5>
											<div class="controls">
												<select name="term_id" id="term_id" required class="form-control p-10">
													<option value="">Select Term</option>
													@foreach($school_terms as $key => $terms)
														<option value="{{ $terms->id }}"
															{{$terms->id == Active_Term()->term_id ? 'selected' : ''}}>
															{{ $terms->name }}
														</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row" id="annual">
									<div class="col-md-12">
										<div class="form-group">
											<h5>Academic Session<span class="text-danger">*</span></h5>
											<div class="controls">
												<select name="academic_session_id" id="academic_session_id" required
													class="form-control p-10">
													<option value="">Select Academic Session</option>
													@foreach($school_academic_sessions as $key => $academic_session)
														<option value="{{ $academic_session->id }}"
															{{$academic_session->id == Active_Session()->id ? 'selected' : ''}}>{{ $academic_session->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<div class="text-xs-right pt-25">
												<input type="submit" value="Check Result"
													class="form-control btn  btn-info">
											</div>
										</div>
									</div>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		const $resultType = document.getElementById('result_type');
		const $termly = document.getElementById('termly');
		const $annual = document.getElementById('annual');

		$termly.style.display = 'none';
		$annual.style.display = 'none';

		$resultType.addEventListener('change', (e) => {
			let $result_type = $resultType.value;
			
			if ($result_type != 1) {
				$termly.style.display = 'none';
				$annual.style.display = '';
			} else {
				$annual.style.display = 'none';
				$termly.style.display = '';
			}
		})		
	</script>

	<!-- Vendor JS -->
	<script src="{{ asset('backend/js/vendors.min.js') }}"></script>
	<script src="{{ asset('../assets/icons/feather-icons/feather.min.js')}}"></script>

</body>

</html>