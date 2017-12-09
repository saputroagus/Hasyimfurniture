@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/promo_products') }}">Promo Product</a> :
@endsection
@section("contentheader_description", $promo_product->$view_col)
@section("section", "Promo Products")
@section("section_url", url(config('laraadmin.adminRoute') . '/promo_products'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Promo Products Edit : ".$promo_product->$view_col)

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
				{!! Form::model($promo_product, ['route' => [config('laraadmin.adminRoute') . '.promo_products.update', $promo_product->id ], 'method'=>'PUT', 'id' => 'promo_product-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'kode_barangpromo')
					@la_input($module, 'kode_promo')
					@la_input($module, 'kode_barang')
					@la_input($module, 'harga_potongan')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/promo_products') }}">Cancel</a></button>
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
	$("#promo_product-edit-form").validate({
		
	});
});
</script>
@endpush
