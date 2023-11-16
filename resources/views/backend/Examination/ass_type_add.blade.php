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
			  <h4 class="box-title">Add Assessment Types</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('store_assessment_type') }}">
                    @csrf
                      <div class="row">						
                        <div class="col-md-12">
                            <div class="form-group">
								<h5>Assessment Type <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="name" class="form-control" required> </div>								
							</div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
								<h5>Percentage<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="number" name="percentage" class="form-control" required> </div>								
							</div>
                        </div>
                      </div>                      
						<div class="text-xs-right">
							<input type="submit" value="Add" class="btn  btn-info">
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
					  <table class="table table-bordered">
						<thead>
							<tr>
								<th>S/No</th>
								<th>Assessments</th>
                                <th>Total Score</th>								
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($assTypes as $key => $assType)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $assType->name }}</td>
                                <td>{{ $assType->percentage }}</td>
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