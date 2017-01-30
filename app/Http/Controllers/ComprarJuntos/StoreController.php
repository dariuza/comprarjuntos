<?php namespace App\Http\Controllers\ComprarJuntos;

use App\Core\ComprarJuntos\Tienda;
use App\Core\ComprarJuntos\Producto;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller {
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	protected $auth;
	
	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
		$this->middleware('guest');
	}

	public function getIndex(){	
		//no funcionara debido a la ruta de busqueda por url
	}
	
	public function getListar(){
		
		$moduledata['productos']=\DB::table('clu_products')->skip(1)->take(2)->get();
		
		$message =array();
		//Control de perfil de usuario.
		if(empty(Session::get('comjunplus.usuario.name')) || empty(Session::get('comjunplus.usuario.adress')) || empty(Session::get('comjunplus.usuario.state')) || empty(Session::get('comjunplus.usuario.city')) || empty(Session::get('comjunplus.usuario.birthdate')) || empty(Session::get('comjunplus.usuario.email'))){		
			$message[] = 'Perfil3';
			return Redirect::to('/')->with('message', $message);
		}

		//calculo de datos para desplegar las tiendas del usuario
		$moduledata = array();	
		//Controlador para opciones
		Session::flash('controlador', '/mistiendas/');

		//consultamos los Departamentos los selects
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

		//Tiendas
		try {$moduledata['tiendas']=\DB::table('clu_store')
		->where('clu_store.user_id',Session::get('comjunplus.usuario.id'))
		->orderBy('order', 'asc')
		->get();
		}catch (ModelNotFoundException $e) {
			$message = ['Problemas al hallar datos de las tiendas'];
			return Redirect::to('mistiendas/inicio')->with('modulo',$moduledata)->with('error', $message);
		}
		//si no tiene tiendas, verificador.
		if(!count($moduledata['tiendas']))$message = ['Tiendas0'];

		//verificacion de mensajes de error
		if(Session::get('error')){			
			return Redirect::to('mistiendas/inicio')->with('modulo',$moduledata)->with('error', Session::get('error'));
		}

		//verificacion de mensajes tipo message
		if(Session::get('message')){			
			$message = array_merge ($message,Session::get('message'));
		}

		

		if(!empty($message)){
			return Redirect::to('mistiendas/inicio')->with('modulo',$moduledata)->with('message', $message);
		}else{
			return Redirect::to('mistiendas/inicio')->with('modulo',$moduledata);
		}

		
		//return view('comprarjuntos/tienda')->with($moduledata);
	}

	public function getInicio(){
		return view('comprarjuntos/tienda');
	}

	public function postNuevatienda(Request $request){		
		//verificamos si el tendero puede tener una tienda màs
		if(!$request->input('edit')){			
			$tiendas=\DB::table('clu_store')
			->select(\DB::raw('count(*) as total'))
			->where('clu_store.user_id', '=', Session::get('comjunplus.usuario.id'))			
			->groupBy('user_id')
			->get();
			
			if(!empty($tiendas)){
				if($tiendas[0]->total > (int)Session::get('comjunplus.usuario.stores')){
					$message[] = 'Problemas al crear la tienda';
					$message[] = 'No puedes crear màs de '.$tiendas[0]->total. ' tiendas. Para màs informaciòn envìa tu sugerencia al administrador en tu perfil de usuario.';
					return Redirect::to('mistiendas/listar')->with('error', $message);
				}
			}
		}
		
		//rutina para refinar los inputs		
		$array_input = array();
		$array_input['_token'] = $request->input('_token');
		$array_input['categorias'] = $request->input('categorias');
		if($request->input('categorias')){
			$array_category = explode(",", $request->input('categorias'));
			foreach($array_category as $key=>$value){
				$array_category_up[$key] = ucwords(strtolower($value));
			}
			$array_input['categorias'] =implode(',',$array_category_up);		

			$array_category = explode(" ", $request->input('categorias'));
			foreach($array_category as $key=>$value){
				$array_category_up[$key] = ucwords(strtolower($value));
			}
			$array_input['categorias'] =implode(',',$array_category_up);		

			$array_category = explode(";", $request->input('categorias'));
			foreach($array_category as $key=>$value){
				$array_category_up[$key] = ucwords(strtolower($value));
			}
			$array_input['categorias'] =implode(',',$array_category_up);		
		}				
		$array_input['color_uno'] = $request->input('color_uno');
		$array_input['color_dos'] = $request->input('color_dos');
		$array_input['descripcion'] = ucwords($request->input('descripcion'));
		$array_input['image_store'] = $request->input('image_store');
		$array_input['image_banner'] = $request->input('image_banner');
		$array_input['facebook_web'] = $request->input('facebook_web');
		$array_input['ubicacion'] = $request->input('ubicacion');
		$array_input['prioridad'] = 0;
		if(is_numeric($request->input('prioridad')))$array_input['prioridad'] = $request->input('prioridad');

		foreach($request->input() as $key=>$value){
			if($key != "_token" && 
				$key != "categorias" && 
				$key != "color_uno" &&
				$key != "color_dos" &&
				$key != "descripcion" &&
				$key != "image_store" &&
				$key != "image_banner" &&
				$key != "facebook_web" &&
				$key != "ubicacion" &&
				$key != "prioridad")
			{				
				$array_input[$key] = ucwords(strtolower($value));
			}
		}
		$request->replace($array_input);
		
		$messages = [
			'required' => 'El campo :attribute es requerido.',
			'size' => 'La :attribute deberia ser mayor a :size.',
			'min' => 'La :attribute deberia tener almenos :min. caracteres',
			'max' => 'La :attribute no debe tener maximo :max. caracteres',
			'numeric' => 'El :attribute  debe ser un número',			
			'date' => 'El :attribute  no es una fecha valida',
			'mimes' => 'La :attribute debe ser de tipo jpeg, png o bmp',
		];
		
		$rules = array(			
			'nombre' => 'required',
			'departamento'    => 'required', // make sure the username field is not empty			
			'departamento' => 'required',
			'municipio' => 'required',
			'direccion' => 'required',						
		);		
		
		$validator = Validator::make($request->input(), $rules, $messages);		
		if ($validator->fails()) {			
			return Redirect::back()->withErrors($validator)->withInput();
		}else{			
			//preparación y validacion de imagen de tienda
			if(!empty(Input::file('image_store'))){
				$file = array('image_store' => Input::file('image_store'));
				$rules = array(
					'image_store'=>'required|mimes:jpeg,bmp,png',
				);
				$validator = Validator::make($file, $rules, $messages);
				if ($validator->fails()) {			
					return Redirect::back()->withErrors($validator)->withInput();;
				}else{
					if(Input::file('image_store')->isValid()){						
						$destinationPath = 'users/'.Session::get('comjunplus.usuario.name').'/stores';
						$extension = Input::file('image_store')->getClientOriginalExtension(); // getting image extension
						$fileName_image = rand(1,9999999).'.'.$extension; // renameing image
						Input::file('image_store')->move($destinationPath, $fileName_image); 						
					}

				}	
			}

			//preparación y validacion de imagen banner
			if(!empty(Input::file('image_banner'))){
				$file = array('image_banner' => Input::file('image_banner'));
				$rules = array(
					'image_banner'=>'required|mimes:jpeg,bmp,png',
				);
				$validator = Validator::make($file, $rules, $messages);
				if ($validator->fails()) {			
					return Redirect::back()->withErrors($validator)->withInput();;
				}else{
					//eliminamos todos los ficheros
					if(Input::file('image_banner')->isValid()){						
						$destinationPath = 'users/'.Session::get('comjunplus.usuario.name').'/banner';
						$extension = Input::file('image_banner')->getClientOriginalExtension(); // getting image extension
						$fileName_banner = rand(1,9999999).'.'.$extension; // renameing image
						Input::file('image_banner')->move($destinationPath, $fileName_banner); 						
					}

				}	
			}

			$store = new Tienda();
			if($request->input('edit')){					
				//se actualizan los datos de la tienda
				$store = Tienda::find($request->input('store_id'));
				$store->status =  $request->input('estado');
			}else{
				//nueva tienda
				$store->status =  'Activa';
			}

			$store->name =  $request->input()['nombre'];
			$store ->nit =  '';
			$store->department =  $request->input()['departamento'];
			$store->city =  $request->input()['municipio'];
			$store->adress =  $request->input()['direccion'];
			$store->description =  $request->input()['descripcion'];
			$store->ubication =  $request->input()['ubicacion'];
			if(empty($store->image))$store->image =  'default.png';
			if(!empty($fileName_image))$store->image =  $fileName_image;
			if(empty($store->banner))$store->banner =  'default.png';
			if(!empty($fileName_banner))$store->banner =  $fileName_banner;
			$store->color_one =  $request->input()['color_uno'];
			$store->color_two =  $request->input()['color_dos'];			
			$store->order = 1;
			if(!empty($request->input()['prioridad']))$store->order =  $request->input()['prioridad'];			
			$store->metadata =  $request->input()['categorias'];			
			$store->web =  $request->input()['sitio_web'];
			$store->fanpage =  $request->input()['facebook_web'];
			$store->movil =  $request->input()['movil'];			
			$store->user_id = Session::get('comjunplus.usuario.id');			

			try {			
				$store->save();
				if($request->input('edit')){
					return Redirect::to('mistiendas/listar')->withInput()->with('message', ['Tienda '.$store->name.' editada Exitosamnte']);
				}
				return Redirect::to('mistiendas/listar')->withInput()->with('message', ['Tienda creada Exitosamnte']);
			}catch (\Illuminate\Database\QueryException $e) {
				$message[] = 'Problemas al crear la tienda';
				$message[] = $e->getMessage();
				return Redirect::to('mistiendas/listar')->with('error', $message);
			}	

		}

	}

	public function getActualizar($id_store=null,$id_user){		
		
		if(empty($id_store) || empty($id_user) || empty(Session::get('comjunplus.usuario.id'))){
			return Redirect::to('/')->withInput()->with('alerta', ['No se procesaròn los datos suministrados']);
		}
		//verificamos tienda y su tendero
		if($id_user != Session::get('comjunplus.usuario.id')){
			return Redirect::to('/')->withInput()->with('alerta', ['No se procesaròn los datos suministrados']);
		}

		$message = array();
		//consultamos los datos de la tienda
		try {$tienda=\DB::table('clu_store')
		->where('clu_store.id',$id_store)
		->where('clu_store.user_id',Session::get('comjunplus.usuario.id'))
		->orderBy('order', 'asc')
		->get();
		}catch (ModelNotFoundException $e) {
			$message = ['Problemas al hallar datos de la tienda'];
			return Redirect::to('mistiendas/listar')->with('error', $message);
		}
		//preparacion de datos
		Session::flash('controlador', '/mistiendas/');

		//consultamos los Departamentos los selects
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
		//Tiendas
		try {$moduledata['tiendas']=\DB::table('clu_store')
		->where('clu_store.user_id',Session::get('comjunplus.usuario.id'))
		->orderBy('order', 'asc')
		->get();
		}catch (ModelNotFoundException $e) {
			$message = ['Problemas al hallar datos de las tiendas'];
			return Redirect::to('mistiendas/inicio')->with('modulo',$moduledata)->with('error', $message);
		}

		Session::flash('_old_input.store_id', $tienda[0]->id);
		Session::flash('_old_input.nombre', $tienda[0]->name);
		Session::flash('_old_input.departamento', $tienda[0]->department);
		Session::flash('_old_input.municipio', $tienda[0]->city);
		Session::flash('_old_input.direccion', $tienda[0]->adress);
		Session::flash('_old_input.categorias', $tienda[0]->metadata);
		Session::flash('_old_input.color_uno', $tienda[0]->color_one);
		Session::flash('_old_input.color_dos', $tienda[0]->color_two);
		Session::flash('_old_input.descripcion', $tienda[0]->description);
		Session::flash('_old_input.img_store', $tienda[0]->image);
		Session::flash('_old_input.sitio_web', $tienda[0]->web);
		Session::flash('_old_input.facebook_web', $tienda[0]->fanpage);
		Session::flash('_old_input.movil', $tienda[0]->movil);
		Session::flash('_old_input.ubicacion', $tienda[0]->ubication);
		Session::flash('_old_input.prioridad', $tienda[0]->order);
		Session::flash('_old_input.img_banner', $tienda[0]->banner);
		Session::flash('_old_input.store_id', $id_store);
		Session::flash('_old_input.edit', true);
				
		if(!empty($message)){
			return Redirect::to('mistiendas/inicio')->with('modulo',$moduledata)->with('message', $message);
		}else{
			return Redirect::to('mistiendas/inicio')->with('modulo',$moduledata);
		}
	}

	public function postConsultarproducts(Request $request){
		//$request->input('id')
		//consultamos los productos de la tienda seleccionada.
		$productos=array();
		try {$productos=\DB::table('clu_products')
		->where('clu_products.store_id',$request->input('id'))
		->orderBy('order', 'asc')
		->get();
		}catch (ModelNotFoundException $e) {
			$message = ['Problemas al hallar productos de la Tienda'];			
		}
		//si no tiene tiendas, verificador.	
		
		return response()->json(['respuesta'=>true,'request'=>$request->input(),'data'=>$productos]);
	}

	public function getListarajax(Request $request){


		$moduledata['total']=Producto::count();

		if(!empty($request->input('search')['value'])){
			Session::flash('search', $request->input('search')['value']);			
			
			$moduledata['productos']=
			Producto::			
			where(function ($query) {
				$query->where('clu_products.name', 'like', '%'.Session::get('search').'%')
				->orWhere('clu_products.price', 'like', '%'.Session::get('search').'%')
				->orWhere('clu_products.category', 'like', '%'.Session::get('search').'%');								
			})
			->skip($request->input('start'))->take($request->input('length'))
			->get();		
			$moduledata['filtro'] = count($moduledata['productos']);
		}else{			
			$moduledata['productos']=\DB::table('clu_products')->skip($request->input('start'))->take($request->input('length'))->get();			
				
			$moduledata['filtro'] = $moduledata['total'];
		}
		
		return response()->json(['draw'=>$request->input('draw')+1,'recordsTotal'=>$moduledata['total'],'recordsFiltered'=>$moduledata['filtro'],'data'=>$moduledata['productos']]);
	}


}