@extends('admin.admin_master')

@section('mainContent')
<div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">            
            <!-- row -->			
			<div class="row">
				<!-- Academic Session Modal -->
				<div class="modal fade" id="StaffEnrolment" tabindex="-1" role="document" aria-labelledby="StaffEnrolmentModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
						<div class="modal-content box">
							<form method="post" action="{{ route('store_staff_enrollment') }}" enctype="multipart/form-data">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title" id="StaffEnrolmentModal">Enrol a new staff</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body box-body my-10">
                                    <fieldset class="border p-10 p-lg-30 mb-30">
                                        <legend class="w-auto"> STAFF PASSPORT </legend>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">                                                    
                                                    <div class="controls">
                                                        <input type="file" name="staff_passport" id="Passport" class="form-control" data-validation-required-message="Staff Passport is required"> 
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>                                          
                                    </fieldset>
                                    
                                    <fieldset class="border p-10 p-lg-30 mb-30">
                                        <legend class="w-auto">PERSONAL INFO</legend>
                                        <div class="row">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>Department<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                <select name="department_id" id="department_id" data-validation-required-message="Department is required" class="form-control">                                        
                                                    <option value="">Select Departments</option>
                                                    @foreach($Departments as $key => $Department)
                                                    <option value="{{ $Department->id }}">{{ $Department->name }}</option>
                                                    @endforeach                                        
                                                </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>Designation<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="designations_id" id="designation_id" data-validation-required-message="Designation is required" class="form-control">
                                                        <option value="">Select Designations</option>
                                                        @foreach($Designations as $key => $Designation)
                                                        <option value="{{ $Designation->id }}">{{ $Designation->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>Surname<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="surname" class="form-control" data-validation-required-message="Surname is required"> </div>
                                                    <div class="form-control-feedback"><small></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>Firstname<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="firstname" class="form-control"  data-validation-required-message="Firstname is required"> </div>
                                                    <div class="form-control-feedback"><small></small></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>Middlename</h5>
                                                <div class="controls">
                                                    <input type="text" name="middlename" class="form-control"> </div>
                                                    <div class="form-control-feedback"><small></small></div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>Gender<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="gender" id="gender" data-validation-required-message="Gender is required" class="form-control">
                                                    <option value="">Select Gender</option>                                         
                                                        @foreach($genders as $key => $gender)
                                                        <option value="{{ $gender->id }}">{{ $gender->gendername }}</option>
                                                        @endforeach                     
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>Date of Birth<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                <input type="date" name="dob" class="form-control" > </div>
                                                <div class="form-control-feedback"><small></small></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>MaritalStatus<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                <select name="marital_status_id" id="house"class="form-control">
                                                    <option value="">Select Marital Status</option>                                         
                                                    @foreach($MaritalStatus as $key => $Status)                                       
                                                    <option value="{{ $Status->id }}">{{ $Status->name }}</option>
                                                    @endforeach                       
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                                                            
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>Complexion<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                <select name="complexions_id" id="complexions_id" class="form-control">
                                                    <option value="">Select Complexion</option>
                                                    @foreach($Complexions as $key => $complexion)
                                                    <option value="{{ $complexion->id }}">{{ $complexion->name }}</option>
                                                    @endforeach                                                           
                                                </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>Tribe<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                <select name="tribe" id="tribe" class="form-control">                                            
                                                    @foreach($Tribes as $key => $Tribe)
                                                    <option value="{{ $Tribe->id }}">{{ $Tribe->name }}</option> 
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>Religion<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <select name="religion" id="religion" class="form-control">                                                
                                                        @foreach($Religions as $key => $Religion)
                                                        <option value="{{ $Religion->id }}">{{ $Religion->name }}</option>
                                                        @endforeach                                                
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>Nationality<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                <select name="country" id="country" class="form-control">                                        
                                                    @foreach($Countries as $key => $Country)
                                                    <option value="{{ $Country->id }}">{{ $Country->name }}</option> 
                                                    @endforeach                                       
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>State Of Origin<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                <select name="state" id="state" class="form-control">
                                                    <option value="">Select State</option>
                                                    @foreach($States as $key => $State)
                                                    <option value="{{ $State->id }}" {{ ($State->name == 'Benue')? 'selected' : ''}}>{{ $State->name }}</option>
                                                    @endforeach                                        
                                                </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>Local Govt of Origin<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                <select name="lga" id="lga" class="form-control">
                                                    <option value="">Select LGA</option>
                                                    @foreach($lgas as $key => $lga)
                                                    <option value="{{ $lga->id }}" {{ ($lga->name == 'Ukum')? 'selected' : ''}}>{{ $lga->name }}</option>
                                                    @endforeach                                     
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>Qualification<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                <select name="qualification_id" id="country" class="form-control"> 
                                                <option value="">Select Qualification</option>                                       
                                                    @foreach($Qualifications as $key => $Qualification)
                                                    <option value="{{ $Qualification->id }}">{{ $Qualification->name }}</option> 
                                                    @endforeach                                       
                                                </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>specialization</h5>
                                                <div class="controls">
                                                <input type="text" name="specialization" class="form-control" > </div>
                                                <div class="form-control-feedback"><small></small></div>
                                            </div>
                                        </div>
                                   
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>Mobile No</h5>
                                                <div class="controls">
                                                <input type="number" name="mobile_no" class="form-control" > </div>
                                                <div class="form-control-feedback"><small></small></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <h5>eMail</h5>
                                                <div class="controls">
                                                <input type="email" name="email" class="form-control" > </div>
                                                <div class="form-control-feedback"><small></small></div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Contact Address</h5>
                                                <div class="controls">
                                                <input type="text" name="address" class="form-control" > </div>
                                                <div class="form-control-feedback"><small></small></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Permanent Home Address</h5>
                                                <div class="controls">
                                                <input type="text" name="pm_address" class="form-control" > </div>
                                                <div class="form-control-feedback"><small></small></div>
                                            </div>
                                        </div>
                                        </div> 
                                    </fieldset>

                                    <fieldset class="border border-rounded p-10 p-lg-30">
                                        <legend class="w-auto">EMERGENCY CONTACT</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <h5>Surname<span class="text-danger"></span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="em_surname" class="form-control" > </div>
                                                        <div class="form-control-feedback"><small></small></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <h5>Firstname<span class="text-danger"></span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="em_firstname" class="form-control" > </div>
                                                        <div class="form-control-feedback"><small></small></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <h5>Middlename</h5>
                                                    <div class="controls">
                                                        <input type="text" name="em_middlename" class="form-control"> </div>
                                                        <div class="form-control-feedback"><small></small></div>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <h5>Occupation<span class="text-danger"></span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="em_occupation" class="form-control" > </div>
                                                            <div class="form-control-feedback"><small></small></div>
                                                    </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <h5>Mobile No.<span class="text-danger"></span></h5>
                                                    <div class="controls">
                                                        <input type="number" name="em_mobile_no" class="form-control" > </div>
                                                        <div class="form-control-feedback"><small></small></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <h5>eMail Address</h5>
                                                    <div class="controls">
                                                        <input type="email" name="em_email" class="form-control" > </div>
                                                        <div class="form-control-feedback"><small></small></div>
                                                </div>
                                            </div>
                                        
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <h5>Contact Address</h5>
                                                    <div class="controls">
                                                    <input type="text" name="em_address" class="form-control" > </div>
                                                    <div class="form-control-feedback"><small></small></div>
                                                </div>
                                            </div>
                                        </div>	
                                    </fieldset>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
									<input type="submit" value="Save Staff Enrolment" class="btn  btn-info">
								</div>
							</form>							
						</div>
					</div>
				</div>			
				<!-- /Academic Session Modal -->

				<!-- School Terms Modal -->
				<div class="modal fade" id="StaffRole" tabindex="-1" role="document" aria-labelledby="StaffRoleModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content box">
							<form method="post" action="javascript:void(0)">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title" id="StaffRoleModal">Assign Role to Staff</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="tru">&times;</span>
									</button>
								</div>
								<div class="modal-body box-body my-10">
									<div class="row">						
										<div class="col-md-6">
											<div class="form-group">
												<h5>Staff Role<span class="text-danger">*</span></h5>
												<div class="controls">
													<select name="designation" id="" class="form-control" data-validation-required-message="Role is required">
                                                        <option value="">Select Role</option>
                                                        @foreach ($Designations as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
												</div>								
											</div>
										</div>
                                        <div class="col-md-6">
											<div class="form-group">
												<h5>Staff<span class="text-danger">*</span></h5>
												<div class="controls">
													<select name="designation" id="" class="form-control" data-validation-required-message="Staff is required">
                                                        <option value="">Select Staff</option>
                                                        @foreach ($Staffs as $Staff)
                                                            <option value="{{ $Staff->id }}">{{ $Staff->surname }}, {{ $Staff->firstname }} {{ $Staff->middlename }}</option>
                                                        @endforeach
                                                    </select>
												</div>								
											</div>
										</div>										
									</div>			
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
									<input type="submit" value="Assign Role" class="btn  btn-info">
								</div>
							</form>							
						</div>
					</div>
				</div>			
				<!-- /School Terms Modal -->


				<div class="col-xl-9">				
					<div class="nav-tabs-custom box-profile">
						<!-- tabs-navigation -->
						<ul class="nav nav-tabs">
							<li><a class="active" href="#staff" data-toggle="tab">List of Staff</a></li>				  
							<li><a href="#staff_role" data-toggle="tab">Staff Role</a></li>							
						</ul>
						<!-- /tabs-navigation -->

						<!-- tab-content -->
						<div class="tab-content">
							<!-- academic session -->					
							<div class="active tab-pane bg-transparent" id="staff">
								<div class="box pt-30 pb-30 px-20">
								<div class="row">						  
									<div class="col-sm-12">
										<h4>LIST OF STAFF</h4>
										<div class="text-right">
											<button type="button" class="btn btn-info" data-toggle="modal" data-target="#StaffEnrolment">
												Enrol New Staff
											</button>
										</div>
										<hr />
										<div class="table-responsive">
                                            <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                                <thead>
                                                    <tr>
                                                        <th width="2%">S/No</th>
                                                        <th>Staff No</th>
                                                        <th>Full Name</th>
                                                        <th>Gender</th>
                                                        <th>Designation</th>
                                                        <th>Departments</th>
                                                        <th>Action</i></th>				
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Staffs as $key => $Staff)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $Staff->staff_no }}</td>
                                                        <td><a href="{{ route('staff_profile', $Staff->id) }}" class="text-success" target="_blank">{{ $Staff->surname.', '.$Staff->firstname.' '.$Staff->middlename }}</a></td>
                                                        <td>{{ $Staff->gender }}</td>
                                                        <td>{{ $Staff->des_name }}</td>
                                                        <td>{{ $Staff->dep_name }}</td>
                                                        <td><a href="{{ route('employment_letter', $Staff->id) }}" target="_blank">
                                                                    <i class="text-warning mdi mdi-printer"></i>
                                                            </a>
                                                            <a href="{{ route('edit_staff_record', $Staff->id) }}" target="_blank">
                                                                    <i class="text-warning mdi mdi-pencil-box-outline"></i> 
                                                            </a>
                                                            <a href="{{ route('delete_staff_record', $Staff->id) }}" onclick="return confirm('Are You Sure You Want To Delete The Selected Student')">
                                                                    <i class="text-warning mdi mdi-delete"></i> 
                                                            </a>
                                                        </td>								
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>   						
									</div>
								</div>
								<!-- /.row -->
								</div>										
							</div>
							<!-- /academic session -->

							<!-- term definitions -->											
							<div class="tab-pane" id="staff_role">
								<div class="box pt-30 pb-30 px-20">
								<div class="row">						  
									<div class="col-sm-12">
										<h4>AVAILABLE ROLES</h4>
										<div class="text-right">
											<button type="button" class="btn btn-info" data-toggle="modal" data-target="#StaffRole">
												Assign Staff New Role
											</button>
										</div>
										<hr />
										<div class="table-responsive">
											<table class="table table-bordered table-striped">
												<thead>
													<tr>														
														<th>Role</a></th>								
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													@foreach($Designations as $designation)
													<tr>														
														<td>{{ $designation->name }}</td>
														<td>
															<a class="dropdown-item text-warning" href="javascript:void(0)">
																<i class="mr-2 ti-check"></i> Reassign Role
															</a>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>							
									</div>
								</div>
								<!-- /.row -->
								</div>										
							</div>						
							<!-- /term definitions -->							
						</div>
						<!-- /academic session tab-content -->

						
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