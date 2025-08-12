<div class="modal fade" id="Profile" tabindex="-1" role="document" aria-labelledby="ProfileModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content box">

            <div class="modal-header">
                <h5 class="modal-title" id="ProfileModal">
                    <i class="text-secondary mdi mdi-calculator-variant-outline"></i>
                    My Profile
                </h5>
            </div>
            <div class="modal-body box-body my-10">
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-success">

                    </div>
                    <div class="widget-user-image">
                        <img class="circle"
                            src="{{ (!empty($staff_info['staff_passport'])) ? url('storage/' . $staff_info['staff_passport']) : url('storage/profile-photos/default.png') }}"
                            alt="Staff Passport">
                    </div>

                    <div class="box-footer pt-80">
                        <div class="description-header text-center">
                            <h4 class="description-content">
                                {{ $staff_info['surname'] . ', ' . $staff_info['firstname'] . ' ' . $staff_info['middlename'] }}
                            </h4>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 text-left">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="description-header">STATUS</h5>
                                    </div>
                                    <div class="col-6">
                                        <span class="description-text text-warning">Active</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="description-header">STAFF ID NO</h5>
                                    </div>
                                    <div class="col-6">
                                        <span class="description-text">{{ $staff_info['staff_no'] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="description-header">DATE OF BIRTH</h5>
                                    </div>
                                    <div class="col-6">
                                        <span class="description-text">
                                            {{ \Carbon\Carbon::parse($staff_info['date_of_birth'])->format('d M., Y') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="description-header">GENDER</h5>
                                    </div>
                                    <div class="col-6">
                                        <span class="description-text">{{ $staff_info['gendername'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
                        class="ti-arrow-left"> Cancel</i></button>
            </div>
        </div>
    </div>
</div>