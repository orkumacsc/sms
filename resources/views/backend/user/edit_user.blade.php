@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Update User Login Details</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('user.update', $editData->id) }}">
                    @csrf
                      <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<h5>User Role<span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="usertype" id="usertype" required class="form-control">
										<option value="" selected disabled>Select</option>
										<option value="Super Admin" {{ ($editData->usertype == "Super Admin" ? "selected" : "") }} >Super Admin</option>
										<option value="Admin" {{ ($editData->usertype == "Admin" ? "selected" : "") }}>Admin</option>
                                        <option value="Staff" {{ ($editData->usertype == "Staff" ? "selected" : "") }}>Staff</option>
                                        <option value="Student" {{ ($editData->usertype == "Student" ? "selected" : "") }}>Student</option>
                                        <option value="Parent" {{ ($editData->usertype == "Parent" ? "selected" : "") }}>Parent</option>
                                        <option value="Accountant" {{ ($editData->usertype == "Accountant" ? "selected" : "") }}>Accountant</option>
                                        <option value="Admission Officer" {{ ($editData->usertype == "Admission Officer" ? "selected" : "") }}>Admission Officer</option>										
									</select>
								</div>
							</div>
						</div>
                        <div class="col-md-6">
                            <div class="form-group">
								<h5>Username <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="name" class="form-control" required value="{{ $editData->name }}"> </div>								
							</div>
                        </div>
                      </div>
                      <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<h5>Email<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="email" name="email" class="form-control" required value="{{ $editData->email }}" > </div>
							</div>
						</div>
					  </div>
						<div class="text-xs-right">
							<input type="submit" value="Update" class="btn  btn-info">
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