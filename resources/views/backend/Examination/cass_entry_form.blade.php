@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
        <!-- CASS Scores entry form -->
        <section class="content">
          <div class="row mt-0"> 
            <div class="col-12">

              <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Upload Continuous Assessment</h3> 
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
                        <input type="number" name="scores[{{ $Student->id }}][{{ $Ass->id }}]" style="width: 100%;" class="form-control" max="{{$Ass->percentage}}">
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
                  </tbody> 
              
                <tfoot>
                  <tr>
                      <th colspan="{{ count($Assessments) + 3 }}"><button type="submit" style="float: right;" class="btn btn-secondary">Upload Result</button></th>
                  </tr>
                </tfoot>
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