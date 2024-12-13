@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">

		  <div class="row"> 

		  	<div class="modal fade" id="UserAssign" tabindex="-1" role="document" aria-labelledby="UserAssignModal" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
					<div class="modal-content box">
						<form method="post" action="{{ route('store_user') }}" enctype="multipart/form-data">
							@csrf
							<div class="modal-header">
								<h5 class="modal-title" id="StaffEnrolmentModal">Assign Staff Roles</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body box-body my-10">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<h5>User Role<span class="text-danger">*</span></h5>
											<div class="controls">
												<select name="usertype" id="usertype" required class="form-control">
													<option value="" selected disabled>Select</option>
													@foreach ($userRoles as  $user_role)
													
														<option value="{{ $user_role->id }}"> {{ $user_role->name }}</option>

													@endforeach										
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<h5>Username <span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="text" name="username" class="form-control" required> </div>								
										</div>
									</div>

									<div class="col-md-5">
										<div class="form-group">
											<h5>Password <span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="password" name="password" class="form-control" required> </div>								
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<h5>Email<span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="email" name="email" class="form-control" required> </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<h5>Full Name<span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="text" name="full_name" class="form-control" required> </div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
								<input type="submit" value="Assign Role" class="btn  btn-info">
							</div>
						</form>							
					</div>
				</div>
			</div>	

			<div class="col-12">
				<div class="box">
				
				
			  	</div>

				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">List of Users</h3>
						<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#UserAssign">
							Assign User Roles
						</button>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
						<table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
							<thead>
								<tr>
									<th width="2%">S/No</th>
									<th>Role</th>
									<th>Full Name</th>
									<th>eMail</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($allData as $key => $user)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $user->usertype }}</td>
									<td><a href="{{ route('user.view_profile',$user->id) }}" class="text-info">{{ $user->name }}</a></td>
									<td>{{ $user->email }}</td>
									
									<td>
										<a href="{{ route('user.edit',$user->id) }}" class="btn btn-info">Edit</a>
										<a href="{{ route('user.delete',$user->id) }}" class="btn btn-danger" id="delete" >Delete</a>                                     
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
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>

@endsection