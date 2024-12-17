@extends('admin.admin_master')

@section('mainContent')

<style media="print">
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
		margin-bottom: 20px;
	}

	* {
		color: black !important;
	}

	.main-footer,
	.box-header {
		display: none;
	}

	.table {
		font-size: 12px !important;
		padding: 0%;
		margin: 0px;
	}

	.table-responsive>.table tr th,
	.table-responsive>.table tr td {
		white-space: nowrap !important;
		padding: .3% !important;
		border-color: black !important;
	}

	.box,
	.content,
	.table-responsive,
	.box-boday {
		margin: 0;
		padding: 0;
		overflow: hidden;
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

<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
			<div class="row mt-0">
				<div class="col-12">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">SUBJECT SUMMARY</h3>
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
													<!-- <h1>GOSPEL INTERNATIONAL COLLEGE, ZAKI-BIAM</h1> -->
													<h4>SUBJECT SUMMARY FOR {{ $academic_session->name}}
														ACADEMIC SESSION
													</h4>
													<h5>TERM: {{ $term->name }} | CLASS:
														{{ $school_class->classname }}
														{{ $class_arm->arm_name }} | SUBJECT:
														{{ $subject->subject_name }}
													</h5>
												</div>
											</div>
										</tr>
										<tr>
											<th>S/No</th>
											<th>Admission No</th>
											<th>Full Name</th>
											@foreach($Assessments as $key => $Ass)
												@if($Ass->class_id == $school_class->id)
													<th>{{ $Ass->name }} ({{ $Ass->percentage }})</th>
												@endif
											@endforeach
											<th>TOTAL (100)</th>
											<th>POSITION</th>
										</tr>
									</thead>
									<tbody>
										@foreach($Students as $key => $Student)                            
											<tr>
												<td>{{ $key + 1 }}</td>
												<td>{{ $Student->admission_no }}</td>
												<td>{{ $Student->surname . ', ' . $Student->firstname . ' ' . $Student->middlename }}
												</td>
												@foreach ($Assessments as $assessment)
													<td class="text-center">
														@foreach ($CASS_Scores as $scores)
															@foreach ($scores as $score)
																@if ($score->student_id == $Student->id && $score->cass_type == $assessment->id)
																	{{$score->scores}}
																@endif
															@endforeach
														@endforeach
													</td>
												@endforeach

												<td class="text-center">
													@foreach($Marks_Registers as $id => $Marks)
														@if($Marks->student_id == $Student->id)
															{{ $Marks->total_scores }}
														@endif
													@endforeach
												</td>
												<td class="text-center">
													@foreach($Marks_Registers as $id => $Marks)
														@if($Marks->student_id == $Student->id)
															{{ $Marks->subject_position }}
														@endif
													@endforeach
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