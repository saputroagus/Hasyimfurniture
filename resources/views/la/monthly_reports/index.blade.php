@extends("la.layouts.app")

@section("contentheader_title", "Monthly Reports")
@section("contentheader_description", "Monthly Reports listing")
@section("section", "Monthly Reports")
@section("sub_section", "Listing")
@section("htmlheader_title", "Monthly Reports Listing")

@section("headerElems")
	<form class="form-inline">
		<div class="form-group">
			<label for="email">Tahun:</label>
			<select name="tahun" id="" class="form-control">
				@for($i= date('Y');$i>(date('Y') -5);$i--)
					<option
					@if(Request::has('tahun') && Request::get('tahun') == $i)
						selected
					@endif
						>{{$i}}</option>
				@endfor
			</select>
		</div>
		<div class="form-group">
			<label for="pwd">Bulan:</label>
			<select name="bulan" id="" class="form-control">
				@php($bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"])
				@for($i=1;$i<13;$i++)
					<option
							@if(Request::has('bulan') && Request::get('bulan') == $i)
							selected
							@endif
							value="{{$i}}">{{$bulan[$i-1]}}</option>
				@endfor
			</select>
		</div>

		<button type="submit" class="btn btn-default">Submit</button>
	</form>
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
			<th>Nama Barang</th>
			<th>Total</th>
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>


@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
@if(Request::has('tahun') && Request::has('bulan'))
<script>
$(function () {
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/monthly_report_dt_ajax/'.Request::get('tahun').'/'.Request::get('bulan')) }}",
        columns: [
            { data: 'id_barang', name: 'id_barang' },
            { data: 'jumlah', name: 'jumlah' },
        ]
    });

});
</script>
@endif
@endpush
