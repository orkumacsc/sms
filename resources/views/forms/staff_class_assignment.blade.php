<form method="post" action="{{ route('staff.classes.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="StaffEnrolmentModal">Form Master Appointment</h5>
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
                                {{ $_staff->surname }},
                                {{ $_staff->firstname }}{{ $_staff->middlename ? ' ' . $_staff->middlename : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>                     
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="class_id">Class <span class="text-danger">*</span></label>
                    <select name="class_id" id="class_id" required class="form-control">
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->classname }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Please select a class from the list above.</small>
                </div>
            </div>
        </div>
        <div class="row">
             <div class="col-sm-12">
                <div class="form-group">
                    <input type="submit" value="Appoint" class="btn btn-info">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                class="ti-arrow-left"> Cancel</i></button>        
    </div>
</form>