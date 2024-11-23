@extends('Admission_Officer.master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Select Criteria</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
                <form method="get" action="{{ route('admissions_list') }}">   

                    <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <h5>Academic Session<span class="text-danger">*</span></h5>
                            <div class="controls">
                            <select name="acad_session" id="acad_session" class="form-control p-10">                                        
                                @foreach($SchoolSessions as $key => $School_Session)
                                <option value="{{ $School_Session->id }}">{{ $School_Session->name }}</option> 
                                @endforeach                                       
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <h5>Term<span class="text-danger">*</span></h5>
                            <div class="controls">
                            <select name="term_id" id="term_id" class="form-control p-10">
                                <option value="">Select Term</option>
                                @foreach($School_Terms as $key => $Term)
                                <option value="{{ $Term->id }}">{{ $Term->name }}</option>
                                @endforeach                                        
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <h5>Class<span class="text-danger">*</span></h5>
                            <div class="controls">
                            <select name="class" id="class" class="form-control p-10">
                                <option value="">Select Class</option>
                                @foreach($SchoolClasses as $key => $Class)
                                <option value="{{ $Class->id }}">{{ $Class->classname }}</option>
                                @endforeach                                        
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <h5>Class Arm<span class="text-danger">*</span></h5>
                            <div class="controls">
                            <select name="classarm_id" id="classarm_id" class="form-control p-10">
                                <option value="">Select Class Arm</option>
                                @foreach($ClassArms as $key => $class_arm)
                                <option value="{{ $class_arm->id }}">{{ $class_arm->arm_name }}</option>
                                @endforeach                                        
                            </select>
                            </div>
                        </div>
                    </div>
                    </div> 

                    <div class="text-xs-right pt-25">
                        <input type="submit" value="View Enroled Students" class="btn  btn-info">
                    </div>

                </form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		</section>
		<!-- Main content -->
		<section class="content">

		  <div class="row"> 
        
      <!-- Academic Session Modal -->
				<div class="modal fade" id="EnrolStudent" tabindex="-1" role="document" aria-labelledby="EnrolStudentModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
						<div class="modal-content box">
							<form method="post" action="{{ route('store_student_enrolment') }}" enctype="multipart/form-data">
								@csrf
								<div class="modal-header">
									
                  <div class="col-sm-12 col-xl-4">
                      <h5 class="modal-title" id="StaffEnrolmentModal">NEW STUDENT ENROLMENT</h5>
                  </div>
                  <div class="col-sm-12 col-xl-4">
                      <h5 class="text-success">STUDENTS IN THE SELECTED CLASS: <i id="admitted_students" class="text-white"></i></h5>	
                  </div>	  
									<div class="col-sm-12 col-xl-4">
                      <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  
								</div>
								<div class="modal-body box-body m-10">
                        <div class="row">                                                
                          <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Class<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="class_admitted" id="class_admitted" required class="form-control">
                                            <option value="">Select Class</option>
                                            @foreach($SchoolClasses as $key => $school_classes)
                                            <option value="{{ $school_classes->id }}">{{ $school_classes->classname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Class Arm<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="class_arm" id="class_arm" required class="form-control">
                                            <option value="">Select Class Arm</option>
                                            @foreach($ClassArms as $key => $class_arm)
                                            <option value="{{ $class_arm->id }}">{{ $class_arm->arm_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        </div>

                        <div class="col-sm-4">
                        <div class="form-group">
								<h5>Passport<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="file" name="imgPassport" id="Passport" class="form-control" data-validation-required-message="Passport is required"> </div>
							</div>
                        </div>

                        </div>    

                        <div class="row">
                            <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Surname<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="surname" class="form-control" required data-validation-required-message="Surname is required"> </div>
                                            <div class="form-control-feedback"><small></small></div>
                                    </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Firstname<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="firstname" class="form-control" required data-validation-required-message="Firstname is required"> </div>
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
                                    <select name="gender" id="gender" required class="form-control">                                        
                                        @foreach($genders as $key => $gender)
                                        <option value="{{ $gender->id }}">{{ $gender->gendername }}</option>
                                        @endforeach                     
                                    </select>
                                </div>
                            </div>
                            </div>                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Date of Birth</h5>
                                    <div class="controls">
                                    <input type="date" name="dob" class="form-control" > </div>
                                    <div class="form-control-feedback"><small></small></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Complexion<span class="text-danger"></span></h5>
                                    <div class="controls">
                                    <select name="complexion" id="complexion" class="form-control">
                                        <option value="">Select Complexion</option>
                                        @foreach($Complexions as $key => $complexion)
                                        <option value="{{ $complexion->id }}">{{ $complexion->name }}</option>
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
                                    <select name="state_id" id="state_id" class="form-control">
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
                                                                    
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Home Town</h5>
                                    <div class="controls">
                                    <input type="text" name="home_town" class="form-control"> </div>
                                    <div class="form-control-feedback"><small></small></div>
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
                                    <h5>Height<span class="text-danger"></span></h5>
                                    <div class="controls">
                                    <select name="height" id="height" class="form-control">
                                        <option value="">Select Height (ft)</option>
                                        <option value="1.5">1.5</option>                                                            
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Weight<span class="text-danger"></span></h5>
                                    <div class="controls">
                                    <select name="weight" id="weight" class="form-control">
                                        <option value="">Select Weight (kg)</option>
                                        <option value="76">76</option>                                                            
                                    </select>
                                    </div>
                                </div>
                            </div>                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>House<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="house" id="house" required class="form-control">                                         
                                        @foreach($Houses as $key => $House)                                       
                                        <option value="{{ $House->id }}">{{ $House->name }}</option>
                                        @endforeach
                                                                               
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h5>Address</h5>
                                    <div class="controls">
                                    <input type="text" name="address" class="form-control" > </div>
                                    <div class="form-control-feedback"><small></small></div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-20 mb-10">PREVIOUS SCHOOL INFORMATION</h5><hr />
                        
                        <div class="row">
                            <div class="col-sm-8">
                                    <div class="form-group">
                                        <h5>School Name<span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="school_name" class="form-control" > </div>
                                            <div class="form-control-feedback"><small></small></div>
                                    </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Class<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="last_class" class="form-control"> </div>
                                        <div class="form-control-feedback"><small></small></div>
                                </div>
                            </div>
                        </div>


                        <h5 class="mt-20 mb-10">PARENT/GUARDIAN INFORMATION</h5>
                        <hr />
                        
                        <div class="row">
                            <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Surname<span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="pg_surname" class="form-control" > </div>
                                            <div class="form-control-feedback"><small></small></div>
                                    </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Firstname<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="pg_firstname" class="form-control" > </div>
                                        <div class="form-control-feedback"><small></small></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Middlename</h5>
                                    <div class="controls">
                                        <input type="text" name="pg_middlename" class="form-control"> </div>
                                        <div class="form-control-feedback"><small></small></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Occupation<span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="pg_occupation" class="form-control" > </div>
                                            <div class="form-control-feedback"><small></small></div>
                                    </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Mobile No.<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="number" name="pg_mobile_no" class="form-control" > </div>
                                        <div class="form-control-feedback"><small></small></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>eMail Address</h5>
                                    <div class="controls">
                                        <input type="email" name="pg_email" class="form-control" > </div>
                                        <div class="form-control-feedback"><small></small></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h5>Address</h5>
                                    <div class="controls">
                                    <input type="text" name="pg_address" class="form-control" > </div>
                                    <div class="form-control-feedback"><small></small></div>
                                </div>
                            </div>
                        </div>             
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
									<input type="submit" value="Save Student" class="btn  btn-info">
								</div>
							</form>							
						</div>
					</div>
				</div>			
				<!-- /Academic Session Modal -->
        <div class="col-12">

          <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">List of Students Admitted</h3>                    
                    <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#EnrolStudent" disabled>
												Enrol Student
										</button>			  
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
              <thead>
                <tr>
                  <th width="2%">S/No</th>
                  <th>Admission No</th>
                  <th>Full Name</th>
                  <th>Gender</th>
                  <th>Class</th>
                  <th>House</th>
                  <th>Date of Birth</th>
                  <th>Action</i></th>				
                </tr>
              </thead>
              <tbody>
                  @foreach($Students as $key => $Student)
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $Student->admission_no }}</td>
                          <td><a href="{{ route('view_student_profile', $Student->students_id) }}" class="text-success" target="_blank">{{ $Student->surname.', '.$Student->firstname.' '.$Student->middlename }}</a></td>
                          <td>{{ $Student->gendername }}</td>
                          <td>{{ $Student->classname }} {{ $Student->arm_name }}</td>
                          <td>{{ $Student->name }}</td>
                          <td>{{ $Student->date_of_birth }}
                          <td>
                            <a href="{{ route('student_admission_letter', $Student->students_id) }}" target="_blank">
                                <i class="text-warning mdi mdi-printer"></i>
                            </a>
                            <a href="{{ route('edit_student_record', $Student->students_id) }}" target="_blank">
                                <i class="text-warning mdi mdi-pencil-box-outline"></i> 
                            </a>
                            <a href="{{ route('delete_student_record', $Student->students_id) }}" onclick="return confirm('Are You Sure You Want To Delete The Selected Student')">
                                <i class="text-warning mdi mdi-delete"></i> 
                            </a>
                          </td>								
                        </tr>
                  @endforeach
                </tbody>
            </table>
            </div>              
          </div>
          <!-- /.box-body -->
          </div>
          <!-- /.box -->          
        </div>
        <!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>

@endsection