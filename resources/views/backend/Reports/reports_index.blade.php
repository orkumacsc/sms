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
        writing-mode: vertical-lr;
    }
</style>


<div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">
		  <div class="box hidebox">
			<div class="box-header with-border">
			  <h4 class="box-title">Students' Class Result</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="get" action="{{ route('class_result') }}">
					    <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5>Session<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="acad_session" id="s_id" required class="form-control p-10">
                                    <option value="">Select Session</option>                                        
                                        @foreach($SchoolSessions as $key => $Session)
                                        <option value="{{ $Session->id }}">{{ $Session->name }}</option> 
                                        @endforeach                                       
                                    </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <h5>Class<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="class_id" id="class_id" required class="form-control p-10">
                                        <option value="">Select Class</option>
                                        @foreach($SchoolClasses as $key => $Class)
                                        <option value="{{ $Class->id }}">{{ $Class->classname }}</option>
                                        @endforeach                                        
                                    </select>
                                    </div>
                                </div>
                            </div>                                        
                            
							<div class="col-sm-3">
                                <div class="form-group">
                                    <h5>Arm<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="arm_id" id="arm_id" required class="form-control p-10">
                                        <option value="">Select Arm</option>
                                        @foreach($ClassArms as $key => $Arm)
                                        <option value="{{ $Arm->id }}">{{ $Arm->name }}</option>
                                        @endforeach                                        
                                    </select>
                                    </div>
                                </div>
                            </div>

							<div class="col-sm-2">
								<div class="form-group">									
									<div class="text-xs-right pt-25">
										<input type="submit" value="Enter class" class="btn  btn-info">
									</div>
								</div>
							</div>
							
                        </div>                       
						
					</form>

				</div>
				<!-- /.col -->



			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>

          <div class="box ">  
                
                <div class="box-header with-border">
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
                            <h5 class="mt-30 line"><strong><u>TERMINAL CONTINUOUS ASSESSMENT REPORT | SENIOR SECONDARY SCHOOL</u></strong></h5>
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
                                        <h4>ORKUMA, MICHAEL MSUEGA</h4>
                                    </th>
                                                                                                          
                                </tr>
                                                                                            
                                <tr>
                                    <th colspan="2" class="text-center">PERSONAL DATA</th> 
                                </tr>
                                <tr>
                                    <th>GENDER</th>
                                    <td>Male</td>
                                </tr>
                                <tr>
                                    <th>ADMISSION NO</th>
                                    <td>GIC/BASIC7/22/914</td>
                                </tr>
                                <tr>
                                    <th>DATE OF BIRTH</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>HOUSE</th>
                                    <td>MOUNT HOREB | GREEN</td>
                                </tr>
                                <tr>
                                    <th>CLUB/SOCIETY</th>
                                    <td>JETS CLUB</td>
                                </tr>                                
                            </table>
                        </div>

                        <div class="col-sm-8">
                        <table>
                                <tr>
                                    <th colspan="2" class="text-center">
                                        CLASS DATA
                                    </th>
                                    <td rowspan="8" class="text-center"><img src="{{ url('backend/images/school_logo.png') }}" ></td>
                                                                       
                                </tr>                               
                                <tr>
                                    <th>CLASS</th>
                                    <td>SSS 1 COMMERCIAL C1</td>
                                </tr>
                                <tr>
                                    <th>TERM</th>
                                    <td>FIRST TERM</td>
                                </tr>
                                <tr>
                                    <th>SESSION</th>
                                    <td>2022/2023</td>                                  
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
                                    <th>COGNITIVE DOMAIN</th>
                                    <td colspan="5">SUMMARY OF C.A. SCORES</td>
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
                                    <td class="vertical">Test</td>
                                    <td class="vertical">ASS</td>
                                    <td class="vertical">Class Work</td>
                                    <td class="vertical">Test/Project</td>
                                    <td class="vertical">EXAM</td>                                    
                                </tr>
                                <tr>                                    
                                    <td>20</td>
                                    <td>15</td>
                                    <td>15</td>
                                    <td>10</td>
                                    <td>40</td>
                                    <td>100</td>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>ENGLISH LANGUAGE</th>
                                        <td>20</td>
                                        <td>15</td>
                                        <td>15</td>
                                        <td>10</td>
                                        <td>40</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>1st</td>
                                        <td>A</td>
                                        <td>EXCELENT</td>
                                    </tr>
                                    <tr>
                                        <th>GENERAL MATHEMATICS</th>
                                        <td>20</td>
                                        <td>15</td>
                                        <td>15</td>
                                        <td>10</td>
                                        <td>40</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>1st</td>
                                        <td>A</td>
                                        <td>EXCELENT</td>
                                    </tr>
                                    <tr>
                                        <th>CIVIC EDUCATION</th>
                                        <td>20</td>
                                        <td>15</td>
                                        <td>15</td>
                                        <td>10</td>
                                        <td>40</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>1st</td>
                                        <td>A</td>
                                        <td>EXCELENT</td>
                                    </tr>
                                    <tr>
                                        <th>ANIMAL HUSBANDRY</th>
                                        <td>20</td>
                                        <td>15</td>
                                        <td>15</td>
                                        <td>10</td>
                                        <td>40</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>1st</td>
                                        <td>A</td>
                                        <td>EXCELENT</td>
                                    </tr>
                                    <tr>
                                        <th>CHEMISTY</th>
                                        <td>20</td>
                                        <td>15</td>
                                        <td>15</td>
                                        <td>10</td>
                                        <td>40</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>1st</td>
                                        <td>A</td>
                                        <td>EXCELENT</td>
                                    </tr>
                                    <tr>
                                        <th>PHYSICS</th>
                                        <td>20</td>
                                        <td>15</td>
                                        <td>15</td>
                                        <td>10</td>
                                        <td>40</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>1st</td>
                                        <td>A</td>
                                        <td>EXCELENT</td>
                                    </tr>
                                    <tr>
                                        <th>BIOLOGY</th>
                                        <td>20</td>
                                        <td>15</td>
                                        <td>15</td>
                                        <td>10</td>
                                        <td>40</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>1st</td>
                                        <td>A</td>
                                        <td>EXCELENT</td>
                                    </tr>
                                    <tr>
                                        <th>GEOGRAPHY</th>
                                        <td>20</td>
                                        <td>15</td>
                                        <td>15</td>
                                        <td>10</td>
                                        <td>40</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>1st</td>
                                        <td>A</td>
                                        <td>EXCELENT</td>
                                    </tr>
                                    <tr>
                                        <th>ECONOMICS</th>
                                        <td>20</td>
                                        <td>15</td>
                                        <td>15</td>
                                        <td>10</td>
                                        <td>40</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>1st</td>
                                        <td>A</td>
                                        <td>EXCELENT</td>
                                    </tr>
                                    <tr>
                                        <th>COMPUTER STUDIES</th>
                                        <td>20</td>
                                        <td>15</td>
                                        <td>15</td>
                                        <td>10</td>
                                        <td>40</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>1st</td>
                                        <td>A</td>
                                        <td>EXCELENT</td>
                                    </tr>
                                    <tr>
                                        <th>GOVERNMENT</th>
                                        <td>20</td>
                                        <td>15</td>
                                        <td>15</td>
                                        <td>10</td>
                                        <td>40</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>1st</td>
                                        <td>A</td>
                                        <td>EXCELENT</td>
                                    </tr>
                                    <tr>
                                        <th>CHRISTIAN RELIGIOUS STUDIES</th>
                                        <td>20</td>
                                        <td>15</td>
                                        <td>15</td>
                                        <td>10</td>
                                        <td>40</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>1st</td>
                                        <td>A</td>
                                        <td>EXCELENT</td>
                                    </tr>
                                    
                                    
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
                                    <td>16</td>
                                </tr>
                                <tr>
                                    <th>TOTAL MARKS OBTAINABLE</th>
                                    <td>1600</td>
                                </tr>
                                <tr>
                                    <th>TOTAL MARKS OBTAINED</th>
                                    <td>1600</td>
                                </tr>
                                <tr>
                                    <th>AVERAGE</th>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <th>POSITION Out Of CLASS SIZE</th>
                                    <td>1st out Of 50</td>
                                </tr>
                                <tr>
                                    <th>CLASS AVERAGE</th>
                                    <td>58.65</td>
                                </tr>
                                <tr>
                                    <th>PERFORMANCE REMARK (PASS/FAIL)</th>
                                    <td>A - PASS</td>
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
                                    <td>16</td>
                                </tr>
                                <tr>
                                    <th>B</th>
                                    <td>1600</td>
                                </tr>
                                <tr>
                                    <th>C</th>
                                    <td>1600</td>
                                </tr>
                                <tr>
                                    <th>D</th>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <th>E</th>
                                    <td>1st out Of 50</td>
                                </tr>
                                <tr>
                                    <th>F</th>
                                    <td>58.65</td>
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
		</section>
	  </div>
  </div>

@endsection