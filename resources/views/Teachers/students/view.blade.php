@extends('Teachers.master')
@section('mainContent')
@section('title', 'My Students')
	<div class="content-wrapper">
		<div class="container-full">
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- Admission Form Modal -->
					<div class="modal fade" id="EnrolStudent" tabindex="-1" role="document"
						aria-labelledby="EnrolStudentModal" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
							<div class="modal-content box">

							</div>
						</div>
					</div>
					<!-- /Admission Form Modal -->

					<div class="col-12">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Students in my class</h3>
								<button type="button" class="btn btn-success pull-right" data-toggle="modal"
									data-target="#EnrolStudent">
									Mark Attendance
								</button>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="table-responsive">
									<table id="example"
										class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
										<thead>
											<tr>
												<th width="2%">S/No</th>
												<th>Admission No</th>
												<th>Full Name</th>
												<th>Gender</th>
												<th>Class</th>
												<th>House</th>
												<th>Date of Birth</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($students as $key => $Student)
												<tr>
													<td>{{ $key + 1 }}</td>
													<td>{{ $Student->admission_no }}</td>
													<td><a href="{{ route('view_student_profile', $Student->students_id) }}"
															class="text-success"
															target="_blank">{{ "{$Student->surname}, {$Student->firstname} {$Student->middlename}" }}</a>
													</td>
													<td>{{ $Student->gendername ?? '' }}</td>
													<td>{{ $Student->name ?? '' }}</td>
													<td>{{ $Student->housename ?? '' }}</td>
													<td>{{ $Student->date_of_birth ?? '' }}</td>
													<td>
														<a href="{{ route('admission_letter', $Student->students_id) }}"
															target="_blank">
															<i class="text-warning mdi mdi-printer"></i>
														</a>
														<a href="{{ route('edit_student_record', $Student->students_id) }}"
															target="_blank">
															<i class="text-warning mdi mdi-pencil-box-outline"></i>
														</a>
														<a href="{{ route('suspend_student', $Student->students_id) }}"
															onclick="return confirm('Do you wish to suspend the selected student?')">
															<i class="text-warning mdi mdi-close-octagon"></i>
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