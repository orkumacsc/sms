@extends('admin.admin_master')
@section('mainContent')
@section('title', 'Form Masters Assignment')

	<div class="content-wrapper">
		<div class="container-full">

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- Admission Form Modal -->
					<div class="modal fade" id="AppointClassTeacher" tabindex="-1" role="document"
						aria-labelledby="EnrolStudentModal" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content box">
								@include('forms.staff_class_assignment')
							</div>
						</div>
					</div>
					<!-- /Admission Form Modal -->

					<div class="col-12">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Form Masters</h3>
								<button type="button" class="btn btn-info pull-right" data-toggle="modal"
									data-target="#AppointClassTeacher">
									Appoint Form Masters
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
												<th>Full Name</th>												
												<th>Class Assigned</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@forelse ($classTeachers as $key => $classTeacher)
												<tr>
													<td>{{ $key + 1 }}</td>													
													<td>
														{{ "{$classTeacher->teacher->surname}, {$classTeacher->teacher->firstname} {$classTeacher->teacher->middlename}" }}
													</td>													
													<td>
														{{ $classTeacher->class()->first()->classname ?? 'Not Assigned Class' }}
														{{ $classTeacher->department()->first()->name ?? 'Not Assigned Department' }}
														{{ $classTeacher->arm()->first()->arm_name ?? 'Not Assigned Arm' }}
													</td>
													<td>
														<form
															action="{{ route('staff.classes.update', $classTeacher->teacher->id) }}"
															method="POST" class="d-inline">
															@csrf
															@method('PUT')
															<button type="submit" class="btn btn-info btn-md"
																onclick="return confirm('Are you sure you want to update this class assignment?')">
																<i class="mdi mdi-pencil"></i> Update
															</button>
														</form>
														<form
															action="{{ route('staff.classes.delete', $classTeacher->teacher->id) }}"
															method="POST" class="d-inline"
															onsubmit="return confirm('Are you sure you want to delete this class assignment?')">
															@csrf
															@method('DELETE')
															<button type="submit" class="btn btn-danger btn-md">
																<i class="mdi mdi-delete"></i> Remove
															</button>
														</form>
													</td>
												</tr>
											@empty
												<tr>
													<td colspan="6" class="text-center">No Staff Found</td>
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
	</div>
@endsection