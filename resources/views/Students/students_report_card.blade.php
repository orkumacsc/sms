<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('backend/images/favicon.ico') }}">

    <title>GOSPEL INTERNATIONAL COLLEGE, ZAKI-BIAM | Check Result </title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/print_styles.css') }}">

    <style media="print">
        * {
            color: black !important;
        }

        table,
        th,
        td {
            border: 1.5px solid black !important;
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

        
        .box,
        .content,
        .table-responsive,
        .box-boday {
            margin: 0;
            padding: 0;
            overflow: hidden;
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
</head>

<body class="hold-transition dark-skin theme-primary" oncontextmenu="return false" onkeydown="return false">
    <div class="container h-100">
        <section class="content ">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Students' Report Card</h4>
                    <div class="text-right">
                        <a href="javascript:window.print()" class="btn btn-info">print</a>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row ">
                        <div class="col-sm-2">
                            <img src="{{ url('backend/images/school_logo.png') }}" width="100%">
                        </div>
                        <div class="col-sm-8 text-center">
                            <h2>GOSPEL INTERNATIONAL COLLEGE</h2>
                            <h4>ZAKI-BIAM, UKUM LGA, BENUE STATE, NIGERIA</h4>
                            <h5>Tel: 08030661324, 08140326189, 07030271476</h5>
                            <h5>Email: gospelcollege2019@gmail.com; website: gospelschools.sch.ng</h5>
                        </div>
                        <div class="col-sm-2">
                            <img src="{{ url('backend/images/Coat_of_arms_of_Nigeria.png') }}" width="100%">
                        </div>
                    </div>
                    <h5 class="text-center">
                        <strong>
                            <u>TERMINAL CONTINUOUS ASSESSMENT REPORT |
                                {{ (strpos($school_class->classname, 'BASIC') !== false || strpos($school_class->classname, 'JSS') !== false) ? 'JUNIOR SECONDARY SCHOOL' : 'SENIOR SECONDARY SCHOOL'}}
                            </u>
                        </strong>
                    </h5>
                    <div class="table-responsive">
                        <div class="row mt-10">
                            <div class="col-sm-4">
                                <table id="">
                                    <tr>
                                        <th colspan="2" class="text-center">
                                            <h4>{{ $students->surname }}, {{ $students->firstname }}
                                                {{ $students->middlename}}
                                            </h4>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-center">PERSONAL DATA</th>
                                    </tr>
                                    <tr>
                                        <th>GENDER</th>
                                        <td>{{ $students->gendername }}</td>
                                    </tr>
                                    <tr>
                                        <th>ADMISSION NO</th>
                                        <td>{{ $students->admission_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>DATE OF BIRTH</th>
                                        <td>{{ \Carbon\Carbon::parse($students->date_of_birth)->format('d M., Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>HOUSE</th>
                                        <td>{{ $students->name }}</td>
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
                                                src="{{ (!empty($studentDetails->passport)) ? url('storage/' . $studentDetails->passport) : asset('backend/images/passport.png') }}" width="150" height="200">
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
                                                        @foreach ($students_cass as $subject_scores)
                                                            @if($subject_scores['subject_id'] == $subject->id)
                                                                @if ($subject_scores['cass_type'] == $CASS->id)
                                                                    {{$subject_scores['scores']}}
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach

                                                <td class="text-center">
                                                    @foreach ($subject_summary as $student_subjects)
                                                        @if($student_subjects['subject_id'] == $subject->id)
                                                            {{ $student_subjects['total_scores']}}
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>

                                                <td class="text-center">
                                                    @foreach ($subject_summary as $student_subjects)
                                                        @if($student_subjects['subject_id'] == $subject->id)
                                                            {{ suffix($student_subjects['subject_position'])}}
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td class="text-center">
                                                    @foreach ($subject_summary as $student_subjects)
                                                        @if($student_subjects['subject_id'] == $subject->id)
                                                            {{$student_subjects['total_scores'] > 0 ? gradeOrRemark($student_subjects['total_scores'], false) : 'F'}}
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td class="text-center">
                                                    @foreach ($subject_summary as $student_subjects)
                                                        @if($student_subjects['subject_id'] == $subject->id)
                                                            {{$student_subjects['total_scores'] > 0 ? gradeOrRemark($student_subjects['total_scores'], false, false) : 'FAIL'}}
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
                            <div class="col-sm-7">
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
                                            {{$computed_results['obtained_marks']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>AVERAGE</th>
                                        <td>
                                            {{$computed_results['average_score']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>POSITION Out Of CLASS SIZE</th>
                                        <td>
                                            {{ suffix($computed_results['position_in_class'])}}
                                            out Of {{ $class_size }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>CLASS AVERAGE</th>
                                        <td>
                                            {{ $class_average }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>PERFORMANCE REMARK (PASSED/FAILED)</th>
                                        <td>
                                            {{ $computed_results['average_score'] > 0 ? gradeOrRemark($computed_results['average_score']) : 'FAILED'}}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="col-sm-5">
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
                </div>
            </div>
        </section>
    </div>

    <!-- Vendor JS -->
    <script src="{{ asset('backend/js/vendors.min.js') }}"></script>
    <script src="{{ asset('../assets/icons/feather-icons/feather.min.js')}}"></script>

</body>

</html>