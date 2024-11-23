@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
      <section class="content">
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Class Result</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
                    <form method="get" action="{{ route('class_result') }}">
					    <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Session<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="acad_session" id="s_id" required class="form-control p-10">
                                    <option value="">Select Session</option>                                        
                                        @foreach($SchoolSessions as $key => $Session)
                                        <option value="{{ $Session->id }}">{{ $Session->name }}</option> 
                                        @endforeach                                       
                                    </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <h5>Class<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="class_id" id="class_id" required class="form-control p-10">
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
                                    <h5>Arm<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="arm_id" id="arm_id" required class="form-control p-10">
                                        <option value="">Select Arm</option>
                                        @foreach($ClassArms as $key => $Arm)
                                        <option value="{{ $Arm->id }}">{{ $Arm->arm_name }}</option>
                                        @endforeach                                        
                                    </select>
                                    </div>
                                </div>
                            </div>

							<div class="col-sm-2">
								<div class="form-group">									
									<div class="text-xs-right pt-25">
										<input type="submit" value="Enter class" class="btn  btn-info">
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
		<section class="content">

		  <div class="row"> 

			<div class="col-12">

			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">List of Students</h3>                  				  
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table class="table table-bordered display nowrap margin-top-10 w-p100">
						<thead>
							<tr>
								<th width="2%">S/No</th>
								<th>Admission No</th>
								<th>Full Name</th>
                                <th>Session</th>
                                <th>Term</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($Students as $key => $Student)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $Student->admission_no }}</td>
                                <td><a href="{{ route('user.view_profile',$Student->id) }}" class="text-success">{{ $Student->surname.', '.$Student->firstname.' '.$Student->middlename }}</a></td>
                                
                                <form method="get" action="{{ route('report_card') }}">
                                    
                                        <td>                                            
                                            <select name="session_id" required class="form-control">
                                                <option value="">Select Session</option>                                        
                                                @foreach($SchoolSessions as $key => $Session)
                                                <option value="{{ $Session->id }}">{{ $Session->name }}</option> 
                                                @endforeach                                       
                                            </select>                                                   
                                        </td>

                                        <td>                                            
                                            <select name="term_id" required class="form-control">
                                                <option value="">Select Term</option>
                                                @foreach($SchoolTerm as $key => $Term)
                                                <option value="{{ $Term->id }}">{{ $Term->name }}</option>
                                                @endforeach                                        
                                            </select>                                                    
                                        </td>
                                        
                                        <input type="hidden" name="student_id" value="{{ $Student->id }}">  
                                        <input type="hidden" name="class_id" value="{{ $Student->class }}">                                                                            
                                        <input type="hidden" name="classarm_id" value="{{ $Student->classarm_id }}">                                                                            

                                        <td>                                            
                                            <input type="submit" value="View Result" class="btn  btn-info">                                                   
                                        </td>
                                </form>								
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