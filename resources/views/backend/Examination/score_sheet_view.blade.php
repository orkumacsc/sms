@extends('admin.admin_master')

@section('mainContent')

<style media="print">
  @page: first {
    size: landscape !important;
    margin-top: 0px;
    margin-left: 0px;
    margin-right: 0px;
    margin-bottom: 20px;
  }

  @page {
    size: landscape !important;
    margin-top: 50px;
    margin-left: 0px;
    margin-right: 0px;
    margin-bottom: 20px;
  }

  .box-header,
  .main-footer {
    display: none;
  }

  .table {
    font-size: 12px !important;
    padding: 0%;
    margin: 0px;
  }

  .table-responsive>.table tr th,
  .table-responsive>.table tr td {
    white-space: nowrap !important;
    padding: .3% !important;
    border-color: black !important;
  }

  .inderline {
    border-bottom: 1px solid #000000 !important;
  }

  * {
    color: black !important;
  }
</style>

<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row mt-0">
        <div class="col-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Score Sheet</h3>
              <button onclick="window.print()" style="float: right;" class="btn btn-secondary">Print</button>
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
                            <div class="col-sm-4">
                              <h4>CLASS: {{ $SchoolClasses->classname }} {{ $SchoolArms->arm_name }}</h4>
                            </div>
                            <div class="col-sm-8 ">
                              <h4>SUBJECT: __________________________________</h4>
                            </div>
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
                  <tbody>
                    @foreach($Students as $key => $Student)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $Student->admission_no }}</td>
              <td>{{ $Student->surname . ', ' . $Student->firstname . ' ' . $Student->middlename }}</td>
              @foreach($Assessments as $key => $Ass)
          @if($Ass->class_id == $SchoolClasses->id)
        <td></td>
      @endif
        @endforeach
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