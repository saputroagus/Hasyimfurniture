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

use App\Models\Monthly_Report;
use App\models\Detail_Order;
class Monthly_ReportsController extends Controller
{
	public $show_action = true;
	public $view_col = 'id_barang';
	public $listing_cols = ['id', 'bulan', 'tahun', 'id_barang', 'jumlah'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Monthly_Reports', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Monthly_Reports', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Monthly_Reports.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Monthly_Reports');
		
		if(Module::hasAccess($module->id)) {
			return View('la.monthly_reports.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new monthly_report.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created monthly_report in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Monthly_Reports", "create")) {
		
			$rules = Module::validateRules("Monthly_Reports", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			$total = Detail_Order::where('month(created_at)','=',$request->bulan)->where('id_barang','=',$request->id_barang)->where('tahun','=',$request->tahun)->get();

			$insert_id = Module::insert("Monthly_Reports", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.monthly_reports.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}

	}

	/**
	 * Display the specified monthly_report.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Monthly_Reports", "view")) {
			
			$monthly_report = Monthly_Report::find($id);
			if(isset($monthly_report->id)) {
				$module = Module::get('Monthly_Reports');
				$module->row = $monthly_report;
				
				return view('la.monthly_reports.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('monthly_report', $monthly_report);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("monthly_report"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified monthly_report.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Monthly_Reports", "edit")) {			
			$monthly_report = Monthly_Report::find($id);
			if(isset($monthly_report->id)) {	
				$module = Module::get('Monthly_Reports');
				
				$module->row = $monthly_report;
				
				return view('la.monthly_reports.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('monthly_report', $monthly_report);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("monthly_report"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified monthly_report in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Monthly_Reports", "edit")) {
			
			$rules = Module::validateRules("Monthly_Reports", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Monthly_Reports", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.monthly_reports.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified monthly_report from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Monthly_Reports", "delete")) {
			Monthly_Report::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.monthly_reports.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	//builder
	public function dtajax($tahun,$bulan)
	{
        $query = DB::table('detail_orders')
            ->select('id_barang',DB::raw('sum(jml_barang) as jumlah'))
            ->whereMonth('created_at','=',$bulan)
            ->whereYear('created_at','=',$tahun)
            ->groupBy('id_barang')
        ;

        return DataTables::of($query)->make(true);
	}
}
