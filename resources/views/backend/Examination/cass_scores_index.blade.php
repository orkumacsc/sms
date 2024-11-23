@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">View CASS Scores</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="get" action="{{ route('view_cass_scores') }}">
					    <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Session<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="s_id" id="s_id" required class="form-control p-10">
                                    <option value="">Select Session</option>                                        
                                        @foreach($SchoolSessions as $key => $Session)
                                        <option value="{{ $Session->id }}">{{ $Session->name }}</option> 
                                        @endforeach                                       
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Term<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="term_id" id="term" required class="form-control p-10">
                                        <option value="">Select Term</option>
                                        @foreach($SchoolTerm as $key => $Term)
                                        <option value="{{ $Term->id }}">{{ $Term->name }}</option>
                                        @endforeach                                        
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
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
                        </div>
                        <div class="row">                            
                            
							<div class="col-sm-4">
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

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Subjects<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="subject_id" id="term" required class="form-control p-10">
                                        <option value="">Select Subjects</option>
                                        @foreach($SchoolSubjects as $key => $Subject)
                                        <option value="{{ $Subject->id }}">{{ $Subject->subject_name }}</option>
                                        @endforeach                                        
                                    </select>
                                    </div>
                                </div>
                            </div>
							<div class="col-sm-4">
								<div class="form-group">									
									<div class="text-xs-right pt-25">
										<input type="submit" value="Get CASS Scores" class="btn  btn-info">
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