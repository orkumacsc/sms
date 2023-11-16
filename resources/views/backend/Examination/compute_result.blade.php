@extends('admin.admin_master')

@section('mainContent')

<style media="print">
    * {
        color: black !important;               
    }

    table, tr, th {
        border: 2px solid black !important;
        
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


<div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">
		  <div class="box hidebox">
			<div class="box-header with-border">
			  <h4 class="box-title">Students' Result Computation</h4>			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('store_compute_result') }}">
                        @csrf
					    <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <h5>Session<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <select name="session_id" id="session_id" required class="form-control p-10">
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
                            <div class="col-sm-2">
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
                            
							<div class="col-sm-2">
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
										<input type="submit" value="Input Scores" class="btn  btn-info">
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
	  </div>
  </div>

@endsection