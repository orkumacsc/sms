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

                <div class="col-sm-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">List of Staff and Subjects</h3>
                            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#StaffSubjectAssignmentModal">
                                Assign Subjects
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
                                                            <p class="badge badge-success">{{ $subject->subject_name }}</p>
                                                        @endforeach
                                                    @else
                                                        <span>Not yet assigned Subject</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('staff.subjects.update', [$StaffSubject->id]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-info btn-md" onclick="return confirm('Are you sure you want to update this subject?')">Update</button>
                                                    </form>
                                                </td>                                            
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No staff subjects assigned yet.</td>
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