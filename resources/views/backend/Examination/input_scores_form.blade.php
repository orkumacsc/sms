@extends('admin.admin_master')

@section('mainContent')

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
            

		  <div class="row mt-0"> 

			<div class="col-12">

			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Score Sheet</h3>               
           
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="" class="table table-bordered nowrap">
						<thead>
                            <tr>
                            <div class="row">                
                <div class="col-sm-12 text-center p-0 m-0">                                        
                    <h3>{{ $current_term->name }} {{ $current_session->name }} ACADEMIC SESSION</h3>
                    <div class="row mt-10">
                        <div class="col-sm-4"><h4>CLASS: {{ $SchoolClasses->classname }}</h4></div>
                        <div class="col-sm-8 "><h4>SUBJECT: {{ $subject->name }}</h4></div>                        
                    </div>
                </div>
            </div>
                            </tr>
							<tr>
								<th>S/No</th>
								<th>Admission No</th>
								<th>Full Name</th>
                                @foreach($Assessments as $key => $Ass)
                                    @if($Ass->class_id == $SchoolClasses->id)                            
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
                @if($Ass->class_id == $SchoolClasses->id)                            
                <td>
                  <input type="number" name="scores[{{ $Student->id }}][{{ $Ass->id }}]" style="width: 100%;" class="form-control">
                </td>
                @endif
                @endforeach	                               							
            </tr>                            
            @endforeach
            <input type="hidden" name="current_term" value="{{ $current_term->id }}">
            <input type="hidden" name="current_session" value="{{ $current_session->id }}">
            <input type="hidden" name="class_id" value="{{ $SchoolClasses->id }}">
            <input type="hidden" name="subject" value="{{ $subject->id }}">

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
		<!-- /.content -->
	  
	  </div>
  </div>

@endsection