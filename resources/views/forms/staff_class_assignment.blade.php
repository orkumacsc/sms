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
                    <select name="staff_id" id="staff_id" class="form-control" data-validation-required-message="Please select a staff member">
                        <option value="">Select Staff</option>
                        @foreach($staff as $_staff)
                            <option value="{{ $_staff->id }}">
                                {{ $_staff->surname }},
                                {{ $_staff->firstname }}{{ $_staff->middlename ? " {$_staff->middlename}" : '' }}
                            </option>
                        @endforeach
                    </select>                    
                </div>
            </div>                     
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="school_classes_id">Class <span class="text-danger">*</span></label>
                    <select name="school_classes_id" id="school_classes_id" class="form-control" data-validation-required-message="Please select a class">
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->classname }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="departments_id">Discipline <span class="text-danger">*</span></label>
                    <select name="departments_id" id="departments_id" class="form-control" data-validation-required-message="Please select a discipline">
                        
                    </select>                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="school_arms_id">Arm <span class="text-danger">*</span></label>
                    <select name="school_arms_id" id="school_arms_id" class="form-control" data-validation-required-message="Please select an arm">
                        
                    </select>                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="academic_sessions_id">Academic Session <span class="text-danger">*</span></label>
                    <input type="text" name="academic_sessions_id" id="academic_sessions_id" class="form-control" value="{{ currentAcademicSession()->name }}" readonly> 
                    <input type="hidden" name="academic_sessions_id" value="{{ currentAcademicSession()->id }}">            
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
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close">
            <i class="ti-cross-left"></i> Cancel
        </button>        
    </div>
</form>

<script>   
    $school_classes_id = document.getElementById('school_classes_id');   
    $departments_id = document.getElementById('departments_id');    

    $school_classes_id.addEventListener('change', function() {
       fetch(`/api/classes/${this.value}/disciplines`)
            .then(response => response.json())
            .then(data => {
                const disciplineSelect = document.getElementById('departments_id');
                disciplineSelect.innerHTML = '<option value="">Select Discipline</option>';
                data.forEach(discipline => {
                    const option = document.createElement('option');
                    option.value = discipline.id;
                    option.textContent = discipline.name;
                    disciplineSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching disciplines:', error));
    });   

    $departments_id.addEventListener('change', function() {
       fetch(`/api/disciplines/${this.value}/arms`)
            .then(response => response.json())
            .then(data => {
                const armSelect = document.getElementById('school_arms_id');
                armSelect.innerHTML = '<option value="">Select Arm</option>';
                data.forEach(arm => {
                    const option = document.createElement('option');
                    option.value = arm.id;
                    option.textContent = arm.arm_name;
                    armSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching arms:', error));
    });   
</script>