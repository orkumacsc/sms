@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">		
		<!-- Main content -->
		<section class="content">
			<!-- row -->            
		  <div class="row">
			<!-- Subjects Section -->
			<div class="col-lg-5 col-md-12">
				<!-- Subjects Form -->                    
				<div class="box">
					<div class="box-header with-border">
					<h4 class="box-title">Add Subjects</h4>			  
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					<div class="row">
						<div class="col">
							<form method="post" action="{{ route('school.subjects.store') }}">
							@csrf
							<div class="row items-baseline">						
								<div class="col-md-8">
									<div class="form-group">
										<h5>Subject <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="subject_name" class="form-control" required> 
										</div>								
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="controls">											
											<div class="text-xs-right pt-25">
												<input type="submit" value="Add Subject" class="btn  btn-info">
											</div>
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
				<!-- /Add Subject Form -->

				<!-- Subject List Box -->
				<div class="box">
					<div class="box-header with-border">
					<h3 class="box-title">Subject List</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>S/No</th>
									<th> <a href="">Subject Name</a></th>								
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($allData as $key => $schoolsubject)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $schoolsubject->subject_name }}</td>
									<td class="text-center">
										<a  href=""><i class="text-warning mdi mdi-pencil-box-outline"></i></a>
										<a  href="" onclick="return confirm('Are You Sure You Want To Delete The Selected Student')">
											<i class="text-danger mdi mdi-delete"></i>
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
				<!-- / Subject List Box -->
			</div>
			<!-- /Subjects Section -->

			<!-- Assign Subjects to Class Section -->			
			<div class="col-lg-7 col-md-12">
				<!-- Form -->
				<div class="box">
					<!-- box-header -->
					<div class="box-header with-border">
						<h4 class="box-title">Assign Subject To Class</h4>			  
					</div>
					<!-- /.box-header -->
					 <!-- box-body -->
					<div class="box-body">
					<div class="row">
						<div class="col">
							<form method="post" action="{{ route('store_assigned_subject') }}">
								@csrf
								<div class="row">
									<div class="col-sm-4">
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

									<div class="col-sm-8">
										<div class="form-group">
											<h5>Subject<span class="text-danger">*</span></h5>
											<div class="controls">
											<select name="subject_id" id="class" required class="form-control p-10">
												<option value="">Select Subject</option>
												@foreach($SchoolSubjects as $key => $smSubject)
												<option value="{{ $smSubject->id }}">{{ $smSubject->subject_name }}</option>
												@endforeach                                        
											</select>
											</div>
										</div>
									</div>								
								</div>
								<div class="row">
									<div class="col-sm-8">
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
									
									<div class="col-sm-4">
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
				<!-- /Form -->

				<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">List of Subjects with Class Assigned</h3>                  
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

			</div>
			<!-- /Assign Subjects to Class Section -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->	  
	  </div>
  </div>

@endsection