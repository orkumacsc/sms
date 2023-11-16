@extends('admin.admin_master')

@section('mainContent')

<style media="print">
    @page:first{        
        margin-top: 0px;
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 20px;               
    }

    @page{        
        margin-top: 50px;
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 50px;               
    }
	* {
		color: black !important;
	}
	table, tr, td{
        border: 2px solid black !important;
        
    }
    .main-footer{display:none;}
</style>

<div class="content-wrapper">
	  <div class="container-full">
        		
		<!-- Main content -->
		<section class="content">

			<div class="box">

				<div class="box-body">
					
					<div class="row">
						@foreach($Students as $key => $student)
						<div class="col-6 mb-15 pr-20">

							<div class="row">
								<div class="col-sm-2 m-0 p-0">
									<img src="{{ url('backend/images/school_logo.png') }}" >
								</div>
								<div class="col-sm-10 text-center m-0 p-0">
									<h5>GOSPEL INTERNATIONAL COLLEGE, ZAKI-BIAM</h5>
									<h6>ZAKI-BIAM, UKUM LGA, BENUE STATE, NIGERIA</h6>
									<h5>{{ $Current_term->name }} {{ $Current_sessions->name }} ACADEMIC SESSION</h5>
								</div>
							</div>
							<div class="row m-0">								
								<div class="col-sm-12 text-center">
									<h5 class="">EXAMINATION PERMIT</h5>																		
								</div>
							</div>
							<div class="row">				
								<div class="col-sm-12">
								<table class="table table-bordered">										
										<tbody>
											<tr class="text-center" style="padding:2%">
												<th colspan="2">{{ $student->surname.', '.$student->firstname.' '.$student->middlename }}</th>
												<td rowspan="5" style="width:30%">
												<img src="{{ url('storage/'.$student->passport) }}" >
												</td>												
											</tr>
											<tr>
												<th>ADMISSION NO</th>
												<td>{{ $student->admission_no }}</td>
																								
											</tr>
											<tr>
												<th>CLASS</th>
												<td>{{ $student->classname }}</td>
																								
											</tr>
											<tr>
												<th>SEX</th>
												<td>{{ $student->gendername }}</td>
											</tr>
											<tr>
												<th>SERIAL NO</th>
												<td>{{ $key + 1 }}</td>
											</tr>											
										</tbody>
									</table>
								</div>

							</div>
							
							<div class="row">								
								<div class="col-sm-6 text-center">
									<hr />									
									<h5>PRINCIPAL'S SIGN/DATE</h5>																		
								</div>
								<div class="col-sm-6 text-center">
									<hr />									
									<h5>DEAN'S SIGN/DATE</h5>																		
								</div>
							</div>
						</div>
						@endforeach
					</div>
		<!-- Row End -->
				</div>

			</div>

		</section>
		<!-- /.content -->
	  </div>
  </div>

@endsection