@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/monthly_reports') }}">Monthly Report</a> :
@endsection
@section("contentheader_description", $monthly_report->$view_col)
@section("section", "Monthly Reports")
@section("section_url", url(config('laraadmin.adminRoute') . '/monthly_reports'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Monthly Reports Edit : ".$monthly_report->$view_col)

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
				{!! Form::model($monthly_report, ['route' => [config('laraadmin.adminRoute') . '.monthly_reports.update', $monthly_report->id ], 'method'=>'PUT', 'id' => 'monthly_report-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'bulan')
					@la_input($module, 'tahun')
					@la_input($module, 'id_barang')
					@la_input($module, 'jumlah')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/monthly_reports') }}">Cancel</a></button>
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
	$("#monthly_report-edit-form").validate({
		
	});
});
</script>
@endpush
