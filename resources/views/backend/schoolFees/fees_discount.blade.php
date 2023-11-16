@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
		
		<!-- Main content -->
		<section class="content">            
		  <div class="row"> 
				<!-- School Fees Discount Modal -->
				<div class="modal fade" id="feesDiscountForm" tabindex="-1" role="dialog" aria-labelledby="feesDiscountModel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content box">
							<div class="modal-header">
								<h5 class="modal-title" id="feesDiscountModal">School Fees Discount</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="close">
									<span aria-hidden="tru">&times;</span>
								</button>
								</div>
								<div class="modal-body box-body">
									<!-- School Fees Discount -->
									<form method="post" action="{{ route('storefeesdiscount') }}">
											@csrf
											
										<!-- row -->
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<h5>Class <span class="text-danger">*</span></h5>
													<div class="controls">										
														<select name="class_id" id="clas_id" class="form-control">
															<option value="#">Select Class</option>
															@foreach($Classes as $key => $class)	
															<option value="{{ $class->id }}">{{$class->classname }}</option>
															@endforeach
														</select> 
													</div>								
												</div>
											</div>
										</div>
											<!-- /row -->

											<!-- row -->
										<div class="row">			
											<div class="col-md-12">
												<div class="form-group">
													<h5>Student's Name <span class="text-danger">*</span></h5>
													<div class="controls">										
														<select name="student_id" id="student_id" class="form-control">
															
														</select> 
													</div>								
												</div>
											</div>
										</div>								
										<!-- End row -->

										<!-- row -->
										<div class="row">
											<div class="col-md-12" id="add">
												<div class="form-group" hidden id="show">												
													<div class="controls">										
														
													</div>								
												</div>
											</div>
										</div>
											<!-- /row -->

											<!-- row -->
											<div class="row">
											<div class="col-md-12">
												<div class="form-group">												
													<div class="controls">										
														<input type="number" hidden name="total_fee_amount" id="total_fee_amount" class="form-control">
													</div>								
												</div>
											</div>
										</div>
											<!-- /row -->

											<!-- row -->
											<div class="row">
											<div class="col-md-12">
												<div class="form-group" hidden id="show">
													<h5>Discount Amount <span class="text-danger">*</span></h5>
													<div class="controls">										
														<input type="number" name="discount_amount" id="discount_amount" placeholder="&#8358;2000" class="form-control">
													</div>								
												</div>
											</div>
										</div>
										<!-- End row -->

										
										<div class="row">
											<div class="col-12 text-center">
												<div class="form-group">
													<div class="controls">
														<input type="submit" value="Discount Fees" class="btn  btn-info" hidden id="showBtn">
													</div>
												</div>
											</div>
											
										</div>
									</form>
									<!-- /School Fees Discount -->
								</div>						
							</div>
						</div>
					</div>
				</div>	
				<!-- /School Fees Discount Modal -->		

				<div class="col-12">
					<div class="box">		
						<div class="box-header with-border">
							
								<h3 class="box-title">School Fees Discounts</h3>
							
							<div class="text-right">
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#feesDiscountForm">
									Give Discount
								</button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
							<table id="" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>S/No</th>
										<th> <a href="">Academic Session</a></th>
										<th> <a href="">Term</a></th>
										<th> <a href="">Class</a></th>											
										<th> <a href="">Student(s) Name</a></th>											
										<th> <a href="">School Fees</a></th>	
										<th> <a href="">Discounts</a></th>
										<th> <a href="">Payable Amount</a></th>											
										<th>Action</th>
									</tr>
								</thead>
								
								<tbody>
									@foreach($feesDiscount as $key => $feeDiscount)
																			
									<tr>
										<td>{{ $key+1 }}</td>
										<td>{{ $feeDiscount->a_name }}</td>
										<td>{{ $feeDiscount->term_name }}</td>	
										<td>{{ $feeDiscount->classname }}</td>
										<td>{{ $feeDiscount->surname }}, {{ $feeDiscount->firstname }} {{ $feeDiscount->middlename }}</td>										
										<td>&#8358;{{ $feeDiscount->total_fee_amount }}</td>
										<td>&#8358;{{ $feeDiscount->discount_amount }}</td>																						
										<td>&#8358;{{ ($feeDiscount->total_fee_amount - $feeDiscount->discount_amount ) }}</td>									
										
										<td>
											<ul class="nav navbar-nav">
											<li class="dropdown user user-menu">
												<button class="waves-effect waves-light  dropdown-toggle btn btn-dark" data-toggle="dropdown" title="More">More</button>													
												<ul class="dropdown-menu animated flipInX">
												<li class="More-body">
													<a class="dropdown-item" href="{{ route('edit_fees_type', $feeDiscount->id) }}"><i class="ti-user text-muted mr-2"></i> Edit</a>														
													<div class="dropdown-divider"></div>
													<a class="dropdown-item" href="{{ route('delete_fees_type', $feeDiscount->id) }}" id="delete"><i class="ti-lock text-muted mr-2"></i> Delete</a>
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
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>


<script>
	$(document).ready(() => {
		$('#clas_id').change(() => {

			let id = clas_id.value;
			let url = '/GetStudent/'+id;	

			$.ajax({
				url: url,
				method: 'GET',
				data: {},
				dataType: 'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success: function(response){
					$('#student_id').empty();
					response.forEach(Student => {						
						$('#student_id').append('<option value="'+Student.id+'">'+Student.surname+', '+Student.firstname+' '+Student.middlename+'</option>');
						
					});
				},
				error: function(response){

				}

			});
		});
	});


	$(document).ready(() => {
		$('#student_id').change(() => {
			let stu_id = clas_id.value;
			let url = '/FeesDue/' +stu_id;
			$.ajax({
				url: url,
				method: 'GET',
				data: {},
				dataType: 'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success: function(response){
					$('#add').empty();
					let totalFee;
					let append;
					
					let rearray = response;
					if(rearray.length === 3) {
						totalFee = response[0].fee_amount + response[1].fee_amount + response[2].fee_amount;
						append = '<ul>'+'<li>'+ 'School Fees: &#8358;'+response[0].fee_amount+'</li>'+'<li>'+ 'Science Fee: &#8358;'+response[2].fee_amount+'<li>'+ 'Exam Fee: &#8358;'+response[1].fee_amount+'</li>'+'<li>'+'Total Amount: &#8358;' +totalFee+'</li>'+'</ul>'
					} else {
						totalFee = response[0].fee_amount + response[1].fee_amount;
						append = '<ul>'+'<li>'+ 'School Fees: &#8358;'+response[0].fee_amount+'</li>'+'<li>'+ 'Exam Fee: &#8358;'+response[1].fee_amount+'</li>'+'<li>'+'Total Amount: &#8358;' +totalFee+'</li>'+'</ul>'
						
					}

					$('#add').append(append);

					$('#total_fee_amount').attr("value", totalFee);
					if(response === null){					
						$('#show').attr('hidden');
					} else {
						$('#show').removeAttr('hidden');
					}
				},
				error: function(response){

				}

			});
		});
	});

	$(document).ready(() => {
		if($('#showBtn').attr('hidden')){
			$('#discount_amount').focus(() => {
			$('#showBtn').removeAttr('hidden');
		});
		} else {
			$('#discount_amount').focus(() => {
			$('#showBtn').attr('hidden');
		});
		}
	})
</script>

@endsection