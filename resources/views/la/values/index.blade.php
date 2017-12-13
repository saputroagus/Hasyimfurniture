@extends("la.layouts.app")

@section("contentheader_title", "Values")
@section("contentheader_description", "Values listing")
@section("section", "Values")
@section("sub_section", "Listing")
@section("htmlheader_title", "Values Listing")

@section("headerElems")
@la_access("Values", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Value</button>
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#Ramal">Ramalkan</button>
@endla_access
@endsection

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			@foreach( $listing_cols as $col )
			<th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
			@endforeach
			@if($show_actions)
			<th>Actions</th>
			@endif
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>

@la_access("Values", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Value</h4>
			</div>
			{!! Form::open(['action' => 'LA\ValuesController@store', 'id' => 'value-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @la_form($module)
					
					{{--
					@la_input($module, 'id_barang')
					@la_input($module, 'total_terjual')
					@la_input($module, 'bulan')
					@la_input($module, 'tahun')
					@la_input($module, 'hasil_ramalan')
					--}}
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
{{--tambahanbku--}}
@endla_access

@la_access("Values", "create")
<div class="modal fade" id="Ramal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Ramalkan</h4>
			</div>
			<form method="POST" action="{{ url('admin/values/ramal') }}" accept-charset="UTF-8" id="value-add-form">
				{{ csrf_field() }}
				<div class="modal-body">
					<div class="box-body">
						<div class="row">
							<div class="form-group col-md-6">
								<label for="id_barang">Bulan :</label>
								<select class="form-control" data-placeholder="Enter Id Barang" rel="select2" name="bulan">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="id_barang">Tahun :</label>
								<select class="form-control" data-placeholder="Enter Id Barang" rel="select2" name="tahun">
									<option value="2017">2017</option>
									<option value="2018">2018</option>
									<option value="2019">2019</option>

								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="id_barang">Barang :</label>
							<select class="form-control" data-placeholder="Enter Id Barang" rel="select2" name="barang">
								<option value="1">BR1</option>
								<option value="2">BR2</option>
								<option value="3">BR3</option>
								<option value="4">BR4</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input class="btn btn-success" type="submit" value="Submit">
				</div>
			</form>
		</div>
	</div>
</div>
@endla_access
	{{--funsinya untuk mengakhiri syintak--}}
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
//    menampilkan tabel
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/value_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#value-add-form").validate({
		
	});
});
</script>
@endpush
