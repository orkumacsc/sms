@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
      <section class="content">
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Assign Subject To Class</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('store_assigned_subject') }}">
                        @csrf
						<div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <h5>Class<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="class_id" id="class" required class="form-control p-10">
                                        <option value="">Select Class</option>
                                        @foreach($SchoolClasses as $key => $smClass)
                                        <option value="{{ $smClass->id }}">{{ $smClass->classname }}</option>
                                        @endforeach                                        
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Subject<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="subject_id" id="class" required class="form-control p-10">
                                        <option value="">Select Subject</option>
                                        @foreach($SchoolSubjects as $key => $smSubject)
                                        <option value="{{ $smSubject->id }}">{{ $smSubject->name }}</option>
                                        @endforeach                                        
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Teacher<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="teacher_id" id="class" required class="form-control p-10">
                                        <option value="">Select Teacher</option>
                                        @foreach($Staff as $key => $smStaff)
                                        <option value="{{ $smStaff->id }}">{{ $smStaff->surname }}, {{ $smStaff->firstname }} {{ $smStaff->middlename }}</option>
                                        @endforeach                                        
                                    </select>
                                    </div>
                                </div>
                            </div>                            
                            
							<div class="col-sm-2">
								<div class="form-group">									
									<div class="text-xs-right pt-25">
										<input type="submit" value="Assign Subject" class="btn  btn-info">
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
				  <h3 class="box-title">List of Class</h3>                  
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
						<thead>
							<tr>
								<th>S/No</th>
								<th>Subject Name</th>
								<th>Subject Teacher</th>
								<th>Class</th>							
							</tr>
						</thead>
						<tbody>
                            @foreach($ClassSubjects as $key => $cSubject)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $cSubject->subjects }}</td>
                                <td><a href="{{ route('staff_profile',$cSubject->staff_id) }}" class="text-success">{{ $cSubject->surname.', '.$cSubject->firstname.' '.$cSubject->middlename }}</a></td>
								<td>{{ $cSubject->class }}</td>							
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