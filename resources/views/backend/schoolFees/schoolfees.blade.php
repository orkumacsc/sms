@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row"> 
				@if(Auth::user()->usertype == 'Super Admin')               
				<div class="col-xl-3 col-6 col-12">
                    <a href="{{ route('payfees') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-primary-light rounded w-60 h-60">
								<i class="text-primary mr-0 font-size-24 mdi mdi-building"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Pay School Fees</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
                    </a>
				</div> 
				@endif               
				<div class="col-xl-3 col-6 col-12">
					<a href="{{ route('student_view') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-account-multiple"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Pay Exam Fee</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
					</a>
				</div>
				@if(Auth::user()->usertype == 'Super Admin')
				<div class="col-xl-3 col-6 col-12">
					<a href="{{ route('staff_view') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi-account-multiple"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Pay Science Fee</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
					</a>
				</div>
				@endif

				<div class="col-xl-3 col-6 col-12">
                    <a href="">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Pay Mock SSCE Fee</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
                    </a>
				</div>

				@if(Auth::user()->usertype == 'Super Admin')               
				<div class="col-xl-3 col-6 col-12">
                    <a href="{{ route('staff_view') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-primary-light rounded w-60 h-60">
								<i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Pay NECO Fee</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
                    </a>
				</div> 
				@endif               
				<div class="col-xl-3 col-6 col-12">
					<a href="{{ route('student_view') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-account-multiple"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Pay BECE Fee</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
					</a>
				</div>
				@if(Auth::user()->usertype == 'Super Admin')
				<div class="col-xl-3 col-6 col-12">
					<a href="{{ route('staff_view') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi-account-multiple"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Pay Admission Charges</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
					</a>
				</div>
				@endif
				<div class="col-xl-3 col-6 col-12">
                    <a href="">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Pay WAEC Fee</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
                    </a>
				</div>
			
			</div>
		</section>
		<!-- /.content -->
	  </div>
  </div>

@endsection