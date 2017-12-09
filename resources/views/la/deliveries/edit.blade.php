@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/deliveries') }}">Delivery</a> :
@endsection
@section("contentheader_description", $delivery->$view_col)
@section("section", "Deliveries")
@section("section_url", url(config('laraadmin.adminRoute') . '/deliveries'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Deliveries Edit : ".$delivery->$view_col)

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

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($delivery, ['route' => [config('laraadmin.adminRoute') . '.deliveries.update', $delivery->id ], 'method'=>'PUT', 'id' => 'delivery-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'kode_kirim')
					@la_input($module, 'id_barang')
					@la_input($module, 'tgl_kirim')
					@la_input($module, 'status')
					@la_input($module, 'tgl_diterima')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/deliveries') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#delivery-edit-form").validate({
		
	});
});
</script>
@endpush
