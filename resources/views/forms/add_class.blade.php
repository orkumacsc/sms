<form method="post" action="{{ route('save_school_class') }}">
    @csrf
    <div class="modal-header bg-info">
        <h5 class="modal-title" id="feesDiscountModal">{{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="tru">&times;</span>
        </button>
    </div>
    <div class="modal-body box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h5>Class Name <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="class" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <h5>Academic Session <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="academic_session" class="form-control">
                            @foreach($academicSessions as $key => $academicSession)
                                <option value="{{$academicSession->id }}">
                                    {{$academicSession->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                class="ti-arrow-left"> Cancel</i></button>
        <input type="submit" value="Add Class" class="btn  btn-info">
    </div>
</form>