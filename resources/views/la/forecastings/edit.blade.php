@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/forecastings') }}">Forecasting</a> :
@endsection
@section("contentheader_description", $forecasting->$view_col)
@section("section", "Forecastings")
@section("section_url", url(config('laraadmin.adminRoute') . '/forecastings'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Forecastings Edit : ".$forecasting->$view_col)

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
				{!! Form::model($forecasting, ['route' => [config('laraadmin.adminRoute') . '.forecastings.update', $forecasting->id ], 'method'=>'PUT', 'id' => 'forecasting-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'id_barang')
					@la_input($module, 'bulan')
					@la_input($module, 'hasil_peramalan')
					@la_input($module, 'pb_lalu')
					@la_input($module, 'tahun')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/forecastings') }}">Cancel</a></button>
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
	$("#forecasting-edit-form").validate({
		
	});
});
</script>
@endpush
