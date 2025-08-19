@extends('admin.admin_master')

@section('mainContent')
@section('title', 'Students')

<div class="content-wrapper">
	<div class="container-full">

		<section class="content">
			<div class="box">
				<div class="box-header with-border">
					<h4 class="box-title">Filter Student By Class</h4>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col">
							<form method="get" action="{{ route('view_student_by_class') }}">

								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<h5>Academic Session<span class="text-danger">*</span></h5>
											<div class="controls">
												<select name="acad_session" id="acad_session" required
													class="form-control p-10">
													@foreach($School_Sessions as $key => $School_Session)
														<option value="{{ $School_Session->id }}">
															{{ $School_Session->name }}</option>
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
													@foreach($Classes as $key => $Class)
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
														<option value="{{ $class_arm->id }}">{{ $class_arm->arm_name }}
														</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<div class="text-xs-right pt-25">
												<input type="submit" value="View Students" class="btn  btn-info">
											</div>
										</div>
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
		</section>
		<!-- Main content -->
		<section class="content">

			<div class="row">

				<!-- Admission Form Modal -->
				<div class="modal fade" id="EnrolStudent" tabindex="-1" role="document"
					aria-labelledby="EnrolStudentModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
						<div class="modal-content box">
							@include('forms.admission_form')			
						</div>
					</div>
				</div>
				<!-- /Admission Form Modal -->

				<div class="col-12">
					<div class="box">
					<div class="box-header with-border">
                            <h3 class="box-title">List of Students Admitted</h3>                    
                            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#EnrolStudent" >
                                Enrol Student
                            </button>			  
                        </div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table id="example"
									class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
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
												<td>{{ $key + 1 }}</td>
												<td>{{ $Student->admission_no }}</td>
												<td><a href="{{ route('view_student_profile', $Student->students_id) }}"
														class="text-success"
														target="_blank">{{ $Student->surname . ', ' . $Student->firstname . ' ' . $Student->middlename }}</a>
												</td>
												<td>{{ $Student->gendername }}</td>
												<td>{{ $Student->classname }} {{ $Student->arm_name }}</td>
												<td>{{ $Student->name }}</td>
												<td>{{ $Student->date_of_birth }}
												<td><a href="{{ route('admission_letter', $Student->students_id) }}"
														target="_blank">
														<i class="text-warning mdi mdi-printer"></i>
													</a>
													<a href="{{ route('edit_student_record', $Student->students_id) }}"
														target="_blank">
														<i class="text-warning mdi mdi-pencil-box-outline"></i>
													</a>
													<a href="{{ route('delete_student_record', $Student->students_id) }}"
														onclick="return confirm('Are You Sure You Want To Delete The Selected Student?')">
														<i class="text-warning mdi mdi-delete"></i>
													</a>
													<a href="{{ route('suspend_student', $Student->students_id) }}"
														onclick="return confirm('Do you wish to suspend the selected student?')">
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


<script>	

function NumberAdmitted() {
    $('#class_arm').change(()=>{
        let arm_id = class_arm.value;
        let class_id = class_admitted.value;
    let url = '/AdmittedStudents/' +class_id+'_'+arm_id;
    $.ajax({
        url: url,
        method: 'GET',
        data: {},
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(response){
            if(response < 50 ) {
                $('#admitted_students').empty();                                      
                $('#admitted_students').append(response); 
            } else {                                   
                window.location.reload();
                toastr.info("The selected class is filled up.")

            }
            
        },
        error: function(response){

        }

    });	
    });
    
}

function stateLGAs() {
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
    
}

$(document).ready(() => {
   stateLGAs();
   NumberAdmitted();

});

StudentPassport.onchange = event => {
        let StudentPassport = document.getElementById('StudentPassport');    
        OuputStudentPassport.src = URL.createObjectURL(event.target.files[0]);
};

</script>

@endsection