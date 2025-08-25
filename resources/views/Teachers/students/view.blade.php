@extends('Teachers.master')
@section('title', 'My Students')
@section('mainContent')
	<div class="content-wrapper">
		<div class="container-full">
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-12 col-md-6 col-xl-3">
						<a href="#" data-toggle="modal" data-target="#Profile">
							<div class="box overflow-hidden pull-up">
								<div class="box-body">
									<div class="icon bg-info-light rounded w-60 h-60">
										<i class="text-info mr-0 font-size-36 mdi mdi-face-man-profile"></i>
									</div>
									<div>
										<p class="text-mute mt-20 mb-0 font-size-16">Check Results</p>
										<h3 class="text-white mb-0 font-weight-500"></h3>
									</div>
								</div>
							</div>
						</a>
					</div>

					<div class="col-12 col-md-6 col-xl-3">
						<a href="#" data-toggle="modal" data-target="#Profile">
							<div class="box overflow-hidden pull-up">
								<div class="box-body">
									<div class="icon bg-info-light rounded w-60 h-60">
										<i class="text-info mr-0 font-size-36 mdi mdi-face-man-profile"></i>
									</div>
									<div>
										<p class="text-mute mt-20 mb-0 font-size-16">Mark Attendance</p>
										<h3 class="text-white mb-0 font-weight-500"></h3>
									</div>
								</div>
							</div>
						</a>
					</div>

					<div class="col-12 col-md-6 col-xl-3">
						<a href="#" data-toggle="modal" data-target="#Profile">
							<div class="box overflow-hidden pull-up">
								<div class="box-body">
									<div class="icon bg-info-light rounded w-60 h-60">
										<i class="text-info mr-0 font-size-36 mdi mdi-face-man-profile"></i>
									</div>
									<div>
										<p class="text-mute mt-20 mb-0 font-size-16">Vet Uploaded Scores</p>
										<h3 class="text-white mb-0 font-weight-500"></h3>
									</div>
								</div>
							</div>
						</a>
					</div>

					<div class="col-12 col-md-6 col-xl-3">
						<a href="#" data-toggle="modal" data-target="#Profile">
							<div class="box overflow-hidden pull-up">
								<div class="box-body">
									<div class="icon bg-info-light rounded w-60 h-60">
										<i class="text-info mr-0 font-size-36 mdi mdi-face-man-profile"></i>
									</div>
									<div>
										<p class="text-mute mt-20 mb-0 font-size-16">Attendance Reports</p>
										<h3 class="text-white mb-0 font-weight-500"></h3>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Students in my class</h3>
								<button type="button" class="btn btn-info pull-right" data-toggle="modal"
									data-target="#MarkAttendance">
									Mark Attendance
								</button>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="table-responsive">
									<table id="example"
										class="table table-bordered table-hover display nowrap margin-top-10 w-p100">										
										<caption style="caption-side: top;" class="text-center">
											<h3>
												Students in {{ $schoolClass->classname ?? '' }}
												{{ $department->name ?? '' }} - {{ $schoolArm->arm_name ?? '' }}
											</h3>
										</caption>
										<thead>
											<tr>
												<th width="2%">S/No</th>
												<th>Admission No</th>
												<th>Full Name</th>
												<th>Gender</th>
												<th>House</th>
												<th>Date of Birth</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@forelse($teacherStudents as $key => $teacherStudent)
												@php
													$student = $teacherStudent->student()->first();
												@endphp
												<tr>
													<td>{{ $key + 1 }}</td>
													<td>{{ $student->admission_no ?? '' }}</td>
													<td>
														@if(!empty($student) && !empty($student->students_id))
															<a href="{{ route('view_student_profile', $student->students_id) }}"
																class="text-success" target="_blank">
																{{ "{$student->surname}, {$student->firstname} {$student->middlename}" }}
															</a>
														@else
															<span class="text-muted">Profile unavailable</span>
														@endif
													</td>
													<td>{{ $student->gender()->first()->gendername ?? '' }}</td>
													<td>{{ $student->house()->first()->name ?? '' }}</td>
													<td>{{ !empty($student->date_of_birth) ? \Carbon\Carbon::parse($student->date_of_birth)->format('d M, Y') : '' }}
													</td>
													<td>
														<a href="{{ route('admission_letter', $student->students_id ?? '') }}"
															target="_blank" title="Print Admission Letter">
															<i class="text-info mdi mdi-printer"></i>
														</a>

														<form
															action="{{ route('edit_student_record', $student->students_id ?? '') }}"
															method="GET" style="display:inline;">
															@csrf															
															<input type="hidden" name="students_id"
																value="{{ $student->students_id ?? '' }}">
															<button type="submit" class="btn p-0 m-0 align-baseline"
																title="Edit Student Record">
																<i class="text-warning mdi mdi-pencil-box-outline"></i>
															</button>
														</form>

														@if(auth()->user()->can('suspend-student'))
															<a href="{{ route('suspend_student', $student->students_id ?? '') }}"
																title="Suspend Student" class="suspend-student-link"
																onclick="event.preventDefault(); if(confirm('Do you wish to suspend the selected student?')) { document.getElementById('suspend-form-{{ $student->students_id }}').submit(); }">
																<i class="text-warning mdi mdi-close-octagon"></i>
															</a>
															<form id="suspend-form-{{ $student->students_id }}"
																action="{{ route('suspend_student', $student->students_id ?? '') }}"
																method="POST" style="display:none;">
																@csrf
																@method('PUT')
															</form>
														@endif
													</td>
												</tr>
											@empty
												<tr>
													<td colspan="8" class="text-center">No students found</td>
												</tr>
											@endforelse
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
@endsection

	@push('scripts')
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				document.querySelectorAll('.suspend-student-link').forEach(function (link) {
					link.addEventListener('click', function (event) {
						if (!confirm('Do you wish to suspend the selected student?')) {
							event.preventDefault();
						}
					});
				});
			});
		</script>
	@endpush