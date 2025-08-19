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
							<th>Discipline Name</th>
							<th>
								<input type="checkbox" name="" id="_selectAllCheckbox" />
								<label for="_selectAllCheckbox">Tick All</label>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($disciplines as $key => $discipline)
							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ $discipline->name }}
								</td>
								<td>
									<input type="checkbox" id="_{{ $discipline->id }}" name="discipline_id[]" value="{{ $discipline->id }}"
										class="_checkboxes">
									<label for="_{{ $discipline->id }}"></label>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<h5>School Class<span class="text-danger">*</span></h5>
					<div class="controls">
						<select name="class_id" id="class_id" required class="form-control p-10">
							<option value="">Select School Class</option>
							@foreach($schoolClasses as $key => $schoolClass)
								<option value="{{ $schoolClass->id }}">{{ $schoolClass->classname }}
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
		<input type="submit" value="Add" class="btn  btn-info">
	</div>
</form>

<script>	
	document.getElementById('_selectAllCheckbox')
		.addEventListener('change', function () {
			let checkboxes =
				document.querySelectorAll('._checkboxes');
			checkboxes.forEach(function (checkbox) {
				checkbox.checked = this.checked;
			}, this);
		});
</script>