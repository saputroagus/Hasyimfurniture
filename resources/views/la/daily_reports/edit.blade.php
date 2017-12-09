@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/daily_reports') }}">Daily Report</a> :
@endsection
@section("contentheader_description", $daily_report->$view_col)
@section("section", "Daily Reports")
@section("section_url", url(config('laraadmin.adminRoute') . '/daily_reports'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Daily Reports Edit : ".$daily_report->$view_col)

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
				{!! Form::model($daily_report, ['route' => [config('laraadmin.adminRoute') . '.daily_reports.update', $daily_report->id ], 'method'=>'PUT', 'id' => 'daily_report-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'kode_laporan')
					@la_input($module, 'tgl_laporan')
					@la_input($module, 'nama_toko')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/daily_reports') }}">Cancel</a></button>
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
	$("#daily_report-edit-form").validate({
		
	});
});
</script>
@endpush
