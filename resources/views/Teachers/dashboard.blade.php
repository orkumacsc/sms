@extends('Teachers.master')

@section('mainContent')
@section('title', 'Staff Dashboard')
<div class="content-wrapper">
	<div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
				@if (session('staff_profile'))
					@include('Teachers.body.profile')
				@endif
				<div class="modal fade" id="ChangePassword" tabindex="-1" role="document"
					aria-labelledby="ChangePasswordModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered " role="document">
						<div class="modal-content box">
							<form method="post" action="javascript:void(0);" enctype="multipart/form-data">
								<div class="modal-header">
									<h5 class="modal-title" id="ChangePasswordModal"> <i
											class="text-secondary mdi mdi-lock-reset"></i> Change Password</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body box-body my-10">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">												
												<div class="controls">
													<input type="password" name="current_password" class="form-control"
														placeholder="Enter Your Current Password" required>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">												
												<div class="controls">
													<input type="password" name="password" class="form-control"
														placeholder="Enter Your New Password" required>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">												
												<div class="controls">
													<input type="password" name="confirm_password" class="form-control"
														placeholder="Confirm New Password" required>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal"
										aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
									<input type="submit" value="Change Password" class="btn  btn-info">
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="col-12 col-md-6 col-xl-2">
					<a href="#" data-toggle="modal" data-target="#Profile">
						<div class="box overflow-hidden pull-up">
							<div class="box-body">
								<div class="icon bg-info-light rounded w-60 h-60">
									<i class="text-info mr-0 font-size-36 mdi mdi-face-man-profile"></i>
								</div>
								<div>
									<p class="text-mute mt-20 mb-0 font-size-16">Profile</p>
									<h3 class="text-white mb-0 font-weight-500"></h3>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-12 col-md-6 col-xl-2">
					<a href="#" data-toggle="modal" data-target="#ChangePassword">
						<div class="box overflow-hidden pull-up">
							<div class="box-body">
								<div class="icon bg-info-light rounded w-60 h-60">
									<i class="text-info mr-0 font-size-36 mdi mdi-lock-reset"></i>
								</div>
								<div>
									<p class="text-mute mt-20 mb-0 font-size-16">Change Password</p>
									<h3 class="text-white mb-0 font-weight-500"></h3>
								</div>
							</div>
						</div>
					</a>
				</div>

			</div>
		</section>
		<!-- /.content -->
	</div>
</div>

@endsection