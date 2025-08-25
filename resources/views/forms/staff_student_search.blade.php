<form method="post" action="{{ route($routeName) }}">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="AssignSubjectModal">
            <i class="text-secondary mdi mdi-calculator-variant-outline"></i>
            {{ $title }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body box-body my-10">
        <div class="row">
            <div class="table-responsive col-sm-12">
                <table id="" class="table table-bordered nowrap">
                    <caption class="text-left font-weight-bold mb-2 text-muted" style="caption-side: top;">
                        <p>
                            All cross-curricular subjects are selected automatically.
                        </p>
                        <p>Tick appropriate subjects and categories to be added.</p>
                    </caption>
                    <thead>
                        <tr>
                            <th>S/No</th>
                            <th colspan="2">Subject Name</th>

                            <th>
                                Compulsory
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($SchoolSubjects as $key => $SchoolSubject)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $SchoolSubject->subject_name }}
                                </td>
                                <td>
                                    <input type="checkbox" id="_{{ $SchoolSubject->id }}" name="subjects_id[{{ $SchoolSubject->id }}][subject_id]"
                                        value="1" class="_checkboxes"
                                        {{ old("subjects_id.$SchoolSubject->id.subject_id") ? 'checked' : '' }}>
                                    <label for="_{{ $SchoolSubject->id }}"></label>
                                </td>
                                <td>
                                    <input type="checkbox" id="_{{ $SchoolSubject->id }}_compulsory" name="subjects_id[{{ $SchoolSubject->id }}][is_compulsory]"
                                        value="1" class="_checkboxes"
                                        {{ old("subjects_id.$SchoolSubject->id.is_compulsory") ? 'checked' : '' }}>
                                    <label for="_{{ $SchoolSubject->id }}_compulsory"></label>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                class="ti-arrow-left"> Cancel</i></button>
        <input type="submit" value="Assign Subjects" class="btn  btn-info">
    </div>
</form>