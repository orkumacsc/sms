@extends('admin.admin_master')
@section('mainContent')

<style media="print">
    * {
        color: black !important;
    }

    table,
    th,
    td {
        border: 1.5px solid black !important;

    }

    th,
    td {
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

    .main-footer,
    .box-header,
    .hidebox {
        display: none;
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
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Students' Report Card</h4>
                    <div class="text-right">
                        <a href="javascript:window.print()" class="btn btn-info">print</a>
                    </div>
                </div>
                @foreach($students as $studentDetails)
                    <div class="box-body">
                        <div class="row ">
                            <div class="col-sm-2">
                                <img src="{{ url('backend/images/school_logo.png') }}">
                            </div>
                            <div class="col-sm-8 text-center">
                                <h1>GOSPEL INTERNATIONAL COLLEGE</h1>
                                <h4>ZAKI-BIAM, UKUM LGA, BENUE STATE, NIGERIA</h4>
                                <h5>Tel: 08030661324, 08140326189, 07030271476</h5>
                                <h5>Email: gospelcollege2019@gmail.com; website: gospelschools.sch.ng</h5>
                                <h5 class="mt-30 line"><strong><u>TERMINAL CONTINUOUS ASSESSMENT REPORT |
                                        {{ (strpos($school_class->classname, 'BASIC') !== false || strpos($school_class->classname, 'JSS') !== false) ?
                                            'JUNIOR SECONDARY SCHOOL' : 'SENIOR SECONDARY SCHOOL'}} </u></strong>
                                </h5>
                            </div>
                            <div class="col-sm-2">
                                <img src="{{ url('backend/images/Coat_of_arms_of_Nigeria.png') }}">
                            </div>
                        </div>

                        <div class="row mt-10">
                            <div class="col-sm-4">
                                <table id="">
                                    <tr>
                                        <th colspan="2" class="text-center">
                                            <h4>{{ $studentDetails->surname }}, {{ $studentDetails->firstname }}
                                                {{ $studentDetails->middlename}}
                                            </h4>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-center">PERSONAL DATA</th>
                                    </tr>
                                    <tr>
                                        <th>GENDER</th>
                                        <td>{{ $studentDetails->gendername }}</td>
                                    </tr>
                                    <tr>
                                        <th>ADMISSION NO</th>
                                        <td>{{ $studentDetails->admission_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>DATE OF BIRTH</th>
                                        <td>{{ \Carbon\Carbon::parse($studentDetails->date_of_birth)->format('d M., Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>HOUSE</th>
                                        <td>{{ $studentDetails->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>CLUB/SOCIETY</th>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-sm-8">
                                <table>
                                    <tr>
                                        <th colspan="2" class="text-center">
                                            CLASS DATA
                                        </th>
                                        <td rowspan="8" class="text-center"><img
                                                src="{{ (!empty($studentDetails->passport)) ? url('storage/' . $studentDetails->passport) : asset('backend/images/passport.png') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>CLASS</th>
                                        <td>{{ $school_class->classname }} {{ $class_arm->arm_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>TERM</th>
                                        <td>{{ $term->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>SESSION</th>
                                        <td>{{ $academic_session->name }} ACADEMIC SESSION</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-center">ATTENDANCE SUMMARY</th>
                                    </tr>
                                    <tr>
                                        <th>No of Times School Opened</th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>No of Times Present</th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>No of Times Absent</th>
                                        <td>0</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row mt-10">
                            <div class="col-sm-12">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="text-center">COGNITIVE DOMAIN</th>
                                            @php
                                                $spanum = count($assessments);
                                            @endphp
                                            <td colspan="{{ $spanum }}" class="text-center">SUMMARY OF C.A. SCORES</td>
                                            <td rowspan="2" class="vertical">TERM TOTAL</td>
                                            <td rowspan="3" class="vertical">CLASS AVERAGE</td>
                                            <td rowspan="3" class="vertical">CLASS HIGHEST</td>
                                            <td rowspan="3" class="vertical">CLASS LOWEST</td>
                                            <td rowspan="3" class="vertical">SUBJECT POSITION</td>
                                            <td rowspan="3" class="vertical">GRADE</td>
                                            <td rowspan="3" class="vertical">GRADE REMARKS</td>
                                        </tr>
                                        <tr rowspan="2">
                                            <th rowspan="2">SUBJECTS</th>
                                            @foreach($assessments as $CASS)
                                                <th class="text-center">{{ $CASS->name }}</th>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            @foreach($assessments as $CASS)
                                                <th class="text-center">{{ $CASS->percentage }}</th>
                                            @endforeach
                                            <td class="text-center">100</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subjects_in_class as $subject)
                                            <tr>
                                                <td>{{ $subject->subject_name}}</td>
                                                @foreach ($assessments as $CASS)
                                                    <td class="text-center">
                                                        @foreach ($students_cass as $subject_id => $subject_scores)
                                                            @if($subject_id == $subject->id)
                                                                @foreach($subject_scores as $subject_score)
                                                                    @if($subject_score->student_id == $studentDetails->id)
                                                                        @if($subject_score->cass_type == $CASS->id)
                                                                            {{$subject_score->scores}}
                                                                        @endif                                                                                    
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach

                                                <td class="text-center">
                                                    @foreach ($subject_summary as $subject_id => $student_subjects)
                                                        @if($subject_id == $subject->id)
                                                            @foreach ($student_subjects as $subject_total)
                                                                @if($subject_total->student_id == $studentDetails->id)
                                                                    {{ $subject_total->total_scores}}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>

                                                <td class="text-center">
                                                    @foreach ($subject_summary as $subject_id => $student_subjects)
                                                        @if($subject_id == $subject->id)
                                                            @foreach ($student_subjects as $subject_total)
                                                                @if($subject_total->student_id == $studentDetails->id)
                                                                    {{ suffix($subject_total->subject_position)}}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td class="text-center">
                                                    @foreach ($subject_summary as $subject_id => $student_subjects)
                                                        @if($subject_id == $subject->id)
                                                            @foreach ($student_subjects as $subject_total)
                                                                @if($subject_total->student_id == $studentDetails->id)
                                                                    {{$subject_total->total_scores > 0 ? grade_remarks($subject_total->total_scores, false) : 'F'}}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td class="text-center">
                                                    @foreach ($subject_summary as $subject_id => $student_subjects)
                                                        @if($subject_id == $subject->id)
                                                            @foreach ($student_subjects as $subject_total)
                                                                @if($subject_total->student_id == $studentDetails->id)
                                                                    {{$subject_total->total_scores > 0 ? grade_remarks($subject_total->total_scores, false, false) : 'FAIL'}}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
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
                                        <th colspan="2" class="text-center">PERFORMANCE SUMMARY</th>
                                    </tr>

                                    <tr>
                                        <th>TOTAL SUBJECTS OFFERED</th>
                                        <td>
                                            {{count($subjects_in_class)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>TOTAL MARKS OBTAINABLE</th>
                                        <td>
                                            {{count($subjects_in_class) * 100}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>TOTAL MARKS OBTAINED</th>
                                        <td>
                                            @foreach($computed_results as $student_result)
                                                @if($student_result->student_id == $studentDetails->id)
                                                    {{ $student_result->obtained_marks}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>AVERAGE</th>
                                        <td>
                                            @foreach($computed_results as $student_result)
                                                @if($student_result->student_id == $studentDetails->id)
                                                    {{ $student_result->average_score}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>POSITION Out Of CLASS SIZE</th>
                                        <td>
                                            @foreach($computed_results as $student_result)
                                                @if($student_result->student_id == $studentDetails->id)
                                                    {{ suffix($student_result->position_in_class)}}
                                                @endif
                                            @endforeach
                                            out Of 50
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>CLASS AVERAGE</th>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>PERFORMANCE REMARK (PASSED/FAILED)</th>
                                        <td>
                                            @foreach($computed_results as $student_result)
                                                @if($student_result->student_id == $studentDetails->id)
                                                    {{ $student_result->average > 0 ? grade_remarks($student_result->average_score) : 'FAILED'}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-3">
                                <table>
                                    <tr>
                                        <th colspan="2" class="text-center">GRADE ANALYSIS</th>
                                    </tr>
                                    <tr>
                                        <th>GRADE</th>
                                        <th>NO</th>
                                    </tr>
                                    <tr>
                                        <th>A</th>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <th>B</th>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <th>C</th>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <th>D</th>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <th>E</th>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <th>F</th>
                                        <td>-</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-4">
                                <table>
                                    <tr>
                                        <th colspan="3" class="text-center">GRADE SCALE</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>GRADE</th>
                                        <th>RANGE</th>
                                        <th>REMARK</th>
                                    </tr>
                                    <tr>
                                        <th>A</th>
                                        <td>75 - 100</td>
                                        <td>EXCELENT</td>
                                    </tr>
                                    <tr>
                                        <th>B</th>
                                        <td>65 - 74.9</td>
                                        <td>VERY GOOD</td>
                                    </tr>
                                    <tr>
                                        <th>C</th>
                                        <td>55 - 64.9</td>
                                        <td>GOOD</td>
                                    </tr>
                                    <tr>
                                        <th>D</th>
                                        <td>40 - 54.9</td>
                                        <td>FAIR</td>
                                    </tr>
                                    <tr>
                                        <th>E</th>
                                        <td>0 - 39.9</td>
                                        <td>FAIL</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-center">Micodesoft Nigeria &copy 2023</th>

                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row mt-10">
                            <div class="col-sm-12">
                                <table>
                                    <tr>
                                        <th>Form Master/Mistress Remark</th>
                                        <td class="text-right"></td>
                                    </tr>
                                    <tr>
                                        <th>Principal's Remark</th>
                                        <td class="text-right">BAMIGBOYE, OLANREWAJU TIMOTHY</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">
                                            <p class="text-right">Sign Date:
                                                {{ \Carbon\Carbon::parse(Active_Term()->term_end)->format('d M., Y') }}
                                            </p>
                                            Next Term Begins:
                                            {{ \Carbon\Carbon::parse(Active_Term()->next_term_start)->format('d M., Y')  }}
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