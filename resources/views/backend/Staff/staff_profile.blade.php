@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
        		
		<!-- Main content -->
		<section class="content">

		  <div class="row">
			  <div class="col-12 col-lg-5 col-xl-4">


				  <!-- /.box -->
				 <div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-success" >
					  
					</div>
					<div class="widget-user-image">
					  <img class="circle" src="{{ (!empty($Profile->staff_passport))? url('storage/'.$Profile->staff_passport) : url('storage/profile-photos/default.png') }}" alt="User Avatar">
					</div>
	
					<div class="box-footer pt-80">
						<div class="description-header text-center">
							<h4 description-content>{{ $Profile->surname.', '.$Profile->firstname.' '.$Profile->middlename }}</h3>
						</div>
					  <div class="row">
						<div class="col-sm-12 text-left">
						<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">STAFF NO</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->staff_no }}</span>
								</div>							  
							</div>						
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">DESIGNATION</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->des_name }}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">DEPARTMENT</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->dep_name }}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">GENDER</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->gender }}</span>
								</div>							  
							</div>
						</div>
					  </div>
					  <!-- /.row -->
					</div>
				  </div>

			  </div>
			  <div class="col-12 col-lg-7 col-xl-8">
				
			  <div class="nav-tabs-custom box-profile">
				<ul class="nav nav-tabs">
				  <li><a class="active" href="#profile" data-toggle="tab">Profile</a></li>				  
				  <li><a href="#emergency" data-toggle="tab">Emergency Contact Info</a></li>				  
				</ul>

				<div class="tab-content">

					<!-- /.tab-pane -->
					<div class="active tab-pane bg-transparent" id="profile">
						<div class="box pt-30 pb-30 pl-50 pr-50 ">
							<div class="row">						  
						<div class="col-sm-12 text-left">
							<h4>PERSONAL INFORMATION</h4>
						<hr />
						<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Date Employed</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ \Carbon\Carbon::parse($Profile->date_of_employment)->format('d M., Y') }}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Date of Birth</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ \Carbon\Carbon::parse($Profile->date_of_birth)->format('d M., Y') }}</span>
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
									<h5 class="description-header">Marital Status</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->marital_status }}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Qualification</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->qualification }}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Specialization</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->specialization }}</span>
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
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">eMail</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->email}}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Mobile No</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ '0'.$Profile->mobile_no}}</span>
								</div>							  
							</div>
							<div class="row">
								<div class="col-sm-6">									
									<h5 class="description-header">Contact Address</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->current_address}}</span>
								</div>							  
							</div>

							<div class="row mb-30">
								<div class="col-sm-6">									
									<h5 class="description-header">Permanent Home Address</h5>				
								</div>
								<div class="col-sm-6">
									<span class="description-text">{{ $Profile->permanent_address}}</span>
								</div>							  
							</div>
						</div>
					</div>
					<!-- /.row -->
					</div>
								
				  </div>
				  <!-- /.tab-pane -->

				  <div class="tab-pane" id="emergency">				  		
					<div class="box pt-30 pb-30 pl-50 pr-50 ">
						<div class="row">						  
							<div class="col-sm-12 text-left">
								<h4>EMERGENCY CONTACT INFORMATION</h4>
								<hr />
								<div class="row mb-5">
									<div class="col-sm-6">									
										<h5 class="description-header">Surname</h5>				
									</div>
									<div class="col-sm-6">
										<span class="description-text">{{ $Profile->em_surname}}</span>
									</div>							  
								</div>
								<div class="row mb-5">
									<div class="col-sm-6">									
										<h5 class="description-header">First Name</h5>				
									</div>
									<div class="col-sm-6">
										<span class="description-text">{{ $Profile->em_firstname}}</span>
									</div>							  
								</div>
								<div class="row mb-5">
									<div class="col-sm-6">									
										<h5 class="description-header">Middle Name</h5>				
									</div>
									<div class="col-sm-6">
										<span class="description-text">{{ $Profile->em_middlename}}</span>
									</div>							  
								</div>
								<div class="row mb-5">
									<div class="col-sm-6">									
										<h5 class="description-header">Occupation</h5>				
									</div>
									<div class="col-sm-6">
										<span class="description-text">{{ $Profile->em_occupation}}</span>
									</div>							  
								</div>
								<div class="row mb-5">
									<div class="col-sm-6">									
										<h5 class="description-header">Mobile No</h5>				
									</div>
									<div class="col-sm-6">
										<span class="description-text">{{ '0'.$Profile->em_mobile }}</span>
									</div>							  
								</div>
								<div class="row mb-5">
									<div class="col-sm-6">									
										<h5 class="description-header">eMail</h5>				
									</div>
									<div class="col-sm-6">
										<span class="description-text">{{ $Profile->em_email}}</span>
									</div>							  
								</div>
								<div class="row mb-5">
									<div class="col-sm-6">									
										<h5 class="description-header">Address</h5>				
									</div>
									<div class="col-sm-6">
										<span class="description-text">{{ $Profile->em_address}}</span>
									</div>							  
								</div>
							</div>
						</div>
						<!-- /.row -->
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