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
    .main-footer, .box-header{display:none;}
    
</style>

<div class="content-wrapper">
	  <div class="container-full">
        		
		<!-- Main content -->
		<section class="content">

			<div class="box ">  
                
                    <div class="box-header with-border">
                        <div class="text-right">
                            <a href="{{ route('payfees') }}" class="btn btn-info">Back</a>
                            <a href="javascript:window.print()" class="btn btn-info">print</a>
                        </div>
                    </div>

				<div class="box-body">                    
                    <table class="table table-bordered" >
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <img src="{{ url('backend/images/school_logo.png') }}" >
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <h3>GOSPEL INTERNATIONAL COLLEGE, ZAKI-BIAM</h3>
                                        <h4>ZAKI-BIAM, UKUM LGA, BENUE STATE, NIGERIA</h4>
                                        <h5>Tel: 08030661324, 08140326189, 07030271476</h5>
                                        <h5>Email: gospelcollege2019@gmail.com;  website: gospelschools.sch.ng</h5>
                                        <h3 class="mt-50">SCHOOL FEES RECEIPT</h>
                                    </div>
                                    <div class="col-sm-2">
                                        <img src="{{ url('backend/images/Coat_of_arms_of_Nigeria.png') }}" >
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:50%">
                                <strong>Received From:</strong> <br /> <br/>

                                <center>
                                    <table class="table-bordered">
                                        <tr>
                                            <th colspan="2"><h4>{{ $SchoolFees->surname.', '.$SchoolFees->firstname.' '.$SchoolFees->middlename }}</h4></th>															
                                            <td rowspan="3" style="width:30%"><img src="{{ url('storage/'.$SchoolFees->passport) }}" alt="Passport" srcset=""></td>
                                        </tr>                                               
                                        <tr>
                                            <th>ADMISSION NO</th>
                                            <td>{{ $SchoolFees->admission_no }}</td>
                                        </tr>                                                
                                        <tr>
                                            <th>CLASS</th>
                                            <td>{{ $SchoolFees->classname }}</td>
                                        </tr>  
                                    </table>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    <strong>Receipt Number: </strong>{{ $SchoolFees->receipt_no }} <br>
                                    <strong>Reference Number: </strong>{{ $SchoolFees->payment_ref }} <br>
                                    <strong>Payment Date: </strong>{{ \Carbon\Carbon::parse($SchoolFees->payment_date)->format('D, d M, Y') }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table class="table-bordered">
                                    <tr>
                                        <th><strong><i>Being Payment for:</i></strong></th>
                                        <td>{{ $SchoolFees->term }} {{ $SchoolFees->session }} Academic Session School Fees</td>
                                    </tr>
                                    <tr>
                                        <th><strong><i>Amount Paid:</i></strong></th>
                                        <td>&#8358;{{ formatCurrency($SchoolFees->amount_paid) }}</td>                                                    
                                    </tr>
                                    <tr>
                                        <th><strong><i>Amount Paid in Words:</i></strong></th>
                                        <td>{{ FeestoWords($SchoolFees->amount_paid) }} Naira Only</td>                                                    
                                    </tr>
                                    
                                </table>
                            </td>
                        </tr>
                    </table>
				</div>

			</div>

		</section>
		<!-- /.content -->
	  </div>
  </div>

@endsection