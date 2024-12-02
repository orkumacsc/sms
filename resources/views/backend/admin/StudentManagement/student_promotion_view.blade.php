@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
            

		  <div class="row mt-0"> 

			<div class="col-sm-12 col-xxl-6">

			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Students in Class <p class="students"></p></h3>               
           
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="" class="table table-bordered nowrap">
						<thead>
                            <tr>
                            <div class="row">                
                <div class="col-sm-12 text-center p-0 m-0">                                        
                    <h3>{{ $current_session->name }} ACADEMIC SESSION</h3>
                    
                        <h4>CLASS: {{ $current_class->classname }}</h4>
                    
                </div>
            </div>
                            </tr>
							<tr>
								<th>S/No</th>
								<th>Admission No</th>
								<th>Full Name</th>        
								<th>
                                    <input type="checkbox" name="" id="selectAllCheckbox" onClick="toggle(this)" />
                                    <label for="selectAllCheckbox">Tick All</label>
                                </th>
							</tr>
						</thead>
            <form method="post" action="{{ route('student_promotion') }}"> 
                @csrf             
			    <tbody>
                    @foreach($StudentDetails as $key => $Student)                            
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $Student->admission_no }}</td>
                        <td>{{ $Student->surname.', '.$Student->firstname.' '.$Student->middlename }}</td>
                        <td>                            
                            <input type="checkbox" id="{{ $Student->students_id }}" name="student_id[{{ $Student->students_id }}]" class="checkboxes">
                            <label for="{{ $Student->students_id }}"></label>					        
                        </td>                           							
                    </tr>                            
                    @endforeach
                    <tr>
                        <td>                            
                            <div class="form-group">
                                <h5>New Class<span class="text-danger">*</span></h5>
                                <div class="controls">
                                <select name="new_class" id="new_class" required class="form-control p-10">                                        
                                    @foreach($Classes as $key => $s_class)
                                    <option value="{{ $s_class->id }}">{{ $s_class->classname }}</option> 
                                    @endforeach                                       
                                </select>
                                </div>
                            </div>                            
                        </td>
                        <td colspan="2">                            
                            <div class="form-group">
                                <h5>New Class Arm<span class="text-danger">*</span></h5>
                                <div class="controls">
                                <select name="new_class_arm" id="new_class_arm" required class="form-control p-10">                                        
                                    @foreach($ClassArms as $key => $class_arm)
                                    <option value="{{ $class_arm->id }}">{{ $class_arm->arm_name }}</option> 
                                    @endforeach                                       
                                </select>
                                </div>
                            </div>                            
                        </td>
                        <td><button type="submit" style="float: right;" class="btn btn-secondary">Submit</button></td>
                    </tr>	
                    
                </tbody>
                		          
            </form>
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
    
        document.getElementById('selectAllCheckbox')
                  .addEventListener('change', function () {
            let checkboxes = 
                document.querySelectorAll('.checkboxes');
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = this.checked;                
            }, this);
        }); 
  </script>

@endsection