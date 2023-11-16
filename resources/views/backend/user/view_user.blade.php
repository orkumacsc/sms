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
				  <h3 class="box-title">List of Users</h3>
                  <a href="{{ route('user.add') }}" style="float: right;" class="btn btn-success">Add User</a>				  
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