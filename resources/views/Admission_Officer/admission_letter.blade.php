@extends('Admission_Officer.master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
        		
		<!-- Main content -->
		<section class="content">

			<div class="box">

				<div class="box-body">
					
					<div class="row">

						<div class="col-12">

							<div class="row">

								<div class="col-sm-2">
									<img src="{{ url('backend/images/school_logo.png') }}" >
								</div>
								<div class="col-sm-8 text-center">
									<h3>GOSPEL INTERNATIONAL COLLEGE, ZAKI-BIAM</h3>
									<h4>ZAKI-BIAM, UKUM LGA, BENUE STATE, NIGERIA</h4>
									<h5>Tel: 08030661324, 08140326189, 07030271476</h5>
									<h5>Email: gospelcollege2019@gmail.com;  website: gospelschools.sch.ng</h5>
								</div>
								<div class="col-sm-2">
									<img src="{{ url('backend/images/Coat_of_arms_of_Nigeria.png') }}" >
								</div>

							</div>

							<div class="row mt-30">

								<div class="col-sm-4">
									<table class="table table-bordered">
										<thead class="text-center">
											<tr>
												<th colspan="2"><h4>{{ $student_info->surname.', '.$student_info->firstname.' '.$student_info->middlename }}</h4></th>															
											</tr>
											<tr>
												<th colspan="2">PERSONAL DATA</th>															
											</tr>										
										</thead>
										<tbody class="text-left">
											<tr>
												<th>GENDER</th>
												<td>{{ $student_info->gendername }}</td>
											</tr>
											<tr>
												<th>ADMISSION NO</th>
												<td>{{ $student_info->admission_no }}</td>
											</tr>
											<tr>
												<th>DATE OF BIRTH</th>
												<td>{{ \Carbon\Carbon::parse($student_info->date_of_birth)->format('d M., Y') }}</td>
											</tr>
											<tr>
												<th>HOUSE</th>
												<td>{{ $student_info->name }}</td>
											</tr>
											
										</tbody>
									</table>
								</div>								
								<div class="col-sm-8">
								<table class="table table-bordered">										
										<tbody>
											<tr class="text-center" style="padding:2%">
												<th colspan="2">CLASS DATA</th>
												<td rowspan="6" style="width:30%">
												<img src="{{ url('storage/'.$student_info->passport) }}" >
												</td>												
											</tr>
											<tr>
												<th>CLASS ADMITTED INTO</th>
												<td>{{ $student_info->classname }}</td>
																								
											</tr>
											<tr>
												<th>SESSION ADMITTED</th>
												<td>2024/2025 ACADEMIC SESSION</td>
											</tr>
											<tr class="text-center">
												<th colspan="2">PARENT INFORMATION</th>												
											</tr>
											<tr>
												<th>FULL NAME</th>
												<td><h4>{{ $student_info->surname }}</h4></td>
											</tr>											
											<tr>
												<th>CONTACT</th>
												<td></td>
											</tr>
											
										</tbody>
									</table>
								</div>

							</div>

							
							<div class="row text-justify p-50 pl-2-60">

								<div>
									<h3 class="col text-center mb-30"><b>OFFER OF PROVISIONAL ADMISSION INTO 2024/2025 ACADEMIC SESSION</b></h4>
									<h3>I am pleased to inform you that you have been offered provisional admission into <b>GOSPEL INTERNATIONAL COLLEGE, ZAKI-BIAM</b> in order to further and subsequently complete your post primary education.</h3>
									<h3>The confirmation of this offer is subject to your sitting for the entrance examination and obtaining the minimum entry qualifications or agreeing to go through the specialised class and
										fulfilling the conditions for your admission. All students are to present evidence of the qualifications on which this offer of admission has been granted.
										However, if it is discovered at any time that you do not possess the qualifications which you claimed, you will be withdrawn from the school.
									</h3>
									<h2>
										<b>RESUMPTION DATE : 9<sup>TH</sup> SEPTEMBER, 2024</b>
									</h2>
									<h3>You are expected to resume on the above date. Failure to resume as stated, another student will take your place.</h3>
									<h3>Find below your login details on the school portal</h3>

									<h3><b>SCHOOL PORTAL:</b> www.portal.gospelschools.sch.ng</h2>
									<h3><b>USERNAME:</b> {{ $student_info->admission_no }}</h2>
									<h3><b>PASSWORD:</b> your surname</h2>

									<h3>You can login and check your termly, annual results and promotion analysis</h3>
								</div>
								
							</div>

						</div>

					</div>
		<!-- Row End -->
				</div>

			</div>

		</section>
		<!-- /.content -->
	  </div>
  </div>

@endsection