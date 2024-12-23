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
							<h3 class="box-title">BROADSHEET</h3>
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
													<h4>BROADSHEET FOR {{ $term->name }} {{ $academic_session->name}}
														ACADEMIC SESSION | CLASS: {{ $school_class->classname }}
														{{ $class_arm->arm_name }}
													</h4>
												</div>
											</div>
										</tr>
										<tr>
											<th>S/No</th>
											<th>Admission No</th>
											<th>Full Name</th>
											@foreach($subjects_in_class as $key => $subjects)

												<th class="vertical">{{ $subjects->subject_name }}</th>

											@endforeach
											<th class="vertical">TOTAL NO. OF SUBJECTS</th>
											<th class="vertical">OBTAINABLE MARKS</th>
											<th class="vertical">TOTAL MARKS OBTAINED</th>
											<th class="vertical">AVERAGE</th>
											<th class="vertical">POSITION</th>
										</tr>
									</thead>

									<tbody>
										@foreach($Students as $key => $Student)                            
											<tr>
												<td>{{ $key + 1 }}</td>
												<td>{{ $Student->admission_no }}</td>
												<td>{{ $Student->surname . ', ' . $Student->firstname . ' ' . $Student->middlename }}
												</td>

												@foreach ($subjects_in_class as $subjects)
													<td class="text-center">
														@foreach($subject_summary as $student_id => $students)
															@foreach ($students as $student)
																@if($student['student_id'] == $Student->id && $student['subject_id'] == $subjects->id)
																	{{ $student['total_scores'] }}
																@endif
															@endforeach
														@endforeach
													</td>
												@endforeach

												<td class="text-center">
													{{ count($subjects_in_class)}}
												</td>
												<td class="text-center">
													{{ count($subjects_in_class) * 100 }}
												</td>
												<td class="text-center">
													@foreach($computed_results as $id => $positions)
														@if($positions['student_id'] == $Student->id)
															{{ $positions['obtained_marks'] }}
														@endif
													@endforeach
												</td>
												<td class="text-center">
													@foreach($computed_results as $id => $positions)
														@if($positions['student_id'] == $Student->id)
															{{ $positions['average_score'] }}
														@endif
													@endforeach
												</td>
												<td class="text-center">
													@foreach($computed_results as $id => $positions)
														@if($positions['student_id'] == $Student->id)
															{{ suffix($positions['position_in_class']) }}
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