@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/woods') }}">Wood</a> :
@endsection
@section("contentheader_description", $wood->$view_col)
@section("section", "Woods")
@section("section_url", url(config('laraadmin.adminRoute') . '/woods'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Woods Edit : ".$wood->$view_col)

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
				{!! Form::model($wood, ['route' => [config('laraadmin.adminRoute') . '.woods.update', $wood->id ], 'method'=>'PUT', 'id' => 'wood-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'nama_kayu')
					@la_input($module, 'jenis_kayu')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/woods') }}">Cancel</a></button>
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
	$("#wood-edit-form").validate({
		
	});
});
</script>
@endpush