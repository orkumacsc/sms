@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Transfer Students</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="get" action="{{ route('student_promotion_view') }}">
                    
					<div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                      <h5>Academic Session<span class="text-danger">*</span></h5>
                      <div class="controls">
                      <select name="acad_session" id="acad_session" required class="form-control p-10">                                        
                          @foreach($SchoolSessions as $key => $School_Session)
                          <option value="{{ $School_Session->id }}">{{ $School_Session->name }}</option> 
                          @endforeach                                       
                      </select>
                      </div>
                  </div>
              </div>
              <div class="col-sm-3">
                  <div class="form-group">
                      <h5>Current Class<span class="text-danger">*</span></h5>
                      <div class="controls">
                      <select name="current_class" id="current_class" required class="form-control p-10">
                          <option value="">Select Current Class</option>
                          @foreach($Classes as $key => $Class)
                          <option value="{{ $Class->id }}">{{ $Class->classname }}</option>
                          @endforeach                                        
                      </select>
                      </div>
                  </div>
              </div> 
              <div class="col-sm-3">
                  <div class="form-group">
                      <h5>New Class Arm<span class="text-danger">*</span></h5>
                      <div class="controls">
                      <select name="class_arm" id="class_arm"  class="form-control p-10">
                          <option value="">Select New Class Arm</option>
                          @foreach($ClassArms as $key => $class_arm)
                          <option value="{{ $class_arm->id }}">{{ $class_arm->arm_name }}</option>
                          @endforeach                                        
                      </select>
                      </div>
                  </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">									
                  <div class="text-xs-right pt-25">
                    <input type="submit" value="Transfer To New Class" class="btn  btn-info">
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
	  </div>
  </div>

@endsection