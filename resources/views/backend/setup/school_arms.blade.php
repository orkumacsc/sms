@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">            
			<div class="row">
				<!-- Add New Class Arm Modal -->
				<div class="modal fade" id="createClassArm" tabindex="-1" role="document" aria-labelledby="createClassArmModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content box">
							<form method="post" action="{{ route('store_school_arm') }}">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title" id="createClassArmModal">Add New School Arm</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="tru">&times;</span>
									</button>
								</div>
								<div class="modal-body box-body my-10">
									<div class="row">						
										<div class="col-md-12">
											<div class="form-group">
												<h5>School Arm <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="arm_name" class="form-control" required> 
												</div>								
											</div>
										</div>										
									</div>			
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
									<input type="submit" value="Save School Arm" class="btn  btn-info">
								</div>
							</form>							
						</div>
					</div>
				</div>			
				<!-- /Add New Class Arm Modal -->

				<!-- Assign Class Arm Modal -->
				<div class="modal fade" id="assignClassArmForm" tabindex="-1" role="document" aria-labelledby="createClassArmModalModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content box">
							<form method="post" action="{{ route('store_class_arm') }}">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title" id="createClassArmModalModal">Assign Arm to Class</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="tru">&times;</span>
									</button>
								</div>
								<div class="modal-body box-body my-10">
									<div class="row">						
										<div class="col-md-6">
											<div class="form-group">
												<h5>School Arm <span class="text-danger">*</span></h5>
												<div class="controls">
													<select name="arm_id" class="form-control" required>
														<option value="">Select Arm</option>
														@foreach($SchoolArms as $key => $school_arm)
															<option value="{{$school_arm->id }}">
																{{$school_arm->arm_name}}
															</option>
														@endforeach
													</select>
												</div>								
											</div>  
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<h5>Class <span class="text-danger">*</span></h5>
												<div class="controls">
													<select name="class_id" class="form-control" required>
														<option value="">Select Class</option>
														@foreach($SchoolClasses as $key => $school_class)
														<option value="{{$school_class->id }}">
															{{$school_class->classname}}
														</option>
														@endforeach
													</select>
												</div>							
											</div>       
										</div>										
									</div>			
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>								
									<input type="submit" value="Submit" class="btn  btn-info">
								</div>	
							</form>							
						</div>
					</div>
				</div>			
				<!-- /Assign Class Arm Modal -->

				<div class="col-sm-12 col-xl-6">  
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">List of School Arms</h3>
							<div class="text-right">
									<button type="button" class="btn btn-info" data-toggle="modal" data-target="#createClassArm">
										Add School Arm
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
									@foreach($SchoolArms as $key => $school_arm)
									<tr>
										<td>{{ $key+1 }}</td>
										<td>{{ $school_arm->arm_name }}</td>
										<td>{{ $school_arm->created_at }}</td>
										<td>
											<ul class="nav navbar-nav">
											<li class="dropdown user user-menu">	
												<a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown" title="View Actions">
													<i class="ti-menu-alt"></i>
												</a>
												<ul class="dropdown-menu animated flipInX">
													<li class="user-body">														
														<a class="dropdown-item text-warning" href=""><i class="mr-2 mdi mdi-pencil-box-outline"></i> Edit School Arm</a>
														<div class="dropdown-divider"></div>
														<a class="dropdown-item text-danger" href=""><i class="mr-2 mdi mdi-delete"></i> Delete School Arm</a>
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

				<div class="col-sm-12 col-xl-6"> 
					<!-- Class Arm List Box -->
					<div class="box">
						<div class="box-header with-border">
						<h3 class="box-title">List of Class Arms</h3>
						<div class="text-right">
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#assignClassArmForm">
									Assign Arm to Class
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
										<th> <a href="">Class Name</a></th>
										<th>Arm Name</th>
										<th>Status</th>								
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($ClassArms as $key => $ClassArm)
									<tr>
										<td>{{ $key+1 }}</td>
										<td>{{ $ClassArm->classname }}</td>
										<td>{{ $ClassArm->arm_name }}</td>
										<td class="{{ $ClassArm->active_status == 1 ? 'text-success' : 'text-danger' }}">{{ $ClassArm->active_status ? 'Active' : 'In Active' }}</td>
										<td>
											<ul class="nav navbar-nav">
												<li class="dropdown user user-menu">	
													<a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown" title="View Actions">
														<i class="ti-menu-alt"></i>
													</a>
													<ul class="dropdown-menu animated flipInX">
														<li class="user-body">
															<a class="dropdown-item text-warning" href=""><i class="mdi mdi-delete"></i> Remove Arm from Class</a>
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
					<!-- /Class Arm List Box -->

				</div>
			</div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  </div>
  </div>

@endsection