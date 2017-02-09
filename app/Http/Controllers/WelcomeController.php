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
	public function index(){

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
		->orderByRaw("RAND()")
		->skip(0)->take(16)
		->get();

		//algunas tiendas
		$moduledata['tiendas'] = \DB::table('clu_store')
		->select('clu_store.*','seg_user.name as user_name')
		->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
		->where('clu_store.status','Activa')			
		->orderByRaw("RAND()")
		->skip(0)->take(5)
		->get();

		//un tendero
		$moduledata['tendero'] = \DB::table('seg_user_profile')
		->select('seg_user_profile.*','seg_user.name as user_name')
		->leftjoin('seg_user', 'seg_user_profile.user_id', '=', 'seg_user.id')			
		->where('seg_user_profile.avatar','!=','default.png')
		->orderByRaw("RAND()")
		->skip(0)->take(1)
		->get();

		//return view('welcome',['modulo'=>$moduledata]);
		return view('welcome')->with($moduledata);		
	}

	public function getFind($data = null){
		//BUSQUEDA DE TIENDA PRODUCTO O CATEGORIA
		//Primero miramos si coincide con el nombre de una tienda
		$moduledata['tienda'] = \DB::table('clu_store')
		->select('clu_store.*','seg_user.name as user_name')
		->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
		->where('clu_store.name',$data)							
		->get();


		return view('comprarjuntos/vertienda')->with($moduledata);

		//Si hallamos una tienda nos vamos a mostarla
		if(count($moduledata['tienda'])){
			return redirect()->action('WelcomeController@getVertienda');
			//return $this->getVertienda($moduledata);
		}


		return $data;
	}

	public function getVertienda(){		
		
	}

}
