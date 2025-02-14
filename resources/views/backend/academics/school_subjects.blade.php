@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
			<!-- row -->
			<div class="row">
				<!-- Form Modals Section -->
				<div class="modal fade" id="CreateSubject" tabindex="-1" role="document"
					aria-labelledby="CreateSubjectModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content box">
							<form method="post" action="{{ route('store_school_subject') }}"
								enctype="multipart/form-data">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title" id="CreateSubjectModal"> <i
											class="text-secondary mdi mdi-calculator-variant-outline"></i> ADD SCHOOL
										SUBJECT</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body box-body my-10">
									<div class="row items-baseline">
										<div class="col-md-12">
											<div class="form-group">
												<h5>SUBJECT NAME<span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="subject_name" class="form-control"
														placeholder="Enter Subject Name Here" required>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal"
										aria-label="close"><i class="ti-arrow-left"> CANCEL</i></button>
									<input type="submit" value="SAVE SUBJECT" class="btn  btn-info">
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="modal fade" id="AssignSubject" tabindex="-1" role="document"
					aria-labelledby="AssignSubjectModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content box">
							<form method="post" action="{{ route('store_class_subject') }}"
								enctype="multipart/form-data">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title" id="AssignSubjectModal"> <i
											class="text-secondary mdi mdi-calculator-variant-outline"></i> ASSIGN
										SUBJECT TO CLASS
									</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body box-body my-10">
									<div class="row">
										<div class="table-responsive col-sm-12">
											<table id="" class="table table-bordered nowrap">

												<thead>
													<tr>
														<th>S/No</th>
														<th>SUBJECT NAME</th>
														<th>
															<input type="checkbox" name="" id="selectAllCheckbox" />
															<label for="selectAllCheckbox">Tick All</label>
														</th>
													</tr>
												</thead>

												<tbody>
													@foreach($SchoolSubjects as $key => $smSubject)                            
														<tr>
															<td>{{ $key + 1 }}</td>
															<td>{{ $smSubject->subject_name}}
															</td>
															<td>
																<input type="checkbox" id="{{ $smSubject->id }}"
																	name="subject_id[{{ $smSubject->id }}]"
																	class="checkboxes">
																<label for="{{ $smSubject->id }}"></label>
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>

										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<h5>CLASS<span class="text-danger">*</span></h5>
												<div class="controls">
													<select name="class_id" id="class_id" required
														class="form-control p-10">
														<option value="">SELECT CLASS</option>
														@foreach($SchoolClasses as $key => $smClass)
															<option value="{{ $smClass->id }}">{{ $smClass->classname }}
															</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<h5>DEPARTMENT<span class="text-danger">*</span></h5>
												<div class="controls">
													<select name="department_id" id="department_id"
														class="form-control p-10">
														<option value="">SELECT DEPARTMENT</option>
														@foreach($departments as $department)
															<option value="{{ $department->id }}">
																{{ $department->name }}
															</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal"
										aria-label="close"><i class="ti-arrow-left"> CANCEL</i></button>
									<input type="submit" value="SAVE ASSIGNED SUBJECTS" class="btn  btn-info">
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /Form Modals Section -->

				<!-- Subjects Section -->
				<div class="col-lg-5 col-md-12">
					<!-- Subject List Box -->
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">LIST OF SUBJECTS</h3>
							<div class="text-right">
								<button type="button" class="btn btn-info" data-toggle="modal"
									data-target="#CreateSubject">
									ADD SCHOOL SUBJECT
								</button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table id="example1"
									class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
									<thead>
										<tr>
											<th>S/No</th>
											<th> <a href="">Subject Name</a></th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($SchoolSubjects as $key => $smSubjects)
											<tr>
												<td>{{ $key + 1 }}</td>
												<td>{{ $smSubjects->subject_name }}</td>
												<td class="text-center">
													<a href=""><i class="text-warning mdi mdi-pencil-box-outline"></i></a>
													<a href=""
														onclick="return confirm('Are You Sure You Want To Delete The Selected Student')">
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
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">LIST OF SUBJECTS AND CLASS ASSIGNED</h3>
							<div class="text-right">
								<button type="button" class="btn btn-info" data-toggle="modal"
									data-target="#AssignSubject">
									ADD SUBJECT TO CLASS
								</button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table id="example"
									class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
									<thead>
										<tr>
											<th>S/No</th>
											<th>Subject Name</th>
											<th>Department</th>											
											<th>Class</th>
										</tr>
									</thead>
									<tbody>
										@foreach($ClassSubjects as $key => $cSubject)
											<tr>
												<td>{{ $key + 1 }}</td>
												<td>{{ $cSubject->subject_name }}</td>
												<td>{{ $cSubject->department }}</td>												
												<td>{{ $cSubject->classname }}</td>
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