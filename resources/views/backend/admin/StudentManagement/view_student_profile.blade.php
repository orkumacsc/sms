@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
        		
		<!-- Main content -->
		<section class="content">

		  <div class="row">			  
			  <div class="col-sm-12 col-lg-7 col-xl-5">				
			  <div class="nav-tabs-custom box-profile">
				<ul class="nav nav-tabs">
				  <li><a class="active" href="#profile" data-toggle="tab">Student Profile</a></li>				  
				  <li><a href="#settings" data-toggle="tab">Academic Records</a></li>
				</ul>

				<div class="tab-content">

				  <!-- /.tab-pane -->

				  <div class="tab-pane" id="settings">				  		

					<div class="box p-15">		
					<div class="row">
						<div class="col-sm-12 text-left">
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Current Class</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->classname }}</span>
								</div>							  
							</div>						
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Form Master</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->surname }}</span>
								</div>							  
							</div>
							
						</div>
					  </div>
					</div>			  
				  </div>
				  <!-- /.tab-pane -->
				  <div class="active tab-pane bg-transparent" id="profile">

				  <div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-success" >
					  
					</div>
					<div class="widget-user-image">
					  <img class="circle" src="{{ (!empty($Profile->passport))? url('storage/'.$Profile->passport) : url('storage/profile-photos/default.png') }}" alt="User Avatar">
					</div>
	
					<div class="box-footer pt-80">
						<div class="description-header text-center">
							<h4 description-content>{{ $Profile->surname.', '.$Profile->firstname.' '.$Profile->middlename }}</h3>
						</div>
					  <div class="row">
						<div class="col-sm-12 text-left">
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Status</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text text-warning">TRANSFERED</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">ADMISSION NO</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->admission_no }}</span>
								</div>							  
							</div>						
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">CLASS</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->classname }}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">HOUSE</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->name }}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">DATE OF BIRTH</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">
										
										{{ \Carbon\Carbon::parse($Profile->date_of_birth)->format('d M., Y') }}</span>
										
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">GENDER</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->gendername }}</span>
								</div>							  
							</div>
						</div>
					  </div>
					  <!-- /.row -->

					  <div class="row">						  
						<div class="col-sm-12 text-left">							
                          <div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Session Admitted</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->session_admitted }}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Date of Birth</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->date_of_birth }}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Religion</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->religion }}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Tribe</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->tribe }}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Height (m)</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->height }}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Weight (kg)</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->weight }}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Nationality</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->nationality }}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">State of Origin</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->state}}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">LGA of Origin</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->lga }}</span>
								</div>							  
							</div>
							<div class="row mb-30">
								<div class="col-sm-6">									
									<h5 class="description-header">Home Town/Village</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->home_town}}</span>
								</div>							  
							</div>

							<h4>PREVIOUS SCHOOL INFORMATION</h4>
							<hr />
							<div class="row mb-5">
								<div class="col-sm-6">									
									<h5 class="description-header">Name of School</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->last_school}}</span>
								</div>							  
							</div>
							<div class="row mb-5">
								<div class="col-sm-6">									
									<h5 class="description-header">Class</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->last_class}}</span>
								</div>							  
							</div>
						</div>
					  </div>
					</div>
				  </div>
	  
				  </div>
				</div>
				<!-- /.tab-content -->
			  </div>
			  <!-- /.nav-tabs-custom -->
			</div>			  
		  </div>
		  <!-- /.row -->

		</section>
		<!-- /.content -->
	  </div>
  </div>

@endsection