@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
            

		  <div class="row mt-0"> 

			<div class="col-12">

			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title"></h3>               
           
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="" class="table table-bordered nowrap">
						<thead>
							<tr>
								<div class="row">                
								<div class="col-sm-12 text-center p-0 m-0">                                        
									<h3> ACADEMIC SESSION</h3>
									<div class="row mt-10">
										<div class="col-sm-4"><h4>CLASS: {{ $SchoolClasses->classname }} {{ $class_arms->arm_name}} </h4></div>
										<div class="col-sm-8 "><h4>SUBJECT: {{ $subject->subject_name }} </h4></div>                        
									</div>
								</div>
								</div>
							</tr>
							<tr>
								<th>S/No</th>
								<th>Admission No</th>
								<th>Full Name</th>
								@foreach($Assessments as $key => $Ass)
								@if($Ass->class_id == $SchoolClasses->id)                            
									<th>{{ $Ass->name }} ({{ $Ass->percentage }})</th>
								@endif
								@endforeach									
							</tr>
						</thead>
						<form action="{{ route('store_scores') }}">
							@csrf
							<tbody>
								@foreach($Students as $key => $Student)                            
									<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $Student->admission_no }}</td>
									<td>{{ $Student->surname.', '.$Student->firstname.' '.$Student->middlename }}</td>
									@foreach ($CASS_Scores as $scores )	
									@php
										dd($score);
									@endphp			 
										<td>
											@foreach ($scores as $score )
												@if ($score->student_id == $Student->id)
													<input type="number" name="scores[{{ $Student->id }}][{{ $score->id }}]" style="width: 100%;" class="form-control" value="{{ $score->scores }}">													
												@endif						
											@endforeach
										</td>
									@endforeach
								</tr>                            
								@endforeach            			  
							</tbody> 
						</form>
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