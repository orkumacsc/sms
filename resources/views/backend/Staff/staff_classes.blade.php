@extends('admin.admin_master')
@section('mainContent')
@section('title', 'Staff Class Assignment')

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
                            <h3 class="box-title">List of Form Masters</h3>
                            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#AppointClassTeacher">
                                Appoint Class Teacher
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
											<th>Staff ID</th>
                                            <th>Full Name</th>
                                            <th>Gender</th>
                                            <th>Class Assigned</th>                                            
											<th>Action</i></th>
										</tr>
									</thead>
									<tbody>
										@forelse ($staffClasses as $key => $StaffClass)
											<tr>
												<td>{{ $key + 1 }}</td>
												<td>{{ $StaffClass->staff_no }}</td>
												<td>
                                                    {{ "{$StaffClass->surname}, {$StaffClass->firstname} {$StaffClass->middlename}" }}
												</td>
												<td>{{ $StaffClass->gender }}</td>
												<td>{{ $StaffClass->classGroup()->first()->classname ?? 'Not Assigned Class' }}</td>
												<td>
													<form action="{{ route('staff.classes.update', $StaffClass->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-info btn-md" onclick="return confirm('Are you sure you want to update this class assignment?')">Update</button>
													</form>
													<a href="{{ route('staff.classes.delete', $StaffClass->id) }}"
                                                        class="text-danger" onclick="return confirm('Are you sure you want to delete this class assignment?')">
                                                        <i class="mdi mdi-delete"></i>
													</a>
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