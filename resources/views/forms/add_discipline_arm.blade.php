<form method="post" action="{{ route($routeName) }}" enctype="multipart/form-data">
	@csrf
	<div class="modal-header">
		<h5 class="modal-title" id="AssignSubjectModal">
			<i class="text-secondary mdi mdi-calculator-variant-outline"></i> {{ $title }}
		</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body box-body my-10">
		<div class="row">
			<div class="table-responsive col-sm-12">
				<table id="" class="table table-bordered nowrap">
					<thead>
						<tr>
							<th>S/No</th>
							<th>Arm Name</th>
							<th>
								<input type="checkbox" name="" id="selectAllCheckbox" />
								<label for="selectAllCheckbox">Tick All</label>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($schoolArms as $key => $schoolArm)
							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ $schoolArm->arm_name }}
								</td>
								<td>
									<input type="checkbox" id="{{ $schoolArm->id }}" name="arm_id[]"
										value="{{ $schoolArm->id }}" class="checkboxes">
									<label for="{{ $schoolArm->id }}"></label>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<h5>Discipline Name<span class="text-danger">*</span></h5>
					<div class="controls">
						<select name="departments_id" id="departments_id" required class="form-control p-10">
							<option value="">Select Discipline</option>
							@foreach($disciplines as $key => $discipline)
								<option value="{{ $discipline->id }}">{{ $discipline->name }}
								</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>		
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<h5>Max Students<span class="text-danger"></span></h5>
					<div class="controls">
						<input type="number" name="max_capacity" id="max_capacity" class="form-control p-10"
							min="1" value="50">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="close"><i
				class="ti-arrow-left"> Cancel</i></button>
		<input type="submit" value="Add" class="btn  btn-info">
	</div>
</form>
<script>
	document.getElementById('selectAllCheckbox')
		.addEventListener('change', function () {
			let checkboxes =
				document.querySelectorAll('.checkboxes');
			checkboxes.forEach(function (checkbox) {
				checkbox.checked = this.checked;
			}, this);
		});
</script>