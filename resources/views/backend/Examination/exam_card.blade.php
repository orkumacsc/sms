@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Students' Exam Cards</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col-xl-7">
					<form method="get" action="{{ route('GenerateExamCard') }}">
					<div class="row">                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <h5>Class<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="class" id="class" required class="form-control p-10">
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
                                    <select name="arm_id" id="class" required class="form-control p-10">
                                        <option value="">Select Class Arm</option>
                                        @foreach($SchoolArms as $key => $class_arm)
                                        <option value="{{ $class_arm->id }}">{{ $class_arm->arm_name }}</option>
                                        @endforeach                                        
                                    </select>
                                    </div>
                                </div>
                            </div>
							<div class="col-sm-3">
								<div class="form-group">									
									<div class="text-xs-right pt-25">
										<input type="submit" value="Generate Exam Cards" class="btn  btn-info">
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