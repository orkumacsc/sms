@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Generate Students' Roll No (Register Number)</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('store_reg_no') }}">
                    @csrf
					<div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                      <h5>Academic Session<span class="text-danger">*</span></h5>
                      <div class="controls">
                      <select name="academic_session" id="academic_session" required class="form-control p-10">                                        
                          @foreach($SchoolSessions as $key => $School_Session)
                          <option value="{{ $School_Session->id }}" {{ session('academic_session') == $School_Session->id ? "selected" : ''}}>{{ $School_Session->name }}</option> 
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
                          @foreach($Classes as $key => $Class)
                          <option value="{{ $Class->id }}" {{ session('class_id') == $Class->id ? "selected" : ''}}>{{ $Class->classname }}</option>
                          @endforeach                                        
                      </select>
                      </div>
                  </div>
              </div> 
              <div class="col-sm-3">
                  <div class="form-group">
                      <h5>Class Arm<span class="text-danger">*</span></h5>
                      <div class="controls">
                      <select name="class_arm_id" id="class_arm_id"  class="form-control p-10">
                          <option value="">Select Class Arm</option>
                          @foreach($ClassArms as $key => $class_arm)
                          <option value="{{ $class_arm->id }}" {{ session('class_arm') == $class_arm->id ? "selected" : ''}}>{{ $class_arm->arm_name }}</option>
                          @endforeach                                        
                      </select>
                      </div>
                  </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">									
                  <div class="text-xs-right pt-25">
                    <input type="submit" value="Generate Register Number" class="btn  btn-info">
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