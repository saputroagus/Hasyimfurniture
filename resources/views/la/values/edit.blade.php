@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/values') }}">Value</a> :
@endsection
@section("contentheader_description", $value->$view_col)
@section("section", "Values")
@section("section_url", url(config('laraadmin.adminRoute') . '/values'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Values Edit : ".$value->$view_col)

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
				{!! Form::model($value, ['route' => [config('laraadmin.adminRoute') . '.values.update', $value->id ], 'method'=>'PUT', 'id' => 'value-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'id_barang')
					@la_input($module, 'total_terjual')
					@la_input($module, 'bulan')
					@la_input($module, 'tahun')
					@la_input($module, 'hasil_ramalan')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/values') }}">Cancel</a></button>
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
	$("#value-edit-form").validate({
		
	});
});
</script>
@endpush
