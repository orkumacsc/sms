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
					<form method="post" action="{{ route('transfer_student') }}">
                    @csrf
					<div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Student Name<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="id" id="student_id" required class="form-control p-10">
                                    <option value="">Select Student To Transfer</option>                                        
                                        @foreach($Students as $key => $Student)
                                        <option value="{{ $Student->id }}">{{ $Student->surname.', '.$Student->firstname.' '.$Student->middlename }}</option> 
                                        @endforeach                                       
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>New Class<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="class" id="class" required class="form-control p-10">
                                        <option value="">Select New Class</option>
                                        @foreach($Classes as $key => $Class)
                                        <option value="{{ $Class->id }}">{{ $Class->classname }}</option>
                                        @endforeach                                        
                                    </select>
                                    </div>
                                </div>
                            </div>
							<div class="col-sm-4">
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