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
					</div>
				  </div>

			  </div>
			  <div class="col-12 col-lg-7 col-xl-8">
				
			  <div class="nav-tabs-custom box-profile">
				<ul class="nav nav-tabs">
				  <li><a class="active" href="#profile" data-toggle="tab">Profile</a></li>
				  <li><a href="#activity" data-toggle="tab">Activity</a></li>
				  <li><a href="#settings" data-toggle="tab">Settings</a></li>
				</ul>

				<div class="tab-content">

				  <!-- /.tab-pane -->

				  <div class="tab-pane" id="settings">				  		

					<div class="box p-15">		
						<form class="form-horizontal form-element col-12">
						  <div class="form-group row">
							<label for="inputName" class="col-sm-2 control-label">Name</label>

							<div class="col-sm-10">
							  <input type="email" class="form-control" id="inputName" placeholder="">
							</div>
						  </div>
						  <div class="form-group row">
							<label for="inputEmail" class="col-sm-2 control-label">Email</label>

							<div class="col-sm-10">
							  <input type="email" class="form-control" id="inputEmail" placeholder="">
							</div>
						  </div>
						  <div class="form-group row">
							<label for="inputPhone" class="col-sm-2 control-label">Phone</label>

							<div class="col-sm-10">
							  <input type="tel" class="form-control" id="inputPhone" placeholder="">
							</div>
						  </div>
						  <div class="form-group row">
							<label for="inputExperience" class="col-sm-2 control-label">Experience</label>

							<div class="col-sm-10">
							  <textarea class="form-control" id="inputExperience" placeholder=""></textarea>
							</div>
						  </div>
						  <div class="form-group row">
							<label for="inputSkills" class="col-sm-2 control-label">Skills</label>

							<div class="col-sm-10">
							  <input type="text" class="form-control" id="inputSkills" placeholder="">
							</div>
						  </div>
						  <div class="form-group row">
							<div class="ml-auto col-sm-10">
							  <div class="checkbox">
								<input type="checkbox" id="basic_checkbox_1" checked="">
								<label for="basic_checkbox_1"> I agree to the</label>
								  &nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Terms and Conditions</a>
							  </div>
							</div>
						  </div>
						  <div class="form-group row">
							<div class="ml-auto col-sm-10">
							  <button type="submit" class="btn btn-rounded btn-success">Submit</button>
							</div>
						  </div>
						</form>
					</div>			  
				  </div>
				  <!-- /.tab-pane -->
				  <div class="active tab-pane bg-transparent" id="profile">
					<div class="box pt-30 pb-30 pl-50 pr-50 ">
					  <div class="row">						  
						<div class="col-sm-12 text-left">
							<h4>PERSONAL INFORMATION</h4>
						  <hr />
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
					  <!-- /.row -->
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