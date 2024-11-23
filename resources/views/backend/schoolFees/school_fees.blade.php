@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
		
		<!-- Main content -->
		<section class="content">            
		  <div class="row"> 
				<!-- School Fees Discount Modal -->
				<div class="modal fade" id="feesDiscountForm" tabindex="-1" role="dialog" aria-labelledby="feesDiscountModel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content box">
							<div class="modal-header bg-secondary">
								<h5 class="modal-title" id="feesDiscountModal">School Fees Payment</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="close">
									<span aria-hidden="tru">&times;</span>
								</button>
								</div>
								<div class="modal-body box-body">
									<!-- School Fees Discount -->
									<form method="post" action="{{ route('storefeespay') }}">
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
												<div class="form-group">												
													<div class="controls">										
														<input type="number" hidden name="fees_id" id="fees_id" value="" class="form-control">
													</div>								
												</div>
											</div>
										</div>
											<!-- /row -->

											<!-- row -->
											<div class="row">
											<div class="col-md-12">
												<div class="form-group" hidden id="show">
													<h5>Enter Amount <span class="text-danger">*</span></h5>
													<div class="controls">										
														<input type="number" name="amount_paid" id="discount_amount" placeholder="&#8358;2000" class="form-control">
													</div>								
												</div>
											</div>
										</div>
										<!-- End row -->

										
										<div class="row">
											<div class="col-6 text-center">
												<div class="form-group">
													<div class="controls">
														<input type="submit" value="Make Full Payment" class="btn  btn-info" hidden id="fullPay">
													</div>
												</div>
											</div>
											
											<div class="col-6 text-center">
												<div class="form-group">
													<div class="controls">
														<input type="submit" value="Make Part Payment" class="btn  btn-info" hidden id="partPay">
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
									Pay Fees
								</button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
							<table id="example" class="table table-bordered">
								<thead>
									<tr>
										<th>S/No</th>
										<th> <a href="">Academic Session</a></th>
										<th> <a href="">Term</a></th>
										<th> <a href="">Class</a></th>
										<th> <a href="">Admission No</a></th>										
										<th> <a href="">Student(s) Name</a></th>											
										<th> <a href="">School Fees</a></th>
										<th> <a href="">Fee Discount</a></th>										
										<th> <a href="">Expected Amount</a></th>																	
										<th> <a href="">Amount Paid</a></th>
										<th> <a href="">Payment Ref</a></th>
										<th> <a href="">Receipt No</a></th>
										<th> <a href="">Date Paid</a></th>
										<th>Action</th>
									</tr>
								</thead>
								
								<tbody>
									@foreach($SchoolFees as $key => $SchoolFee)
																			
									<tr>
										<td>{{ $key+1 }}</td>
										<td>{{ $SchoolFee->session }}</td>
										<td>{{ $SchoolFee->term }}</td>	
										<td>{{ $SchoolFee->classname }}</td>
										<td>{{ $SchoolFee->admission_no }}</td>
										<td><a href="{{ route('show_fees_receipt', $SchoolFee->student_id) }}">{{ $SchoolFee->surname }}, {{ $SchoolFee->firstname }} {{ $SchoolFee->middlename }}</a></td>										
										<td>&#8358;{{ $SchoolFee->total_fee_amount }}</td>
										<td>&#8358;{{ $SchoolFee->fee_discount }}</td>																																
										<td>&#8358;{{ ($SchoolFee->total_fee_amount - $SchoolFee->fee_discount ) }}</td>
										<td>&#8358;{{ $SchoolFee->amount_paid }}</td>									
										<td>{{ $SchoolFee->payment_ref }}</td>
										<td>{{ $SchoolFee->receipt_no }}</td>
										<td>{{ \Carbon\Carbon::parse($SchoolFee->payment_date)->format('D, d M, Y') }}</td>
										
										<td>
											<ul class="nav navbar-nav">
											<li class="dropdown user user-menu">
												<button class="waves-effect waves-light  dropdown-toggle btn btn-dark" data-toggle="dropdown" title="More">More</button>													
												<ul class="dropdown-menu animated flipInX">
												<li class="More-body">
													<a class="dropdown-item" href="{{ route('edit_fees_type', $SchoolFee->id) }}"><i class="ti-user text-muted mr-2"></i> Edit</a>														
													<div class="dropdown-divider"></div>
													<a class="dropdown-item" href="{{ route('delete_fees_type', $SchoolFee->id) }}" id="delete"><i class="ti-lock text-muted mr-2"></i> Delete</a>
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
                    $('#student_id').append('<option value="'+Student.students_id+'">'+Student.surname+', '+Student.firstname+' '+(Student.middlename ? Student.middlename : '')+'</option>');
					
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
					totalFee = (response[0].fee_amount + response[1].fee_amount + response[2].fee_amount);
					append = '<ul>'+'<li>'+ 'School Fees: &#8358;'+response[0].fee_amount+'</li>'+'<li>'+ 'Science Fee: &#8358;'+response[2].fee_amount+'<li>'+ 'Exam Fee: &#8358;'+response[1].fee_amount+'</li>'+'<li>'+'Total Amount: &#8358;' +totalFee+'</li>'+'</ul>'
				} else {
					totalFee = (response[0].fee_amount + response[1].fee_amount);
					append = '<ul>'+'<li>'+ 'School Fees: &#8358;'+response[0].fee_amount+'</li>'+'<li>'+ 'Exam Fee: &#8358;'+response[1].fee_amount+'</li>'+'<li>'+'Total Amount: &#8358;' +totalFee+'</li>'+'</ul>'

					
				}

                $('#add').append(append);
				$('#add').append('<p>Click Make Full Payment to make full payment or Enter amount below and click Make Part Payment to make part payment.</p>')
				$('#fullPay').removeAttr('hidden');
				$('#total_fee_amount').attr("value", totalFee);
				$('#fees_id').attr('value', response[0].id);
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
	if($('#partPay').attr('hidden')){
		$('#discount_amount').focus(() => {
		$('#partPay').removeAttr('hidden');
		$('#fullPay').attr('hidden');
	});
	} else {
		$('#discount_amount').focus(() => {
		$('#partPay').attr('hidden', true);
	});
	}
})
</script>

@endsection