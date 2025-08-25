@extends('admin.admin_master')

@section('mainContent')
@section('title', 'Staff Subject Assignment')

<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- Staff Subject Assignment Modal -->
                <div class="modal fade" id="StaffSubjectAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="StaffSubjectAssignmentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content box">
                            @include('forms.staff_subject_assignment')
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="StaffClassAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="StaffClassAssignmentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content box">
                            @include('forms.teaching_assignments')
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Staff Subject Allocation</h4>
                            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#StaffSubjectAssignmentModal">
                                <i class="fa fa-plus"></i> New Assignment
                            </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/NO</th>
                                            <th>Staff ID</th>
                                            <th>Staff Name</th>
                                            <th>Subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($staffSubjects as $key => $StaffSubject)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $StaffSubject->staff_no }}</td>
                                                <td>
                                                    {{ $StaffSubject->surname }}, {{ $StaffSubject->firstname }}{{ $StaffSubject->middlename ? ' ' . $StaffSubject->middlename : '' }}
                                                </td>
                                                <td>
                                                    @if($StaffSubject->subjects()->count())
                                                        @foreach($StaffSubject->subjects as $subject)
                                                            <p> <i class="fa fa-book"></i> {{ $subject->subject_name }}</p>
                                                        @endforeach
                                                    @else
                                                        <span>Not yet assigned Subject</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="javascript:void(0)" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-info btn-md" onclick="return confirm('Are you sure you want to update this subject?')">Update</button>
                                                    </form>
                                                </td>                                            
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No staff subjects assigned yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- /.box-body -->
                    </div>
                </div>
                
                <div class="col-sm-12 col-lg-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Teacher-Class-Subject Allocation</h4>
                            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#StaffClassAssignmentModal">
                                <i class="fa fa-plus"></i> New Assignment
                            </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/NO</th>
                                            <th>Staff ID</th>
                                            <th>Staff Name</th>
                                            <th>Subject</th>
                                            <th>Class</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($teachingAssignments as $key => $teachingAssignment)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $teachingAssignment->teacher->staff_no }}</td>
                                                <td>
                                                    {{ $teachingAssignment->teacher->surname }}, {{ $teachingAssignment->teacher->firstname }}{{ $teachingAssignment->teacher->middlename ? ' ' . $teachingAssignment->teacher->middlename : '' }}
                                                </td>
                                                <td>
                                                    @if($teachingAssignment->subject)
                                                        <p><i class="fa fa-book"></i> {{ $teachingAssignment->subject->subject_name }}</p>
                                                    @else
                                                        <span>Not yet assigned Subject</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($teachingAssignment->schoolClass && $teachingAssignment->arm || $teachingAssignment->department)
                                                        <p><i class="fa fa-building"></i> {{ $teachingAssignment->schoolClass->classname }} {{ $teachingAssignment->arm?->arm_name }} {{ $teachingAssignment->department?->name }}</p>
                                                    @else
                                                        <span>Not yet assigned Class</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('teaching.assignments.update', [$teachingAssignment->id]) }}" method="POST" class="d-inline">
                                                        @csrf                                                        
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-info btn-md" onclick="return confirm('Are you sure you want to update this assignment?')">Update</button>
                                                    </form>
                                                </td>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No staff subjects assigned yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- /.box-body -->
                    </div>
                </div>    
            </div>
            <!-- /.row -->
        </section>
    </div>
</div>

@endsection