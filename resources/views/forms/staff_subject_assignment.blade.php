<form method="post" action="{{ route('staff.subjects.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="StaffEnrolmentModal">Staff Subject Assignment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body box-body m-10">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="staff_id">Staff <span class="text-danger">*</span></label>
                    <select name="staff_id" id="staff_id" required class="form-control">
                        <option value="">Select Staff</option>
                        @foreach($staff as $_staff)
                            <option value="{{ $_staff->id }}">
                                {{ $_staff->surname }}, {{ $_staff->firstname }}{{ $_staff->middlename ? " {$_staff->middlename}" : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="subject_id">Subjects <span class="text-danger">*</span></label>
                    <select name="subject_id[]" id="subject_id" required multiple class="form-control">
                        <option value="">Select Subjects</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hold Ctrl (Windows) or Command (Mac) to select multiple subjects.</small>
                </div>
            </div>            
        </div>
        <div class="row">
            <div class="col-sm-12 d-flex align-items-end">
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-info">
                       <i class="fa fa-check"></i> Assign
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                class="ti-arrow-left"> Cancel</i></button>
    </div>
</form>