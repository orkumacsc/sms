@extends('admin.admin_master')

@section('mainContent')
<div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Staff Enrollment Form</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('store_staff_enrollment') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">                        

                            <div class="col-sm-4">
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

                            <div class="col-sm-4">
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

                            <div class="col-sm-4">
                                <div class="form-group">
                                        <h5>Passport<span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="file" name="staff_passport" id="Passport" class="form-control" data-validation-required-message="Passport is required"> </div>
                                    </div>
                                </div>
                            </div>    

                            <div class="row">
                                <div class="col-sm-4">
                                        <div class="form-group">
                                            <h5>Surname<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="surname" class="form-control" data-validation-required-message="Surname is required"> </div>
                                                <div class="form-control-feedback"><small></small></div>
                                        </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Firstname<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="firstname" class="form-control"  data-validation-required-message="Firstname is required"> </div>
                                            <div class="form-control-feedback"><small></small></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Middlename</h5>
                                        <div class="controls">
                                            <input type="text" name="middlename" class="form-control"> </div>
                                            <div class="form-control-feedback"><small></small></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Gender<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="gender" id="gender" data-validation-required-message="Gender is required" class="form-control">                                        
                                                @foreach($genders as $key => $gender)
                                                <option value="{{ $gender->id }}">{{ $gender->gendername }}</option>
                                                @endforeach                     
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Date of Birth<span class="text-danger"></span></h5>
                                        <div class="controls">
                                        <input type="date" name="dob" class="form-control" > </div>
                                        <div class="form-control-feedback"><small></small></div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>MaritalStatus<span class="text-danger"></span></h5>
                                        <div class="controls">
                                        <select name="marital_status_id" id="house"class="form-control">                                         
                                            @foreach($MaritalStatus as $key => $Status)                                       
                                            <option value="{{ $Status->id }}">{{ $Status->name }}</option>
                                            @endforeach
                                                                                
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="col-sm-4">
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

                                    <div class="col-sm-4">
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

                                    <div class="col-sm-4">
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

                            </div>

                            <div class="row">
                                <div class="col-sm-4">
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
                                <div class="col-sm-4">
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

                            
                                <div class="col-sm-4">
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
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
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

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <h5>specialization</h5>
                                            <div class="controls">
                                            <input type="text" name="specialization" class="form-control" > </div>
                                            <div class="form-control-feedback"><small></small></div>
                                        </div>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Mobile No</h5>
                                        <div class="controls">
                                        <input type="number" name="mobile_no" class="form-control" > </div>
                                        <div class="form-control-feedback"><small></small></div>
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <h5>eMail</h5>
                                        <div class="controls">
                                        <input type="email" name="email" class="form-control" > </div>
                                        <div class="form-control-feedback"><small></small></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h5>Contact Address</h5>
                                        <div class="controls">
                                        <input type="text" name="address" class="form-control" > </div>
                                        <div class="form-control-feedback"><small></small></div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h5>Permanent Home Address</h5>
                                        <div class="controls">
                                        <input type="text" name="pm_address" class="form-control" > </div>
                                        <div class="form-control-feedback"><small></small></div>
                                    </div>
                                </div>
                            </div>

                            <h5 class="mt-20 mb-10">EMERGENCY CONTACT INFORMATION</h5>
                            <hr />
                            
                            <div class="row">
                                <div class="col-sm-4">
                                        <div class="form-group">
                                            <h5>Surname<span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <input type="text" name="em_surname" class="form-control" > </div>
                                                <div class="form-control-feedback"><small></small></div>
                                        </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Firstname<span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="em_firstname" class="form-control" > </div>
                                            <div class="form-control-feedback"><small></small></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Middlename</h5>
                                        <div class="controls">
                                            <input type="text" name="em_middlename" class="form-control"> </div>
                                            <div class="form-control-feedback"><small></small></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                        <div class="form-group">
                                            <h5>Occupation<span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <input type="text" name="em_occupation" class="form-control" > </div>
                                                <div class="form-control-feedback"><small></small></div>
                                        </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Mobile No.<span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="number" name="em_mobile_no" class="form-control" > </div>
                                            <div class="form-control-feedback"><small></small></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>eMail Address</h5>
                                        <div class="controls">
                                            <input type="email" name="em_email" class="form-control" > </div>
                                            <div class="form-control-feedback"><small></small></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <h5>Contact Address</h5>
                                        <div class="controls">
                                        <input type="text" name="em_address" class="form-control" > </div>
                                        <div class="form-control-feedback"><small></small></div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-info" value="Submit Enrollment Form">
                            </div>
                        </div>
                        
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->
	  </div>
  </div>
@endsection