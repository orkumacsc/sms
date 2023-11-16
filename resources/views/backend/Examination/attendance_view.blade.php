@extends('admin.admin_master')

@section('mainContent')



<style media="print">
    @page:first{        
        margin-top: 0px;
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 50px;               
    }

    @page{        
        margin-top: 50px;
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 50px;               
    }

    .box-header{display:none;}
    .table{
            font-size: 20px !important;
            
            padding:0%;
            margin:0px;
            
    }

	thead {
		font-weight: bold;
	}

    .table-responsive > .table tr th, .table-responsive > .table tr td {
        white-space: nowrap !important;
        padding:1% !important;        
    }
    .inderline{
        border-bottom: 1px solid #000000 !important;
    }
    .main-footer{display:none;}
</style>

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">

		  <div class="row"> 

			<div class="col-12">

			  <div class="box">
			  <div class="box-header with-border">
				  <h3 class="box-title">Attendance Sheet</h3>                  
                  <button onclick="window.print()" style="float: right;" class="btn btn-secondary">Print</button>			  
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">                    
					  <table class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                        
						<thead>
							<tr>
								<div class="row">                
								<div class="col-sm-12 text-center p-0 m-0">                                        
									<h1>{{ $current_term->name }} {{ $current_session->name }} ACADEMIC SESSION</h3>
									<h2>EXAMINATION ATTENDANCE SHEET</h3>
									<div class="row mt-10 text-center">
										<div class="col-sm-3 m-0 p-0"><h4>CLASS: {{ $current_class->classname }}</h4></div>
										<div class="col-sm-6 m-0 p-0"><h4>SUBJECT: __________________________________</h4></div>
										<div class="col-sm-3 m-0 p-0"><h4>TIME:  _____________</h4></div>                        
									</div>
									<div class="row mt-10">
										<div class="col-sm-9 m-0 p-0"><h4>NAME OF INVIGILATOR(S):_______________________________________________</h4></div>
										<div class="col-sm-3 m-0 p-0"><h4>SIGN/DATE:_____________</h4></div>
									</div>
								</div>
								</div>
							</tr>
							<tr>
								<th>S/No</th>
								<th>Admission No</th>
								<th>Full Name</th>
								<th>Gender</th>								
								<th>Sign In</th>
								<th>Sign Out</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($Students as $key => $Student)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $Student->admission_no }}</td>
                                <td>{{ $Student->surname.', '.$Student->firstname.' '.$Student->middlename }}</td>								
								<td>{{ $Student->gendername }}</td>								
                                <td></td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
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