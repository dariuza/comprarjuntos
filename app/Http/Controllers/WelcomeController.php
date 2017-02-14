<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

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

		//departamentos
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

		$moduledata['category'] = \DB::table('clu_category')
		->select('clu_category.name','fc.name as fname')
		->leftjoin('clu_category as fc', 'clu_category.category_id', '=', 'fc.id')
		->orderByRaw("RAND()")
		->get();
		//construimos el array
		$cat =  array();
		foreach ($moduledata['category'] as $key => $value) {
			if(!$value->fname){
				if(!array_key_exists($value->name,$cat))$cat[$value->name] = array(); 
			}else{
				$cat[$value->fname][] = $value->name;
			}
		}

		$moduledata['categorias'] = $cat;
		//algunas tiendas
		$moduledata['tiendas'] = \DB::table('clu_store')
		->select('clu_store.*','seg_user.name as user_name','seg_user_profile.avatar as avatar')
		->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
		->leftjoin('seg_user_profile', 'clu_store.user_id', '=', 'seg_user_profile.user_id')
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

	//Este es el metodo que controla el buscador principal
	public function getFind($data = null){
		//BUSQUEDA DE TIENDA PRODUCTO O CATEGORIA
		//Primero miramos si coincide con el nombre de una tienda
		$moduledata['tienda'] = \DB::table('clu_store')
		->select('clu_store.*','seg_user.name as user_name')
		->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
		->where('clu_store.name',$data)							
		->get();

		//al momento de hallar una tienda
		if(count($moduledata['tienda'])){
			
			$moduledata['tendero'] = \DB::table('seg_user_profile')
			->select('seg_user_profile.*','seg_user.name as user_name')
			->leftjoin('seg_user', 'seg_user_profile.user_id', '=', 'seg_user.id')					
			->where('seg_user.id',$moduledata['tienda'][0]->user_id)		
			->get();

			$moduledata['productos'] = \DB::table('clu_products')							
			->where('clu_products.store_id',$moduledata['tienda'][0]->id)		
			->get();

			return view('comprarjuntos/vertienda')->with($moduledata);
		}

		return $data;
	}

	//este motodo es para retornar datos para mostar el modal
	public function postAddproduct(Request $request){
		//consultamos las caracteristicas del producto		
		$producto = \DB::table('clu_products')							
			->where('clu_products.id',$request->input('id'))		
			->get();			
		return response()->json(['respuesta'=>true,'request'=>$request->input(),'data'=>$producto]);	
	}
	

}
