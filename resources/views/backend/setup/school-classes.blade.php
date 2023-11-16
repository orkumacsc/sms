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
			  <h4 class="box-title">Add Classes</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('school-class.store') }}">
                    @csrf
                    <div class="row">						
                        <div class="col-md-12">
                            <div class="form-group">
								<h5>Class <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="class" class="form-control" required> </div>								
							</div>
							
                            <div class="form-group">
								<h5>Session <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="session" class="form-control">
										@foreach($sessions as $key => $session)
										<option value="{{$session->id }}">
											{{$session->name}}
										</option>
										@endforeach
									</select>
								</div>
                        	</div>
                      	</div>                      
						<div class="text-xs-right">
							<input type="submit" value="Add" class="btn  btn-info">
						</div>
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
				  <h3 class="box-title">Class List</h3>
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
                            @foreach($allData as $key => $schoolclass)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $schoolclass->classname }}</td>
                                <td>
                                    <a class="btn btn-info" href="">Edit</a>
                                    <a class="btn btn-danger" href="">Delete</a>
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