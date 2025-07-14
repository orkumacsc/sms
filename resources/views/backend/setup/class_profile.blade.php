@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	<div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-sm-12">

					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">List of Classes</h3>
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
										@foreach($ClassArms as $key => $schoolclass)
											<tr>
												<td>{{ $key + 1 }}</td>
												<td>{{ $schoolclass->classname }} {{ $schoolclass->arm_name }}</td>
												<td>
													<a class="text-success"
														href="{{ route('class_profile', "{$class_id}_{$schoolclass->id}") }}"
														onclick=""><i class="mr-2 ti-eye"></i> Enter Class
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