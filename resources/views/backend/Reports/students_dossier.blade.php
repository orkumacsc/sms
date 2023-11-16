@extends('admin.admin_master')

@section('mainContent')

<style media="print">
    * {
        color: black !important;               
    }

    table, th, td {
        border: 1.5px solid black !important;
        
    }
    th, td {
        padding: .4em !important;
    }

     
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
        margin-bottom: 25px;               
    }
    .main-footer, .box-header, .hidebox {display:none;}
    
</style>
<style>  
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
        writing-mode: vertical-rl;
    }
</style>


<div class="content-wrapper">
	  <div class="container-full">
	  	<section class="content">		  
            <div class="box ">                 
                <div class="box-header with-border">
                    <h4 class="box-title">Students' Report Card</h4>			  
                    <div class="text-right">
                        <a href="{{ route('payfees') }}" class="btn btn-info">Back</a>
                        <a href="javascript:window.print()" class="btn btn-info">print</a>
                    </div>
                </div>
				<div class="box-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <img src="{{ url('backend/images/school_logo.png') }}" >
                        </div>
                        <div class="col-sm-8 text-center">
                            <h1>GOSPEL INTERNATIONAL COLLEGE</h1>
                            <h4>ZAKI-BIAM, UKUM LGA, BENUE STATE, NIGERIA</h4>
                            <h5>Tel: 08030661324, 08140326189, 07030271476</h5>
                            <h5>Email: gospelcollege2019@gmail.com;  website: gospelschools.sch.ng</h5>
                            <h5 class="mt-30 line"><strong><u>TERMINAL CONTINUOUS ASSESSMENT REPORT | @if(strpos($class->classname, 'BASIC') !== false || strpos($class->classname, 'JSS') !== false) JUNIOR SECONDARY SCHOOL  @else SENIOR SECONDARY SCHOOL @endif </u></strong></h5>
                        </div>
                        <div class="col-sm-2">
                            <img src="{{ url('backend/images/Coat_of_arms_of_Nigeria.png') }}" >
                        </div>
                    </div>                    
                    <div class="row mt-10">
                        <div class="col-sm-4">
                            <table>
                                <tr>
                                    <th colspan="2" class="text-center">
                                        <h4>{{ $studentDetails->surname }}, {{ $studentDetails->firstname }} {{ $studentDetails->middlename }}</h4>
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
                                    <td>{{ \Carbon\Carbon::parse($studentDetails->date_of_birth)->format('d M., Y') }}</td>
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
                                    <td rowspan="8" class="text-center"><img src="{{ (!empty($studentDetails->passport))? url('storage/'.$studentDetails->passport) : url('storage/profile-photos/default.png') }}" ></td>
                                                                       
                                </tr>                               
                                <tr>
                                    <th>CLASS</th>
                                    <td>{{ $class->classname }}</td>
                                </tr>
                                <tr>
                                    <th>TERM</th>
                                    <td>{{ $term->name }}</td>
                                </tr>
                                <tr>
                                    <th>SESSION</th>
                                    <td>{{ $session->name }}</td>                                  
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
                                        $spanum = count($cassType);
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
                                    @foreach($cassType as $CASS)                                        
                                    <td class="vertical">{{ $CASS->name }}</td>
                                    @endforeach                                                                 
                                </tr>
                                <tr>                                    
                                    @foreach($cassType as $CASS)
                                    <td>{{ $CASS->percentage }}</td>
                                    @endforeach   
                                    <td>100</td>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($Scores as $Subject => $Subject_scores)
                                    <tr>
                                        @foreach($Subjects as $resultS)
                                        @if($resultS->id == $Subject)                               
                                        <th>{{ $resultS->name }}</th>
                                        @endif
                                        @endforeach
                                        @foreach($Subject_scores as $key => $Scores)                                       
                                        @if($Scores->subject_id == $Subject)
                                        <td>{{ $Scores->scores }}</td>
                                        @endif
                                        @endforeach
                                        @foreach($scoreSum as $resultDetails)
                                        @if($resultDetails->subject_id == $Subject)
                                        <td>{{ $resultDetails->total_scores }}</td>
                                        <td>100</td>
                                        <td>{{ $resultDetails->class_highest }}</td>
                                        <td>{{ $resultDetails->class_lowest }}</td>
                                        <td>{{ $resultDetails->subject_position }}</td>
                                        @switch($resultDetails->total_scores)
                                            @case($resultDetails->total_scores >=75)
                                                <td>A</td>
                                                <td>EXCELENT</td>
                                                @break 
                                            @case($resultDetails->total_scores >=65)
                                            <td>B</td>
                                            <td>VERY GOOD</td>
                                            @break    
                                            @case($resultDetails->total_scores >=55)
                                                <td>C</td>
                                                <td>GOOD</td>
                                                @break 
                                            @case($resultDetails->total_scores >=40)
                                            <td>D</td>
                                            <td>FAIR</td>
                                            @break
                                            
                                            @default
                                            <td>E</td>
                                            <td>FAIL</td>
                                        @endswitch
                                        @endif
                                        @endforeach
                                                                           
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
                                    <td>{{ $Results->total_subjects_offered }}</td>
                                </tr>
                                <tr>
                                    <th>TOTAL MARKS OBTAINABLE</th>
                                    <td>{{ $Results->obtainable_marks }}</td>
                                </tr>
                                <tr>
                                    <th>TOTAL MARKS OBTAINED</th>
                                    <td>{{ $Results->obtained_marks }}</td>
                                </tr>
                                <tr>
                                    <th>AVERAGE</th>
                                    <td>{{ $Results->average }}</td>
                                </tr>
                                <tr>
                                    <th>POSITION Out Of CLASS SIZE</th>
                                    <td>{{ $Results->class_position }} out Of 50</td>
                                </tr>
                                <tr>
                                    <th>CLASS AVERAGE</th>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <th>PERFORMANCE REMARK (PASS/FAIL)</th>
                                    
                                    @switch($Results->average)
                                            @case($Results->average >=75)
                                                <td>A - PASS</td>
                                                
                                                @break 
                                            @case($Results->average >=65)
                                            <td> - PASS</td>
                                            
                                            @break    
                                            @case($Results->average >=55)
                                                <td>C - PASS</td>
                                                
                                                @break 
                                            @case($Results->average >=40)
                                            <td>D - PASS</td>
                                            
                                            @break
                                            
                                            @default
                                            <td>E - FAIL</td>                                            
                                        @endswitch
                                    
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
                                    
                                    <td class="text-right">ATSEV, TERTSEA GODWIN</td>                                    
                                </tr>
                                <tr>
                                    <th>Principal's Remark</th>
                                    
                                    <td class="text-right">BAMIGBOYE, OLANREWAJU TIMOTHY</td>
                                </tr>
                                <tr>                                    
                                    <th colspan="2"><p class="text-right">Sign Date: 19 - Dec - 2022</p> Next Term Begins: 09 - Jan - 2023 </th>
                                </tr>                                
                            </table>
                        </div>                        
                    </div>
                </div>
			</div>
		</section>
	  </div>
  </div>

@endsection