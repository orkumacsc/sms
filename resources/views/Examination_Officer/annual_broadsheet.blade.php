@extends('admin.admin_master')

@section('mainContent')

<style>
    /* General screen and print styles for A3 landscape */     
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;        
    }
    th, td {
        border: 1px solid #333;
        padding: 0.25em 0.5em;
        text-align: center;
        vertical-align: middle;
    }
    .vertical {
        writing-mode: vertical-rl;
        text-orientation: mixed;
        font-size: 12px;
    }
    caption {
        caption-side: top;
        text-align: center;
        margin-bottom: 10px;
    }   
    .btn, .box-header .btn {
        margin-bottom: 10px;
    }
    /* Hide print button in print */
    @media print {
        html, body {
            width: 420mm;
            min-height: 297mm;
        }
        @page {
            size: A3 landscape !important;
            margin: 20mm 10mm 20mm 10mm;
        }
        .main-footer, .box-header, .hidebox, .btn, .box-header .btn {
            display: none !important;
        }
        .content-wrapper, .container-full, .box, .box-body, .table-responsive {
            margin: 0;
            padding: 0;
            width: 100%;
            max-width: 420mm;
        }
        table {
            font-size: 12px;
        }
        th, td {
            border: 1px solid #000 !important;
            padding: 0.2em 0.4em !important;
        }
        .vertical {
            font-size: 10px;
        }

         h1, h2, h3, h4, h5, h6 {
        font-family: 'Times New Roman', Times, serif !important;
        margin: 0;
    }
}
</style>

<div class="content-wrapper">
    <div class="container-full">
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
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="">
                                    <caption class="text-center">
                                        <h1>GOSPEL INTERNATIONAL COLLEGE, ZAKI-BIAM</h1>
                                        <h4>
                                            ANNUAL BROADSHEET FOR {{ $academic_session->name }} ACADEMIC SESSION |
                                            CLASS: {{ $school_class->classname }} {{ $class_arm->arm_name }}
                                        </h4>
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th rowspan="2" scope="col">S/NO</th>
                                            <th rowspan="2" scope="col">ADMISSION NO</th>
                                            <th rowspan="2" scope="col">FULL NAME</th>
                                            @foreach($subjects_in_class as $subject)
                                                <th colspan="{{ count($terms) + 5 }}" class="text-center" scope="col">{{ $subject->subject_name }}</th>
                                            @endforeach
                                            <th rowspan="2" class="vertical" scope="col">TOTAL NO. OF SUBJECTS</th>
                                            <th rowspan="2" class="vertical" scope="col">OBTAINABLE MARKS</th>
                                            <th rowspan="2" class="vertical" scope="col">TOTAL MARKS OBTAINED</th>
                                            <th rowspan="2" class="vertical" scope="col">AVERAGE</th>
                                            <th rowspan="2" class="vertical" scope="col">POSITION</th>
                                            <th rowspan="2" class="vertical" scope="col">GRADE</th>
                                            <th rowspan="2" class="vertical" scope="col">REMARKS</th>
                                        </tr>
                                        <tr>
                                            @foreach($subjects_in_class as $subject)
                                                @foreach($terms as $term)
                                                    <th class="vertical" scope="col">{{ $term->name }}</th>
                                                @endforeach
                                                <th class="vertical" scope="col">ANNUAL TOTAL</th>
                                                <th class="vertical" scope="col">ANNUAL AVERAGE</th>
                                                <th class="vertical" scope="col">ANNUAL CLASS AVERAGE</th>
                                                <th class="vertical" scope="col">ANNUAL CLASS HIGHEST</th>
                                                <th class="vertical" scope="col">ANNUAL CLASS LOWEST</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $key => $student)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $student['admission_no'] }}</td>
                                                <td>{{ "{$student['surname']}, {$student['firstname']} {$student['middlename']}" }}</td>
                                                @foreach ($subjects_in_class as $subject)
                                                    @foreach ($terms as $term)
                                                        <td class="text-center">
                                                            {{ $subject_summary[$student['id']][$subject->id][$term->id] ?? '-' }}
                                                        </td>
                                                    @endforeach
                                                    <td class="text-center">
                                                        {{ $annual_subjects_summary[$student['id']][$subject->id] ?? '-' }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $annual_subject_average[$student['id']][$subject->id] ?? '-' }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $annual_subject_high_low[$subject->id]['average'] ?? '-' }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $annual_subject_high_low[$subject->id]['highest'] ?? '-' }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $annual_subject_high_low[$subject->id]['lowest'] ?? '-' }}
                                                    </td>
                                                @endforeach
                                                <td class="text-center">
                                                    {{ $computed_results[$student['id']]['total_subjects_offered'] ?? '-' }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $computed_results[$student['id']]['obtainable_marks'] ?? '-' }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $computed_results[$student['id']]['obtained_marks'] ?? '-' }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $computed_results[$student['id']]['average_score'] ?? '-' }}
                                                </td>
                                                <td class="text-center">
                                                    {{ isset($computed_results[$student['id']]['position_in_class']) ? suffix($computed_results[$student['id']]['position_in_class']) : '-' }}
                                                </td>
                                                <td class="text-center">
                                                    {{ isset($computed_results[$student['id']]['average_score']) && $computed_results[$student['id']]['average_score'] > 0 ? gradeOrRemark($computed_results[$student['id']]['average_score'], false) : 'F' }}
                                                </td>
                                                <td class="text-center">
                                                    {{ isset($computed_results[$student['id']]['average_score']) && $computed_results[$student['id']]['average_score'] > 0 ? gradeOrRemark($computed_results[$student['id']]['average_score'], false, false) : 'FAIL' }}
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