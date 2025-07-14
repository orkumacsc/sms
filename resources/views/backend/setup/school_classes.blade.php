@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
		
		<!-- Main content -->
		<section class="content">            
		  <div class="row">
				<!-- Add New Class Modal -->
				<div class="modal fade" id="feesDiscountForm" tabindex="-1" role="document" aria-labelledby="feesDiscountModel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content box">
							<form method="post" action="{{ route('save_school_class') }}">
								@csrf
								<div class="modal-header bg-info">
									<h5 class="modal-title" id="feesDiscountModal">Add New Class</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="tru">&times;</span>
									</button>
								</div>
								<div class="modal-body box-body">
									<div class="row">						
										<div class="col-md-12">
											<div class="form-group">
												<h5>Class <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="class" class="form-control" required> 
												</div>								
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
									</div>					
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
									<input type="submit" value="Save Class" class="btn  btn-info">
								</div>
							</form>								
						</div>
					</div>
				</div>			
				<!-- /Add New Class Modal -->

			<div class="col-sm-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">List of Classes</h3>
				  	<div class="text-right">
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#feesDiscountForm">
							Add New Class
						</button>
					</div>
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
									<ul class="nav navbar-nav">
										<li class="dropdown user user-menu">	
											<a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown" title="View Actions">
												<i class="ti-menu-alt"></i>
											</a>
											<ul class="dropdown-menu animated flipInX">
												<li class="user-body">
													<a class="dropdown-item text-success" href="{{ route('class_profile',$schoolclass->id) }}" onclick=""><i class="mr-2 ti-eye"></i> Enter Class</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item text-warning" href=""><i class="mr-2 mdi mdi-pencil-box-outline"></i> Edit Class</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item text-danger" href=""><i class="mr-2 mdi mdi-delete"></i> Delete Class</a>
												</li>
											</ul>
										</li>			  
									</ul> 									                           
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