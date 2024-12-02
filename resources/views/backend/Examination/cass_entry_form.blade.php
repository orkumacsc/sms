@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
        <!-- Score Entry Request Form -->
        <section class="content">
          <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">CASS Scores Entry Request Form</h4>			  
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
            <div class="col">
              <form method="get" action="{{ route('cass_scores_form') }}">
                  <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Session<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <select name="s_id" id="s_id" required class="form-control p-10">
                                        <option value="">Select Session</option>                                        
                                            @foreach($SchoolSessions as $key => $Session)
                                            <option value="{{ $Session->id }}">{{ $Session->name }}</option> 
                                            @endforeach                                       
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Term<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <select name="term_id" id="term" required class="form-control p-10">
                                            <option value="">Select Term</option>
                                            @foreach($SchoolTerm as $key => $Term)
                                            <option value="{{ $Term->id }}">{{ $Term->name }}</option>
                                            @endforeach                                        
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Class<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <select name="class_id" id="clas_id" required class="form-control p-10">
                                            <option value="">Select Class</option>
                                            @foreach($SchoolClasses as $key => $Class)
                                            <option value="{{ $Class->id }}">{{ $Class->classname }}</option>
                                            @endforeach                                        
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">                            
                                
                           <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Arm<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <select name="arm_id" id="arm_id" required class="form-control p-10">
                                            <option value="">Select Arm</option>
                                            @foreach($ClassArms as $key => $Arm)
                                            <option value="{{ $Arm->id }}">{{ $Arm->arm_name }}</option>
                                            @endforeach                                        
                                        </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Subjects<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <select name="subject_id" id="subject_id" required class="form-control p-10">
                                            
                                        </select>
                                        </div>
                                    </div>
                                </div>
                  <div class="col-sm-4">
                    <div class="form-group">									
                      <div class="text-xs-right pt-25">
                        <input type="submit" value="Get CASS Entry Form" class="btn  btn-info">
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
        </section>
        <!-- /Score Entry Request Form -->

        <!-- CASS Scores entry form -->
        <section class="content">
                

          <div class="row mt-0"> 

          <div class="col-12">

            <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">CASS Scores Entry Form</h3>               
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="" class="table table-bordered nowrap">
                <thead>
                                <tr>
                                <div class="row">                
                    <div class="col-sm-12 text-center p-0 m-0">                                        
                        <h3>{{ Active_Term()->term_name }} {{ Active_Session()->name }} ACADEMIC SESSION</h3>
                        <div class="row mt-10">
                            <div class="col-sm-4"><h4>CLASS: {{ $Current_Class->classname }} {{ $Class_Arm->arm_name }}</h4></div>
                            <div class="col-sm-8 "><h4>SUBJECT: {{ $subject->subject_name }}</h4></div>                        
                        </div>
                    </div>
                </div>
                                </tr>
                  <tr>
                    <th>S/No</th>
                    <th>Admission No</th>
                    <th>Full Name</th>
                                    @foreach($Assessments as $key => $Ass)
                                        @if($Ass->class_id == $Current_Class->id)                            
                            <th>{{ $Ass->name }} ({{ $Ass->percentage }})</th>
                                        @endif
                                    @endforeach											
                  </tr>
                </thead>
                <form action="{{ route('store_scores') }}" method="post">
                  @csrf
                <tbody>
                @foreach($Students as $key => $Student)                            
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $Student->admission_no }}</td>
                    <td>{{ $Student->surname.', '.$Student->firstname.' '.$Student->middlename }}</td>
                    @foreach($Assessments as $key => $Ass)
                    @if($Ass->class_id == $Current_Class->id)                            
                    <td>
                      <input type="number" name="scores[{{ $Student->id }}][{{ $Ass->id }}]" style="width: 100%;" class="form-control">
                    </td>
                    @endif
                    @endforeach	                               							
                </tr>                            
                @endforeach
                <input type="hidden" name="current_term" value="{{ Active_Term()->term_id }}">
                <input type="hidden" name="current_session" value="{{ Active_Session()->id }}">
                <input type="hidden" name="class_id" value="{{ $Current_Class->id }}">
                <input type="hidden" name="subject" value="{{ $subject->id }}">
                <input type="hidden" name="class_arm_id" value="{{ $Class_Arm->id }}">

                <button type="submit" style="float: right;" class="btn btn-secondary">Submit</button>			  
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
        <!-- /CASS Scores entry form -->
	  </div>
</div>

<script src="{{ asset('backend/js/forms/CASS_entry.js') }}"></script>

@endsection