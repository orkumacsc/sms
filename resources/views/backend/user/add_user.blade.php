@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">User Registration</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('user.store') }}">
                    @csrf
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
						<div class="text-xs-right">
							<input type="submit" value="submit" class="btn  btn-info">
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->
	  </div>
  </div>

@endsection