@extends('admin.admin_master')
@section('mainContent')
@section('title', 'Students Report Card')
<style>
    /* General Styles */
    table, th, td { 
        border: 1px solid gray; 
    }
    table { 
        width: 100%; 
    }
    th, td { 
        padding: .4em; 
    }
    .vertical { 
        writing-mode: vertical-lr;
        text-orientation: mixed;
    }

    /* Apply styles for print media */
    @print media{
            * { 
            color: black !important; 
        }
        table, th, td { 
            border: 1.5px solid black !important; 
        }
        th, td { 
            padding: .4em !important; 
        }
        @page: first { 
            margin-top: 0px; 
            margin-left: 0px; 
            margin-right: 0px; 
            margin-bottom: 20px; 
        }
        @page { 
            margin-top: 50px; 
            margin-left: 0px; 
            margin-right: 0px; 
            margin-bottom: 25px; 
        }
        .main-footer, .box-header, .hidebox, .btn { 
            display: none !important; 
        }
    }
</style>

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="box col-xxl-7 col-md-12 col-sm-12">
                <div class="box-header with-border">
                    <h4 class="box-title">Students' Report Card</h4>
                    <div class="text-right">
                        <a href="javascript:window.print()" class="btn btn-info">print</a>
                    </div>
                </div>
                @foreach($students as $student)
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <img src="{{ url('backend/images/school_logo.png') }}" alt="School Logo">
                        </div>
                        <div class="col-sm-8 text-center">
                            <h1>GOSPEL INTERNATIONAL COLLEGE</h1>
                            <h4>ZAKI-BIAM, UKUM LGA, BENUE STATE, NIGERIA</h4>
                            <h5>Tel: 08030661324, 08140326189, 07030271476</h5>
                            <h5>Email: gospelcollege2019@gmail.com; website: gospelschools.sch.ng</h5>
                            <h5 class="mt-30 line">
                                <strong>
                                    <u>
                                        TERMINAL CONTINUOUS ASSESSMENT REPORT |
                                        {{ (strpos($school_class->classname, 'BASIC') !== false || strpos($school_class->classname, 'JSS') !== false) ? 'JUNIOR SECONDARY SCHOOL' : 'SENIOR SECONDARY SCHOOL'}}
                                    </u>
                                </strong>
                            </h5>
                        </div>
                        <div class="col-sm-2">
                            <img src="{{ url('backend/images/Coat_of_arms_of_Nigeria.png') }}" alt="Coat of Arms">
                        </div>
                    </div>

                    <div class="row mt-10">
                        <div class="col-sm-4">
                            <table>
                                <tr>
                                    <th colspan="2" class="text-center">
                                        {{ $student['surname'] }}, {{ $student['firstname'] }} {{ $student['middlename'] ?? '' }}
                                    </th>                                    
                                </tr>                               
                                <tr>
                                    <th colspan="2" class="text-center">PERSONAL DATA</th>
                                </tr>
                                <tr>
                                    <th scope="row">GENDER</th>
                                    <td>{{ $student['gendername'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">ADMISSION NO</th>
                                    <td>{{ $student['admission_no'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">DATE OF BIRTH</th>
                                    <td>{{ \Carbon\Carbon::parse($student['date_of_birth'])->format('d M., Y') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">HOUSE</th>
                                    <td>{{ $student['name'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">CLUB/SOCIETY</th>
                                    <td>{{ $student['club'] ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-sm-8">
                            <table>
                                <tr>
                                    <th colspan="2" class="text-center" scope="col">CLASS DATA</th>
                                    <td rowspan="8" class="text-center">
                                        <img src="{{ (!empty($student['passport'])) ? url('storage/' . $student['passport']) : asset('backend/images/passport.png') }}" width="150" height="200" alt="Passport">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">CLASS</th>
                                    <td>{{ $school_class->classname }} {{ $class_arm->arm_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">TERM</th>
                                    <td>{{ $term->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">SESSION</th>
                                    <td>{{ $academic_session->name }} ACADEMIC SESSION</td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center" scope="col">ATTENDANCE SUMMARY</th>
                                </tr>
                                <tr>
                                    <th scope="row">No of Times School Opened</th>
                                    <td>{{ $student['attendance']['opened'] ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">No of Times Present</th>
                                    <td>{{ $student['attendance']['present'] ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">No of Times Absent</th>
                                    <td>{{ $student['attendance']['absent'] ?? 0 }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-10">
                        <div class="col-sm-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col" rowspan="">COGNITIVE DOMAIN</th>
                                        <th class="text-center" colspan="{{ count($assessments) }}" scope="col">SUMMARY OF C.A. SCORES</th>
                                        <th class="vertical" rowspan="2" scope="col">TERM TOTAL</th>
                                        <th class="vertical" rowspan="3" scope="col">CLASS AVERAGE</th>
                                        <th class="vertical" rowspan="3" scope="col">CLASS HIGHEST</th>
                                        <th class="vertical" rowspan="3" scope="col">CLASS LOWEST</th>
                                        <th class="vertical" rowspan="3" scope="col">SUBJECT POSITION</th>
                                        <th class="vertical" rowspan="3" scope="col">GRADE</th>
                                        <th class="vertical" rowspan="3" scope="col">GRADE REMARKS</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2" scope="col">SUBJECTS</th>
                                        @foreach($assessments as $cass)
                                            <th class="text-center" scope="col">{{ $cass['name'] }}</th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach($assessments as $cass)
                                            <th class="text-center" scope="col">{{ $cass['percentage'] }}%</th>
                                        @endforeach
                                        <th class="text-center" scope="col">100%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects_in_class as $subject)
                                        <tr>
                                            <td>{{ $subject['subject_name']}}</td>
                                            @foreach ($assessments as $cass)
                                                <td class="text-center">
                                                    @php
                                                        $score = $students_cass[$student['id']][$subject['id']][$cass['id']]['scores'] ?? null;
                                                    @endphp
                                                    {{ ($score !== null && $score > 0) ? $score : '-' }}
                                                </td>
                                            @endforeach
                                            @php
                                                $summary = $subject_summary[$student['id']][$subject['id']] ?? null;
                                            @endphp
                                            <td class="text-center">{{ isset($summary['total_scores']) && $summary['total_scores'] > 0 ? $summary['total_scores'] : '-' }}</td>
                                            <td class="text-center">{{ $summary['class_average'] ?? '-' }}</td>
                                            <td class="text-center">{{ $summary['class_highest'] ?? '-' }}</td>
                                            <td class="text-center">{{ $summary['class_lowest'] ?? '-' }}</td>
                                            <td class="text-center">{{ isset($summary['subject_position']) ? suffix($summary['subject_position']) : '-' }}</td>
                                            <td class="text-center">
                                                @if(!empty($summary['total_scores']) && $summary['total_scores'] > 0)
                                                    {{ gradeOrRemark($summary['total_scores']) }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if(!empty($summary['total_scores']) && $summary['total_scores'] > 0)
                                                    {{ gradeOrRemark($summary['total_scores'], true, false) }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-10">
                        <div class="col-sm-5">
                            <table>
                                <tr>
                                    <th colspan="2" class="text-center" scope="col">PERFORMANCE SUMMARY</th>
                                </tr>
                                @php
                                    $student_result = $computed_results[$student['id']] ?? null;
                                @endphp
                                @if($student_result)
                                    <tr>
                                        <th scope="row">TOTAL SUBJECTS OFFERED</th>
                                        <td>{{ $student_result['total_subjects_offered'] ?? count($subjects_in_class) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">TOTAL MARKS OBTAINABLE</th>
                                        <td>{{ $student_result['obtainable_marks'] ?? (count($subjects_in_class) * 100) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">TOTAL MARKS OBTAINED</th>
                                        <td>{{ $student_result['obtained_marks'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">AVERAGE</th>
                                        <td>{{ $student_result['average_score'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">POSITION Out Of CLASS SIZE</th>
                                        <td>
                                            {{ isset($student_result['position_in_class']) ? suffix($student_result['position_in_class']) : '-' }}
                                            out Of {{ count($computed_results) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">CLASS AVERAGE</th>
                                        <td>{{ $class_average ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">PERFORMANCE REMARK (PASSED/FAILED)</th>
                                        <td>
                                            {{ isset($student_result['average_score']) && $student_result['average_score'] > 0 ? gradeOrRemark($student_result['average_score'],false,true) : 'FAILED' }}
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-sm-3">
                            <table>
                                <tr>
                                    <th colspan="2" class="text-center" scope="col">GRADE ANALYSIS</th>
                                </tr>
                                <tr>
                                    <th scope="col">GRADE</th>
                                    <th scope="col">NO</th>
                                </tr>
                                @foreach(['A','B','C','D','E'] as $grade)
                                    <tr>
                                        <th scope="row">{{ $grade }}</th>
                                        <td>{{ $grade_analysis[$student['id']][$grade] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th scope="row">TOTAL</th>
                                    <td>{{ array_sum($grade_analysis[$student['id']] ?? []) }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <table>
                                <tr>
                                    <th colspan="3" class="text-center" scope="col">GRADE SCALE</th>
                                </tr>
                                <tr class="text-center">
                                    <th scope="col">GRADE</th>
                                    <th scope="col">RANGE</th>
                                    <th scope="col">REMARK</th>
                                </tr>
                                <tr>
                                    <th scope="row">A</th>
                                    <td>75 - 100</td>
                                    <td>EXCELLENT</td>
                                </tr>
                                <tr>
                                    <th scope="row">B</th>
                                    <td>65 - 74.9</td>
                                    <td>VERY GOOD</td>
                                </tr>
                                <tr>
                                    <th scope="row">C</th>
                                    <td>55 - 64.9</td>
                                    <td>GOOD</td>
                                </tr>
                                <tr>
                                    <th scope="row">D</th>
                                    <td>40 - 54.9</td>
                                    <td>FAIR</td>
                                </tr>
                                <tr>
                                    <th scope="row">E</th>
                                    <td>0 - 39.9</td>
                                    <td>FAIL</td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-center">Micodesoft Nigeria &copy; 2023</th>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-10">
                        <div class="col-sm-12">
                            <table>
                                <tr>
                                    <th scope="row">Form Master/Mistress Remark</th>
                                    <td class="text-right">{{ $student['form_master_remark'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Principal's Remark</th>
                                    <td class="text-right">BAMIGBOYE, OLANREWAJU TIMOTHY</td>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <p class="text-right">Sign Date: {{ \Carbon\Carbon::parse($term_end)->format('d M., Y') }}</p>
                                        Next Term Begins: {{ \Carbon\Carbon::parse($next_term_start)->format('d M., Y')  }}
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>

@endsection