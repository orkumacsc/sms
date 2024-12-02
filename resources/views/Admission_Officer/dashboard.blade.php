@extends('Admission_Officer.master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row"> 
				
				<div class="col-xl-4 col-6 col-12">
					<a href="{{ route('admissions') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-account-multiple"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Enrol Students</p>
								<h3 class="text-white mb-0 font-weight-500"></h3>
							</div>
						</div>
					</div>
					</a>
				</div>	
				
				<div class="col-xl-4 col-6 col-12">
					<a href="{{ route('admissions') }}">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-account-multiple"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Enroled Students</p>
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