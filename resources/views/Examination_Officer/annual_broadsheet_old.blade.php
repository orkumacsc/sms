@extends('admin.admin_master')

@section('mainContent')

<style media="print">
	
	html, body {
		width: 297mm;
		height: 420mm;
	}

	@page: first {
		size: landscape !important;		
		margin-top: 0px;
		margin-left: 0px;
		margin-right: 0px;
		margin-bottom: 20px;
	}

	@page {
		size: landscape !important;		
		margin-top: 50px;
		margin-left: 0px;
		margin-right: 0px;
		margin-bottom: 25px;
	}

	* {
		color: black !important;
	}

	.main-footer,
	.box-header,
	.hidebox ,
	.box-header {
		display: none;
	}

	.box,
        .content,
        .table-responsive,
        .box-boday {
            margin: 0;
            padding: 0;
           overflow: hidden;
        }

	.table {
		font-size: 14px !important;
		padding: 0%;
		margin: 0px;
	}

	.table-responsive>.table tr th,
	.table-responsive>.table tr td {
		white-space: nowrap !important;
		padding: .5% !important;
		border-color: black !important;
	}

	h1,
	h2,
	h3,
	h4,
	h5,
	h6 {
		font-family: 'Times New Roman', Times, serif !important;
	}
</style>
<style>
	table,
	th,
	td {
		border: 1px solid gray;

	}

	table {
		width: 100%;
	}

	th,
	td {
		padding: .4em;
	}

	.vertical {
		writing-mode: vertical-rl;

	}
</style>

<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
			<div class="row mt-0">
				<div class="col-12">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">ANNUAL BROADSHEET</h3>
							<div class="text-right">
								<a href="javascript:window.print()" class="btn btn-info">print</a>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table id="" class="table table-bordered nowrap">
									<thead>
										<tr>
											<div class="row">
												<div class="col-sm-12 text-center p-0 m-0">
													<h1>GOSPEL INTERNATIONAL COLLEGE, ZAKI-BIAM</h1>
													<h4>ANNUAL BROADSHEET FOR {{ $academic_session->name}}
														ACADEMIC SESSION | CLASS: {{ $school_class->classname }}
														{{ $class_arm->arm_name }}
													</h4>
												</div>
											</div>
										</tr>
										@php
                                            $spanum = count($terms);
                                        @endphp
										<tr rowspan="2">
											<th rowspan="2">S/NO</th>
											<th rowspan="2">ADMISSION NO</th>
											<th rowspan="2">FULL NAME</th>											
											@foreach($subjects_in_class as $key => $subjects)

												<th colspan="{{ $spanum + 5}}" class="text-center">{{ $subjects['subject_name'] }}</th>

											@endforeach
											<th rowspan="2" class="vertical">TOTAL NO. OF SUBJECTS</th>
											<th rowspan="2" class="vertical">OBTAINABLE MARKS</th>
											<th rowspan="2" class="vertical">TOTAL MARKS OBTAINED</th>
											<th rowspan="2" class="vertical">AVERAGE</th>
											<th rowspan="2" class="vertical">POSITION</th>
											<th rowspan="2" class="vertical">GRADE</th>
											<th rowspan="2" class="vertical">REMARKS</th>
										</tr>
										<tr>
											@foreach($subjects_in_class as $key => $subjects)												
												@foreach($terms as $term)
													<th class="vertical">{{ $term->name }}</th>
												@endforeach

											<th rowspan="2" class="vertical">ANNUAL TOTAL</th>
                                            <th rowspan="2" class="vertical">ANNUAL AVERAGE</th>
                                            <th rowspan="3" class="vertical">ANNUAL CLASS AVERAGE</th>
                                            <th rowspan="3" class="vertical">ANNUAL CLASS HIGHEST</th>
                                            <th rowspan="3" class="vertical">ANNUAL CLASS LOWEST</th>
											@endforeach
										</tr>
									</thead>

									<tbody>
										@foreach($students as $key => $student)                            
											<tr>
												<td>{{ $key + 1 }}</td>
												<td>{{ $student['admission_no'] }}</td>
												<td>
													{{ "{$student['surname']}, {$student['firstname']} {$student['middlename']}" }}
												</td>											

												@foreach ($subjects_in_class as $subjects)
													@foreach ($terms as $term )
														<td class="text-center">
															@foreach($subject_summary as $student_id => $students_scores)
																@foreach ($students_scores as $student_score)
																	@if($student_id == $student['id'] && $student_score['subject_id'] == $subjects->id)																		
																		@if($student_score['term_id'] == $term->id)
																			{{ $student_score['total_scores'] }}
																		@endif
																	@endif
																@endforeach
															@endforeach
														</td>
													@endforeach

													<td>
														@foreach ($annual_subjects_summary as $students_id => $subject_combined_scores)														
															@foreach ($subject_combined_scores as $subjects_id => $combined_score )
																@if($students_id == $student['id'] && $subjects_id == $subjects->id)
																	{{ $combined_score }}
																@endif
															@endforeach														
                                                   		@endforeach
													</td>

													<td>
														@foreach ($annual_subject_average as $students_id => $subject_combined_scores)														
															@foreach ($subject_combined_scores as $subjects_id => $combined_score )
																@if($students_id == $student['id'] && $subjects_id == $subjects->id)
																	{{ $combined_score }}
																@endif
															@endforeach														
                                                   		@endforeach
													</td>
													@foreach ($annual_subject_high_low as $subject_id => $subjects_high_low)
														@if($subject_id == $subjects->id)
															@foreach ($subjects_high_low as $key => $high_low)
																<td class="text-center">{{ $high_low }}</td>
															@endforeach
														@endif
													@endforeach												 
													
												@endforeach

												
												@foreach ($computed_results as $student_id => $students_result )
													@if ($students_result['student_id'] == $student['id'])
														<td class="text-center">
															{{ $students_result['obtained_marks'] }}
														</td>
														<td class="text-center">
															{{ $students_result['total_subjects_offered'] }}
														</td>
														<td class="text-center">
															{{ $students_result['obtainable_marks'] }}
														</td>
														<td class="text-center">
															{{ $students_result['average_score'] }}
														</td>
														<td class="text-center">
															{{ suffix($students_result['position_in_class']) }}
														</td>
														<td class="text-center">
															{{$students_result['average_score'] > 0 ? gradeOrRemark($students_result['average_score'], false) : 'F'}}
														</td>
														<td class="text-center">
															{{$students_result['average_score'] > 0 ? gradeOrRemark($students_result['average_score'], false, false) : 'FAIL'}}
														</td>
													@endif
												@endforeach

												
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