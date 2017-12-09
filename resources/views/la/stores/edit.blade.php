@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/stores') }}">Store</a> :
@endsection
@section("contentheader_description", $store->$view_col)
@section("section", "Stores")
@section("section_url", url(config('laraadmin.adminRoute') . '/stores'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Stores Edit : ".$store->$view_col)

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
				{!! Form::model($store, ['route' => [config('laraadmin.adminRoute') . '.stores.update', $store->id ], 'method'=>'PUT', 'id' => 'store-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'nama_toko')
					@la_input($module, 'alamat_toko')
					@la_input($module, 'id_user')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/stores') }}">Cancel</a></button>
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
	$("#store-edit-form").validate({
		
	});
});
</script>
@endpush
