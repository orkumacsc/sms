@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
      <section class="content">
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">View Student By Houses</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="get" action="{{ route('student_houses') }}">
                    
					<div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <h5>Houses<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="id" id="class" required class="form-control p-10">
                                        <option value="">Select House</option>
                                        @foreach($Houses as $key => $House)
                                        <option value="{{ $House->id }}">{{ $House->name }}</option>
                                        @endforeach                                        
                                    </select>
                                    </div>
                                </div>
                            </div>
							<div class="col-sm-4">
								<div class="form-group">									
									<div class="text-xs-right pt-25">
										<input type="submit" value="View Students" class="btn  btn-info">
									</div>
								</div>
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
		</section>
		<section class="content">

		  <div class="row"> 

			<div class="col-12">

			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">List of Students</h3>                  
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
						<thead>
							<tr>
								<th width="2%">S/No</th>
								<th>Admission No</th>
								<th>Full Name</th>
								<th>Gender</th>
								<th>Class</th>
								<th>House</th>								
							</tr>
						</thead>
						<tbody>
                            @foreach($Students as $key => $Student)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $Student->admission_no }}</td>
                                <td><a href="{{ route('user.view_profile',$Student->id) }}" class="text-success">{{ $Student->surname.', '.$Student->firstname.' '.$Student->middlename }}</a></td>
								<td>{{ $Student->gendername }}</td>
                                <td>{{ $Student->classname }}</td>
								<td>{{ $Student->name }}</td>								
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