@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
		
		<!-- Main content -->
		<section class="content">            
		  <div class="row">

          <div class="col-4">                    
          <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Edit Fees Group </h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('updateFeesGroup', $editFeesGroup->id) }}">
                    @csrf
                      <div class="row">						
                        <div class="col-md-12">
                            <div class="form-group">
								<h5>Fees Group Name <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="groupName" value="{{ $editFeesGroup->groupName }}"class="form-control" required> </div>								
							</div>
                        </div>
                      </div>                      
						<div class="text-xs-right">
							<input type="submit" value="Update Fees Group" class="btn  btn-info">
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
          </div>

			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Fees Group List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>S/No</th>
								<th> <a href="">Fees Group Name</a></th>								
								<th >Action</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($feesGroup as $key => $feeGroup)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $feeGroup->groupName }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('editFeesGroup', $feeGroup->id) }}">Edit</a>
                                    <a class="btn btn-danger" href="{{ route('deleteFeesGroup', $feeGroup->id) }}" id="delete">Delete</a>
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