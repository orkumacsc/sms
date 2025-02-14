@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">		
		<!-- Main content -->
		<section class="content"> 
			<!-- row -->			
			<div class="row">
				<!-- Academic Session Modal -->
				<div class="modal fade" id="academisSessionForm" tabindex="-1" role="document" aria-labelledby="academisSessionModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content box">
							<form method="post" action="{{ route('store_academic_session') }}">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title" id="academisSessionModal">Create New Academic Session</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="tru">&times;</span>
									</button>
								</div>
								<div class="modal-body box-body my-10">
									<div class="row">						
										<div class="col-md-12">
											<div class="form-group">
												<h5>Academic Session <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="academic_session" class="form-control" required> 
												</div>								
											</div>
										</div>										
									</div>			
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
									<input type="submit" value="Save Academic Session" class="btn  btn-info">
								</div>
							</form>							
						</div>
					</div>
				</div>			
				<!-- /Academic Session Modal -->

				<!-- School Terms Modal -->
				<div class="modal fade" id="SchoolTerm" tabindex="-1" role="document" aria-labelledby="SchoolTermModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content box">
							<form method="post" action="{{ route('store_school_term') }}">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title" id="SchoolTermModal">Create New Term</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="tru">&times;</span>
									</button>
								</div>
								<div class="modal-body box-body my-10">
									<div class="row">						
										<div class="col-md-12">
											<div class="form-group">
												<h5>Term Name<span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="name" class="form-control" required> 
												</div>								
											</div>
										</div>										
									</div>			
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
									<input type="submit" value="Save Term" class="btn  btn-info">
								</div>
							</form>							
						</div>
					</div>
				</div>			
				<!-- /School Terms Modal -->

				<!-- Current Academic Season Modal -->
				<div class="modal fade" id="currentAcademicSeason" tabindex="-1" role="document" aria-labelledby="currentAcademicSeasonModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
						<div class="modal-content box">
							<form method="post" action="{{ route('store_term_configurations') }}">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title" id="currentAcademicSeasonModal">Create New Term</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="tru">&times;</span>
									</button>
								</div>
								<div class="modal-body box-body my-10">
								<div class="row">						
										<div class="col-md-12">
											<div class="form-group">
												<h5>Academic Session<span class="text-danger">*</span></h5>
												<div class="controls">
													<select name="session_id" class="form-control" required>
														<option value="">Select Academic Session</option>
														@foreach ($academic_sessions as $academic_session)
															<option value="{{ $academic_session->id }}">{{ $academic_session->name }}</option>
														@endforeach
													</select>
												</div>								
											</div>
										</div>										
									</div>
									<div class="row">						
										<div class="col-lg-3">
											<div class="form-group">
												<h5>School Term<span class="text-danger">*</span></h5>
												<div class="controls">
												<select name="term_id" class="form-control" required>
														<option value="">Select School Term</option>
														@foreach ($school_terms as $school_term)
															<option value="{{ $school_term->id }}">{{ $school_term->name }}</option>
														@endforeach
													</select>
												</div>								
											</div>
										</div>	

										<div class="col-lg-3">
											<div class="form-group">
												<h5>Term Start Date<span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="date " name="term_start" class="form-control" required> 
												</div>								
											</div>
										</div>			
										<div class="col-lg-3">
											<div class="form-group">
												<h5>Term End Date<span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="date" name="term_end" class="form-control" required> 
												</div>								
											</div>
										</div>		
										<div class="col-lg-3">
											<div class="form-group">
												<h5>Next Term Start Date<span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="date" name="next_term_start" class="form-control" required> 
												</div>								
											</div>
										</div>										
									</div>			
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i class="ti-arrow-left"> Cancel</i></button>
									<input type="submit" value="Submit" class="btn  btn-info">
								</div>
							</form>							
						</div>
					</div>
				</div>			
				<!-- /Current Academic Season Modal -->

				<div class="col-xl-8">				
					<div class="nav-tabs-custom box-profile">
						<!-- tabs-navigation -->
						<ul class="nav nav-tabs">
							<li><a class="active" href="#academic_session" data-toggle="tab">Academic Sessions</a></li>				  
							<li><a href="#term_definitions" data-toggle="tab">Terms Definitions</a></li>
							<li><a href="#current_academic_season" data-toggle="tab">Current Academic Season</a></li>
						</ul>
						<!-- /tabs-navigation -->

						<!-- tab-content -->
						<div class="tab-content">
							<!-- academic session -->					
							<div class="active tab-pane bg-transparent" id="academic_session">
								<div class="box pt-30 pb-30 px-20">
								<div class="row">						  
									<div class="col-sm-12">
										<h4>AVAILABLE ACADEMIC SESSIONS</h4>
										<div class="text-right">
											<button type="button" class="btn btn-info" data-toggle="modal" data-target="#academisSessionForm">
												Create Academic Session
											</button>
										</div>
										<hr />
										<div class="table-responsive">
											<table class="table table-bordered table-striped">
												<thead>
													<tr>														
														<th>Academic Session</a></th>
														<th>Status</th>								
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													@foreach($academic_sessions as $key => $academic_session)
													<tr>														
														<td>{{ $academic_session->name }} Academic Session</td>
														<td class="{{ $academic_session->active_status == 1 ? 'text-success' : '' }}"> 
															<i class="{{ $academic_session->active_status == 1 ? 'ti-check-box' : ''}}"></i> 
															{{ $academic_session->active_status == 1 ? 'Active Academic Session' : ' -- / --' }} </td>
														<td>
															<a class="dropdown-item text-success" href="{{ route('set_current_session', $academic_session->id) }}">
																<i class="mr-2 ti-check"></i> Set Current Academic Session
															</a>	
															<a class="dropdown-item text-warning" href="javascript:void(0)">
																<i class="mr-2 ti-check"></i> Edit Academic Session
															</a>															
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>							
									</div>
								</div>
								<!-- /.row -->
								</div>										
							</div>
							<!-- /academic session -->

							<!-- term definitions -->											
							<div class="tab-pane" id="term_definitions">
								<div class="box pt-30 pb-30 px-20">
								<div class="row">						  
									<div class="col-xl-8">
										<h4>AVAILABLE TERMS</h4>
										<div class="text-right">
											<button type="button" class="btn btn-info" data-toggle="modal" data-target="#SchoolTerm">
												Create School Terms
											</button>
										</div>
										<hr />
										<div class="table-responsive">
											<table class="table table-bordered table-striped">
												<thead>
													<tr>														
														<th>Term Name</a></th>								
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													@foreach($school_terms as $school_term)
													<tr>														
														<td>{{ $school_term->name }}</td>
														<td>
															<a class="dropdown-item text-warning" href="javascript:void(0)">
																<i class="mr-2 ti-check"></i> Edit School Term
															</a>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>							
									</div>
								</div>
								<!-- /.row -->
								</div>										
							</div>						
							<!-- /term definitions -->

							<!-- term definitions -->											
							<div class="tab-pane" id="current_academic_season">
								<div class="box pt-30 pb-30 px-20">
									<div class="row">						  
										<div class="col-sm-12">
											<h4>CURRENT ACADEMIC SESSEION</h4>
											<div class="text-right">
												<button type="button" class="btn btn-info" data-toggle="modal" data-target="#currentAcademicSeason">
													Set Current Session & Term
												</button>
											</div>
											<hr />
											
											@foreach($academic_seasons as $academic_sessions => $academic_season)
											<h4 class="text-muted">{{ Active_Session()->name == $academic_sessions ? 'Current Academic Session' : ''}}</h4>	
											<h5>{{ $academic_sessions }} Academic Session</h5>
												<div class="table-responsive">
													<table class="table table-bordered table-striped">
														<thead>
															<tr>
																<th>Term</th>
																<th>Time Frame</th>
																<th>Status</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>														
															@foreach ($academic_season as $school_term)																									
																<tr>
																	<td>{{ $school_term->term_name }}</td>
																	<td>{{ $school_term->term_start }} - {{ $school_term->term_end }}</td>
																	<td class="{{ $school_term->active_status == 1 ? 'text-success' : ''}}"> <i class="{{ $school_term->active_status == 1 ? 'ti-check-box' : ''}}"></i> {{ $school_term->active_status == 1 ? 'Current Term' : '-- / --' }}</td>
																	<td>
																		<a class="dropdown-item text-success" href="{{ route('set_current_term', $school_term->academic_id) }}"><i class="mr-2 ti-check"></i> Set as Current Term</a>
																	</td>
																</tr>
															@endforeach
															
														</tbody>
													</table>
												</div>
											@endforeach					
										</div>
									</div>
								<!-- /.row -->
								</div>										
							</div>						
							<!-- /term definitions -->
						</div>
						<!-- /academic session tab-content -->

						
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