@extends('admin.admin_master')

@section('mainContent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Student Admission Form</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('student-admission.store') }}" enctype="multipart/form-data">
                        @csrf

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
									<input type="file" name="imgPassport" id="Passport" class="form-control" required data-validation-required-message="Passport is required"> </div>
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
						<div class="text-xs-right">
							<input type="submit" class="btn btn-info" value="Submit">
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

  
<script>
	
	$(document).ready(() => {
        $('#state_id').change(()=>{
            let stateid = state_id.value;
        let url = '/GetLGA/' +stateid;
        $.ajax({
            url: url,
            method: 'GET',
            data: {},
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response){
                $('#lga').empty();

                if(response.length > 0) {                        
                    response.forEach(LGA => {                            
                        $('#lga').append('<option value="'+LGA.id+'">'+LGA.name+'</option>');
                    });						
                    
                } else {
                    $('#lga').append('<option value"">No LGA available for state</option>');
                    
                    
                }				
            },
            error: function(response){

            }

        });	
        });
        
	});	
</script>

@endsection