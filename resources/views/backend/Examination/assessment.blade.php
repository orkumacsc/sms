@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
		
		<!-- Main content -->
		<section class="content">            
		  
          <div class="row">                    
          <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Assign Assessment To Scoresheet</h4>			  
        </div>
        <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
            <div class="col">
              <form method="post" action="{{ route('store_asign_assessment') }}">
                @csrf
              <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Assessment<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <select name="asstype" id="sid" required class="form-control p-10">
                                        <option value="">Select Assessment</option>                                        
                                            @foreach($assTypes as $key => $AssType)
                                            <option value="{{ $AssType->id }}">{{ $AssType->name }} ({{ $AssType->percentage }})</option> 
                                            @endforeach                                       
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5>Class<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <select name="class" id="class" required class="form-control p-10">
                                            <option value="">Select Class</option>
                                            @foreach($Classes as $key => $Class)
                                            <option value="{{ $Class->id }}">{{ $Class->classname }}</option>
                                            @endforeach                                        
                                        </select>
                                        </div>
                                    </div>
                                </div>
                  <div class="col-sm-4">
                    <div class="form-group">									
                      <div class="text-xs-right pt-25">
                        <input type="submit" value="Generate Exam Cards" class="btn  btn-info">
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
          </div>

			<div class="row">
			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Class List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                    
					<div class="table-responsive">
                    
                      @foreach($Classes as $Class)

                      <h3 class="mt-30">{{ $Class->classname }}</h3>
                      
                      <table class="table table-bordered">
                        
                            <tr>
                                <th>Records</th>
                            @foreach($Assessments as $key => $Ass)
                            @if($Ass->class_id == $Class->id)                            
								            <td>{{ $Ass->name }} ({{ $Ass->percentage }})</td>
                            @endif
                            @endforeach
                            <td>Total (100)</td>
                            </tr>
                            <tr>
                                <th>Remove</th>
                                @foreach($Assessments as $key => $Ass)
                                @if($Ass->class_id == $Class->id)                            
                                    <td><a href="{{ $Ass->id }}" >Delete</a></td>
                                @endif
                                @endforeach
                                <td>/</td>
                            </tr>
					  </table>

                      @endforeach
					</div>
                    
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->         
			</div>
			<!-- /.row -->

		</section>
		<!-- /.content -->
	  
	  </div>
  </div>

@endsection