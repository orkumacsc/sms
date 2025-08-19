@extends('admin.admin_master')

@section('mainContent')
@section('title', 'School Arms')

	<div class="content-wrapper">
		<div class="container-full">
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- Add new school arm modal -->
					<div class="modal fade" id="createClassArm" tabindex="-1" role="document"
						aria-labelledby="createClassArmModal" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content box">
								@include('forms.add_arm', ['routeName' => 'store_school_arm', 'title' => 'Add New School Arm'])
							</div>
						</div>
					</div>
					<!-- /Add new school arm modal -->

					<!-- Add arm to class modal -->
					<div class="modal fade" id="assignClassArmForm" tabindex="-1" role="document"
						aria-labelledby="createClassArmModal" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content box">
								@include('forms.arm_class_assignment', ['routeName' => 'store_class_arm', 'title' => 'Assign Arm To Class'])
							</div>
						</div>
					</div>
					<!-- /Add arm to class modal -->

					<!-- Add New Class Modal -->
					<div class="modal fade" id="feesDiscountForm" tabindex="-1" role="document"
						aria-labelledby="feesDiscountModel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content box">
								@include('forms.add_class', ['routeName' => 'save_school_class', 'title' => 'Add New Class'])
							</div>
						</div>
					</div>
					<!-- /Add New Class Modal -->

					<!-- Add New Class Modal -->
					<div class="modal fade" id="ClassDisciplineModal" tabindex="-1" role="document"
						aria-labelledby="ClassDisciplineModal" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content box">
								@include('forms.add_class_discipline', ['routeName' => 'store_class_discipline', 'title' => 'Add Class Discipline'])
							</div>
						</div>
					</div>
					<!-- /Add New Class Modal -->

					<div class="col-sm-12 col-lg-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">List of Classes</h3>
								<div class="text-right">
									<button type="button" class="btn btn-info" data-toggle="modal"
										data-target="#feesDiscountForm">
										Add New Class
									</button>
								</div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>S/No</th>
												<th> <a href="">Class</a></th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($schoolClasses as $key => $schoolclass)
												<tr>
													<td>{{ $key + 1 }}</td>
													<td>{{ $schoolclass->classname }}</td>
													<td>
														<ul class="nav navbar-nav">
															<li class="dropdown user user-menu">
																<a href="#" class="waves-effect waves-light dropdown-toggle"
																	data-toggle="dropdown" title="View Actions">
																	<i class="ti-menu-alt"></i>
																</a>
																<ul class="dropdown-menu animated flipInX">
																	<li class="user-body">
																		<a class="dropdown-item text-success"
																			href="{{ route('class_profile', $schoolclass->id) }}">
																			<i class="ti-eye"></i>
																			Enter Class
																		</a>
																		<div class="dropdown-divider"></div>
																		<a class="dropdown-item text-warning" href="">
																			<i class="mdi mdi-pencil-box-outline"></i>
																			Edit Class
																		</a>
																		<div class="dropdown-divider"></div>
																		<a class="dropdown-item text-danger" href="">
																			<i class="mdi mdi-delete"></i>
																			Delete Class
																		</a>
																	</li>
																</ul>
															</li>
														</ul>
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

					<div class="col-sm-12 col-lg-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">List of School Arms</h3>
								<div class="text-right">
									<button type="button" class="btn btn-info" data-toggle="modal"
										data-target="#createClassArm">
										Add New Arm
									</button>
								</div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>S/No</th>
												<th> <a href="">Arm Name</a></th>
												<th> <a href="">Date Created</a></th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($schoolArms as $key => $school_arm)
												<tr>
													<td>{{ $key + 1 }}</td>
													<td>{{ $school_arm->arm_name }}</td>
													<td>{{ $school_arm->created_at }}</td>
													<td>
														<ul class="nav navbar-nav">
															<li class="dropdown user user-menu">
																<a href="#" class="waves-effect waves-light dropdown-toggle"
																	data-toggle="dropdown" title="View Actions">
																	<i class="ti-menu-alt"></i>
																</a>
																<ul class="dropdown-menu animated flipInX">
																	<li class="user-body">
																		<a class="dropdown-item text-warning" href=""><i
																				class="mr-2 mdi mdi-pencil-box-outline"></i>
																			Edit Arm</a>
																		<div class="dropdown-divider"></div>
																		<a class="dropdown-item text-danger" href=""><i
																				class="mr-2 mdi mdi-delete"></i> Delete Arm</a>
																	</li>
																</ul>
															</li>
														</ul>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
							<!-- /.box-body -->
						</div>
					</div>
				</div>
				<!-- /.row -->

				<!-- Class Disciplines -->
				<div class="row">
					<div class="col-sm-12 col-lg-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Class and Disciplines</h3>
								<div class="text-right">
									<button type="button" class="btn btn-info" data-toggle="modal"
										data-target="#ClassDisciplineModal">
										Add Class Disciplines
									</button>
								</div>
							</div>
							<!-- /.box-header -->

							<div class="box-body">
								<div class="table-responsive">
									<table id="example" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>S/No</th>
												<th>Class Name</th>
												<th>Discipline Name</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($classDisciplines as $key => $classDiscipline)
												<tr>
													<td>{{ $key + 1 }}</td>
													<td>{{ $classDiscipline->classname ?? '' }}</td>
													<td>
														@foreach ($classDiscipline->disciplines as $discipline)
															{{ $discipline->name ?? '' }}@if (!$loop->last), @endif
														@endforeach
													</td>													
													<td>
														<ul class="nav navbar-nav">
															<li class="dropdown user user-menu">
																<a href="#" class="waves-effect waves-light dropdown-toggle"
																	data-toggle="dropdown" title="View Actions">
																	<i class="ti-menu-alt"></i>
																</a>
																<ul class="dropdown-menu animated flipInX">
																	<li class="user-body">
																		<a class="dropdown-item text-warning" href="">
																			<i class="mdi mdi-delete"></i> Remove Discipline from Class
																		</a>
																	</li>
																</ul>
															</li>
														</ul>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
							<!-- /.box-body -->
						</div>
					</div>

					<div class="col-sm-12 col-lg-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">List of Class Arms</h3>
								<div class="text-right">
									<button type="button" class="btn btn-info" data-toggle="modal"
										data-target="#assignClassArmForm">
										Add Class Arm
									</button>
								</div>
							</div>
							<!-- /.box-header -->

							<div class="box-body">
								<div class="table-responsive">
									<table id="example" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>S/No</th>
												<th>Class Name</th>
												<th>Arm Name</th>												
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($classArms as $key => $classArm)
												<tr>
													<td>{{ $key + 1 }}</td>
													<td>{{ $classArm->classname }}</td>
													<td>
														@foreach ($classArm->arms as $arm)
															{{ $arm->arm_name }}@if (!$loop->last), @endif
														@endforeach
													</td>													
													<td>
														<ul class="nav navbar-nav">
															<li class="dropdown user user-menu">
																<a href="#" class="waves-effect waves-light dropdown-toggle"
																	data-toggle="dropdown" title="View Actions">
																	<i class="ti-menu-alt"></i>
																</a>
																<ul class="dropdown-menu animated flipInX">
																	<li class="user-body">
																		<a class="dropdown-item text-warning" href=""><i
																				class="mdi mdi-delete"></i> Remove Arm from
																			Class</a>
																	</li>
																</ul>
															</li>
														</ul>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
							<!-- /.box-body -->
						</div>
					</div>
				</div>
				<!-- /.row -->
				<!-- /Class & Arm section -->
			</section>
			<!-- /.content -->
		</div>
	</div>

@endsection