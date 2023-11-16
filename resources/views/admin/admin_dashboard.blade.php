@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row"> 
				             
				<div class="col-xl-3 col-6 col-12">
                    <a href="{{ route('staff_view') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-primary-light rounded w-60 h-60">
								<i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Staff Members</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
                    </a>
				</div> 
				  
				<div class="col-xl-3 col-6 col-12">
					<a href="{{ route('student_view') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-account-multiple"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Students</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
					</a>
				</div>
				
				<div class="col-xl-3 col-6 col-12">
					<a href="{{ route('staff_view') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi-account-multiple"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Teachers</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
					</a>
				</div>
				
				<div class="col-xl-3 col-6 col-12">
					<a href="{{ route('payfees') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Classes</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
					</a>
				</div>			 
				              
				<div class="col-xl-3 col-6 col-12">
                    <a href="{{ route('payfees') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-primary-light rounded w-60 h-60">
								<i class="text-primary mr-0 font-size-24 mdi mdi-money"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Pay School Fees</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
                    </a>
				</div> 
				              
				<div class="col-xl-3 col-6 col-12">
					<a href="{{ route('reports') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-account-multiple"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Print Report</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
					</a>
				</div>
				
				<div class="col-xl-3 col-6 col-12">
					<a href="{{ route('input_cass_scores') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi-account-multiple"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Upload Result</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
					</a>
				</div>
				
				<div class="col-xl-3 col-6 col-12">
					<a href="{{ route('compute_result') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Compute Result</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
				</div>
				</a>
			</div>
		</section>
		<!-- /.content -->
	  </div>
  </div>

@endsection