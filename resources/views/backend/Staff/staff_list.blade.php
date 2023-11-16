@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">

		  <div class="row"> 

			<div class="col-12">

			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">List of Staff</h3>
                  <a href="{{ route('enrol_staff') }}" style="float: right;" class="btn btn-secondary">Enrol Staff</a>				  
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
						<thead>
							<tr>
								<th width="2%">S/No</th>
								<th>Staff No</th>
								<th>Full Name</th>
								<th>Gender</th>
								<th>Designation</th>
								<th>Departments</th>
								<th>Action</i></th>				
							</tr>
						</thead>
						<tbody>
                            @foreach($Staffs as $key => $Staff)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $Staff->staff_no }}</td>
                                <td><a href="{{ route('staff_profile', $Staff->id) }}" class="text-success" target="_blank">{{ $Staff->surname.', '.$Staff->firstname.' '.$Staff->middlename }}</a></td>
								<td>{{ $Staff->gender }}</td>
                                <td>{{ $Staff->des_name }}</td>
								<td>{{ $Staff->dep_name }}</td>
								<td><a href="{{ route('admission_letter', $Staff->id) }}" target="_blank">
											<i class="text-warning mdi mdi-printer"></i>
									</a>
									<a href="{{ route('edit_staff_record', $Staff->id) }}" target="_blank">
											<i class="text-warning mdi mdi-pencil-box-outline"></i> 
									</a>
									<a href="{{ route('delete_staff_record', $Staff->id) }}" onclick="return confirm('Are You Sure You Want To Delete The Selected Student')">
											<i class="text-warning mdi mdi-delete"></i> 
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