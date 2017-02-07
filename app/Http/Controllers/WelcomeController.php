<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{	
		Session::put('app', env('APP_NAME','ComprarJuntos'));
		Session::put('copy', env('APP_RIGTH','ComprarJuntos'));
		Session::put('mail', env('MAIL_USERNAME','info.comprarjuntos@gmail.com'));
		//Session::put('style', env('APP_STYLE','default'));		
		/**
		 * REALIZAMOS CONSULTAS PARA INDEX
		 * 
		 */
		
		Session::flash('controlador', '/inicio/');

		$departments = \DB::table('seg_department')->orderBy('department','asc')->get();		
		foreach ($departments as $department){
			$departamentos[$department->department] = $department->department;
		}
		$moduledata['departamentos']=$departamentos;

		//consultamos las ciudades del departamento		
		$moduledata['ciudades']= array();
		if(!empty(Session::get('comjunplus.usuario.state'))){
			//hay un departamento asignado
			$department_id = \DB::table('seg_department')
				->where('department',Session::get('comjunplus.usuario.state'))
				->get()[0]->id;

			$citys = \DB::table('seg_city')->orderBy('city','asc')
				->where('department_id',$department_id)
				->get();

			foreach ($citys as $city){
				$ciudades[$city->city] = $city->city;
			}
			$moduledata['ciudades']=$ciudades;
		}

		//algunas aleatorias categorias raiz
		$moduledata['categorias'] = \DB::table('clu_category')
		->where('category_id',0)
		->get();

		//return view('welcome',['modulo'=>$moduledata]);
		return view('welcome')->with($moduledata);
		
	}

}
