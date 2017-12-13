<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Value;

class ValuesController extends Controller
{
	public $show_action = true;
	public $view_col = 'id_barang';
	public $listing_cols = ['id', 'id_barang', 'total_terjual', 'bulan', 'tahun', 'hasil_ramalan'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Values', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Values', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Values.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Values');
		
		if(Module::hasAccess($module->id)) {
			return View('la.values.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	public function ramal(Request $request){
	    if ($request->bulan == 1){
            $value = Value::where('id_barang', '=', $request->barang)->where('bulan', '=', ($request->bulan + 11))->where('tahun', '=', ($request->tahun))->first();
        } else {
            $value = Value::where('id_barang', '=', $request->barang)->where('bulan', '=', ($request->bulan - 1))->where('tahun', '=', ($request->tahun))->first();
        }
	    if ($value !=null){
            if ($value->total_terjual == 0){
                return redirect()->back()->withErrors("Total terjual sebelumnya belum ada");
            }
        } else{
            return redirect()->back()->withErrors("Tidak bisa melakukan peramalan");
        }
        $bulan_depan = $value->hasil_ramalan + (0.1 * ($value->total_terjual - $value->hasil_ramalan));
//    dd($bulan_depan);
    Value::create([
        'id_barang' => $request->barang,
        'hasil_ramalan' => $bulan_depan,
        'tahun' => $request->tahun,
        'bulan' => $request->bulan,
    ]);
    return redirect()->back();
	}

	/**
	 * Show the form for creating a new value.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created value in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Values", "create")) {
		
			$rules = Module::validateRules("Values", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Values", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.values.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified value.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Values", "view")) {
			
			$value = Value::find($id);
			if(isset($value->id)) {
				$module = Module::get('Values');
				$module->row = $value;
				
				return view('la.values.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('value', $value);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("value"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified value.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Values", "edit")) {			
			$value = Value::find($id);
			if(isset($value->id)) {	
				$module = Module::get('Values');
				
				$module->row = $value;
				
				return view('la.values.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('value', $value);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst(" value"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified value in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Values", "edit")) {
			
			$rules = Module::validateRules("Values", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Values", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.values.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified value from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Values", "delete")) {
			Value::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.values.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$values = DB::table('values')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Values');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/values/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Values", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/values/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Values", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.values.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
			 	}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
}
