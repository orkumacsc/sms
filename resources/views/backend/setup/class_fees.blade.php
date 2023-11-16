@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
        		
		<!-- Main content -->
		<section class="content">

		  <div class="row">			  
			<div class="col-12 col-lg-7 col-xl-12">
				
			  <div class="nav-tabs-custom box-profile">
				<ul class="nav nav-tabs">				  
				  <li><a class="active" href="#activity" data-toggle="tab">Class Fees</a></li>
				  <li><a href="#settings" data-toggle="tab">Assign Class Fees</a></li>
				</ul>

				<!-- /tab-pane -->
				<div class="tab-content">

				  <!-- tab-pane -->
					<div class="tab-pane" id="settings">				  		

						<div class="box p-15">		
							<form method="post" action="{{ route('store_class_fees') }}">
								@csrf

								<!-- row -->
								<div class="row">						
									<div class="col-md-6">
										<div class="form-group">
											<h5>Academic Session <span class="text-danger">*</span></h5>
											<div class="controls">										
												<select name="acad_id" id="acad_id" class="form-control">
													<option value="#">Select Academic Session</option>
													@foreach($AcadSession as $key => $acad)	
													<option value="{{$acad->id }}">{{$acad->name }}</option>
													@endforeach
												</select> 
											</div>								
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<h5>Term <span class="text-danger">*</span></h5>
											<div class="controls">										
												<select name="term_id" id="term_id" class="form-control">
													<option value="#">Select Term</option>
													@foreach($Terms as $key => $Term)	
													<option value="{{$Term->id }}">{{$Term->name }}</option>
													@endforeach
												</select> 
											</div>								
										</div>
									</div>
								</div>
								<!-- End row -->

								<!-- row -->
								<div class="row">						
									<div class="col-md-6">
										<div class="form-group">
											<h5>Fees Group <span class="text-danger">*</span></h5>
											<div class="controls">										
												<select name="fee_group_id" id="fee_group_id" class="form-control">
													<option value="#">Select Fees Group</option>
													@foreach($feesGroup as $key => $feeGroup)	
													<option value="{{$feeGroup->id }}">{{$feeGroup->groupName }}</option>
													@endforeach
												</select> 
											</div>								
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<h5>Fee Type <span class="text-danger">*</span></h5>
											<div class="controls">										
												<select name="fee_type_id" id="fee_type_id" class="form-control">
													<option value="#">Select Fees Type</option>
													@foreach($FeeTypes as $key => $FeeType)	
													<option value="{{$FeeType->id }}">{{$FeeType->name }}</option>
													@endforeach
												</select> 
											</div>								
										</div>
									</div>	
								</div>
								<!-- End row -->


								<!-- row -->
								<div class="row">						
									<div class="col-md-6">
										<div class="form-group">
											<h5>Class <span class="text-danger">*</span></h5>
											<div class="controls">										
												<select name="class_id" id="class_id" class="form-control">
													<option value="#">Select Class</option>
													@foreach($Classes as $key => $class)	
													<option value="{{$class->id }}">{{$class->classname }}</option>
													@endforeach
												</select> 
											</div>								
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<h5>Fee Amount <span class="text-danger">*</span></h5>
											<div class="controls">										
												<input type="number" name="fee_amount" class="form-control" data-validation-required-message="Fee Amount is required">
											</div>								
										</div>
									</div>	
								</div>
								<!-- End row -->
								
								<div class="text-left">
									<input type="submit" value="Assign Fee" class="btn  btn-info">
								</div>
							</form>
						</div>			  
					</div>
					<!-- /tab-pane -->

				  	<!-- tab-pane -->
					<div class="active tab-pane" id="activity">				  		

						<div class="box p-15">		
							<div class="box-header with-border">
								<h3 class="box-title">Class Fees</h3>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>S/No</th>
											<th> <a href="">Academic Session</a></th>
											<th> <a href="">Term</a></th>
											<th> <a href="">Class</a></th>											
											<th> <a href="">Fees Group</a></th>											
											<th> <a href="">Fees Type</a></th>	
											<th> <a href="">Fees Amount</a></th>															
											<th>Action</th>
										</tr>
									</thead>
									
									<tbody>
										@foreach($ClassFees as $key => $classFee)
																				
										<tr>
											<td>{{ $key+1 }}</td>
											<td>{{ $classFee->a_name }}</td>
											<td>{{ $classFee->term_name }}</td>	
											<td>{{ $classFee->classname }}</td>										
											<td>{{ $classFee->groupName }}</td>
											<td>{{ $classFee->fee_name }}</td>																						
											<td>&#8358;{{ $classFee->fee_amount }}</td>									
											
											<td>
												<ul class="nav navbar-nav">
												<li class="dropdown user user-menu">
													<button class="waves-effect waves-light  dropdown-toggle btn btn-dark" data-toggle="dropdown" title="More">More</button>													
													<ul class="dropdown-menu animated flipInX">
													<li class="More-body">
														<a class="dropdown-item" href="{{ route('edit_fees_type', $classFee->id) }}"><i class="ti-user text-muted mr-2"></i> Edit</a>														
														<div class="dropdown-divider"></div>
														<a class="dropdown-item" href="{{ route('delete_fees_type', $classFee->id) }}" id="delete"><i class="ti-lock text-muted mr-2"></i> Delete</a>
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
						<!-- /box -->

					</div>
					<!-- /tab-pane -->				

				</div>
				<!-- /.tab-content -->
				
			  </div>
			  <!-- /.nav-tabs-custom -->

			</div>			  
		  </div>
		  <!-- /.row -->

		</section>
		<!-- /.content -->
	  </div>
  </div>

@endsection