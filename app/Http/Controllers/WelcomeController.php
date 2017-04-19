<?php namespace App\Http\Controllers;

use Mail;
use DateTime;
use Auth;
use App\Core\ComprarJuntos\Tienda;
use App\Core\ComprarJuntos\Orden;
use App\Core\ComprarJuntos\Anotacion;
use App\Core\ComprarJuntos\Detalle;
use App\Core\ComprarJuntos\Mensaje;
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
	public function index(Request $request){
		
		if(!empty($request->input())){
			//si es el finder es el buscador inicial
			dd($request->input());			
			if(array_key_exists('finder',$request->input())){
				return redirect('/'.$request->input('finder'));
			}
		}

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
		->skip(0)->take(4)
		->get();

		//un tendero
		$moduledata['tendero'] = \DB::table('seg_user_profile')
		->select('seg_user_profile.*','seg_user.name as user_name')
		->leftjoin('seg_user', 'seg_user_profile.user_id', '=', 'seg_user.id')			
		->where('seg_user_profile.avatar','!=','default.png')
		->orderByRaw("RAND()")
		->skip(0)->take(1)
		->get();

		//productos		
		$moduledata['productos'] = \DB::table('clu_products')
		->select('clu_products.*','clu_store.id as store_id','clu_store.name as store_name','clu_store.city as store_city','clu_store.adress as store_adress','clu_store.image as store_image','clu_store.color_one as color_one','clu_store.color_two as color_two','seg_user.name as user_name')
		->leftjoin('clu_store', 'clu_products.store_id', '=', 'clu_store.id')
		->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
		->where('clu_products.active',1)
		->where('clu_store.status','Activa')
		->orderByRaw("RAND()")
		->skip(0)->take(8)
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

	public function getModal($data = null, $metadata = null){		
		if($data == 'modalregistro' ){
			Session::flash('modal', 'modalregistro');
		}
		if($data == 'modalorden' ){
			//el tendero esea ver el pedido desde el correo
			//aqui usamos los datos y los metadatos par desplegar la orden
			//preguntamos si se halla logueado el usuario
			if (Auth::guest()) {
			 	//es un invitado, primero debe loguearce
			 	Session::flash('modal', 'modallogin');
			 	Session::flash('orden_id', $metadata);			 				 	
			}else{
				//puede ir directamente hasta la orden de pedido
				Session::flash('orden_id', $metadata);			 	
				return Redirect::to('/mistiendas/listar');
				
			}			
		}

		if($data == 'modalmessagetotender' ){
			//el cliente desea dejar un mensaje para el tendero deacuerdo ala orden aceptada o rechazada.
			Session::flash('modal', 'modalmessagetotender');
			//calculamos la tienda y el tendero y
			$moduledata['orden'] = \DB::table('clu_order')
			->select('clu_order.*','clu_store.id as store_id','clu_store.name as store','clu_store.color_one','clu_store.color_two','seg_user_profile.names','seg_user_profile.surnames','seg_user_profile.user_id as user_id')
			->leftjoin('clu_store', 'clu_order.store_id', '=', 'clu_store.id')
			->leftjoin('seg_user_profile', 'clu_store.user_id', '=', 'seg_user_profile.user_id')
			->where('clu_order.id',$metadata)							
			->get();
			//consultaremos la ùltimas 3 annotaciones
			$moduledata['annotations'] = \DB::table('clu_order_annotation')
			->select('clu_order_annotation.*')	
			->leftjoin('clu_order', 'clu_order_annotation.order_id', '=', 'clu_order.id')			
			->where('clu_order.id',$metadata)							
			->orderBy('id','ascd')
			->take(3)	
			->get();			
			Session::flash('orden_data', $moduledata);	
		}

		if($data == 'modalresenatostore' ){			
			Session::flash('modal', 'modalresenatostore');
			$moduledata['orden'] = \DB::table('clu_order')
			->select('clu_order.*','clu_store.id as store_id','clu_store.name as store','clu_store.color_one','clu_store.color_two','seg_user_profile.names','seg_user_profile.surnames','seg_user_profile.user_id as user_id')
			->leftjoin('clu_store', 'clu_order.store_id', '=', 'clu_store.id')
			->leftjoin('seg_user_profile', 'clu_store.user_id', '=', 'seg_user_profile.user_id')
			->where('clu_order.id',$metadata)							
			->get();
			Session::flash('orden_data_resena', $moduledata);	
		}

		return redirect('/');
	}

	public function postMessageorder(Request $request){

		try {
			//enviar mensaje a tendero			
			//consultamos la orden
			$orden=\DB::table('clu_order')			
			->leftjoin('clu_store', 'clu_order.store_id', '=', 'clu_store.id')
			->where('clu_order.id',$request->input()['msg_orden_id'])					
			->get();
			
			$tienda = \DB::table('clu_store')
			->select('clu_store.*','seg_user.email','seg_user.name as uname','seg_user_profile.names as nombres_tendero','seg_user_profile.surnames as apellidos_tendero','seg_user_profile.movil_number','seg_user_profile.fix_number','seg_user.id as user_id')
			->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
			->leftjoin('seg_user_profile', 'clu_store.user_id', '=', 'seg_user_profile.user_id')								
			->where('clu_store.id',$request->input()['msg_store_id'])
			->get();

			$detalles = \DB::table('clu_order')
			->select('clu_order_detail.*')
			->leftjoin('clu_order_detail', 'clu_order.id', '=', 'clu_order_detail.order_id')
			->where('clu_order.id',$request->input()['msg_orden_id'])
			->get();

			//anotaciones
			$anotaciones = \DB::table('clu_order_annotation')
			->where('clu_order_annotation.order_id',$request->input()['msg_orden_id'])
			->get();

			$data = Array();					
			$data['tienda'] = $tienda[0]->name;
			$data['orden_id'] = $request->input()['msg_orden_id'];
			$data['email'] = $tienda[0]->email;
			$data['direccion_tienda'] = $tienda[0]->city.' - '.$tienda[0]->adress;
			$data['ciudad_tienda'] = $tienda[0]->city;
			$data['telefono_tienda'] = $tienda[0]->movil_number.' - '.$tienda[0]->fix_number;
			$data['imagen'] = 'users/'.$tienda[0]->uname.'/stores/'.$tienda[0]->image;		

			$data['nombres_tendero'] =  $tienda[0]->nombres_tendero;
			$data['apellidos_tendero'] = $tienda[0]->apellidos_tendero;					

			$data['url'] = $request->url();

			$data['detalles'] = $detalles;
			$data['mensaje_orden'] =$request->input()['message_orden_text'];
			$data['anotaciones'] = $anotaciones;

			$data['id_client'] = $orden[0]->client_id;
			$data['name_client'] = $orden[0]->name_client;
			$data['email_client'] = $orden[0]->email_client;
			$data['number_client'] = $orden[0]->number_client;
			$data['adress_client'] = $orden[0]->adress_client;
						
			try{
				Mail::send('email.order_message_tender',$data,function($message) use ($orden,$tienda) {
					$message->from(Session::get('mail'),Session::get('copy').' - '.$orden[0]->id);
					$message->to($tienda[0]->email,$tienda[0]->uname)->subject('Orden de Pedido.');
				});
			}catch (\Exception  $e) {	
				$message[] = 'Lo sentimos, el mensaje no pudo ser enviado al tendero. Intenta hacerle llegar tu mensaje acudiendo directamente a su correo electronico o a su nùmero de contacto.'; 
				return Redirect::to('/')->with('error', $message);
			}

			//agregamosel mensaje del tendero a las notaciones de la orden
			if($data['mensaje_orden'] != ""){
				$anotacion = new Anotacion();
				$hoy = new DateTime();
				$anotacion->user_name = $data['name_client'];
				$anotacion->date = $hoy->format('Y-m-d H:i:s');
				$anotacion->description = $data['mensaje_orden'];
				$anotacion->active = true;
				$anotacion->order_id = $data['orden_id'] ;				
				try {
					//guardado de anotacion de pedido
					$anotacion->save();
				}catch (ModelNotFoundException $e) {
					//no pasa gran cosa, ya se ha enviado el mensaje al correo					
				}
			}				
			
			//agregar en message interno
			$message[] = 'Mensaje enviado con exito al tendero.';
			
		}catch (ModelNotFoundException $e) {			
			//Modificamos el mensaje a mostrar
			$message[] = 'Lo sentimos, el mensaje no pudo ser enviado al tendero. Intenta hacerle llegar tu mensaje acudiendo directamente a su correo electronico o a su nùmero de contacto.'; 
			return Redirect::to('/')->with('error', $message);
		}
		return Redirect::to('/')->with('message', $message);					
	}

	//este motodo es para retornar datos para mostar el modal, al querer agregar un producto al carrito
	public function postAddproduct(Request $request){
		//consultamos las caracteristicas del producto		
		$producto = \DB::table('clu_products')							
			->where('clu_products.id',$request->input('id'))		
			->get();			
		return response()->json(['respuesta'=>true,'request'=>$request->input(),'data'=>$producto]);	
	}

	//este motodo es para mandar la orden de pedido, guardarla
	public function postAddorder(Request $request){
				
		$orden = new Orden();	
		$hoy = new DateTime();
		$orden->date = $hoy->format('Y-m-d H:i:s');
		//miramos si es usuario o invitado
		if(!empty($request->input('name_invitado')) && !empty($request->input('dir_invitado')) ){
			//es invitado, captamos los datos de contacto
			$orden->name_client = $request->input('name_invitado');
			$orden->adress_client = $request->input('dir_invitado');
			$orden->email_client = strtolower($request->input('email_invitado'));
			$orden->number_client = $request->input('tel_invitado');
			$orden->client_id = 0;
			
		}else{
			//es usuario del sistema y esta logueado
			//$cliente = User::find(Session::get('comjunplus.usuario.id'));
			$cliente = \DB::table('seg_user_profile')			
			->leftjoin('seg_user', 'seg_user_profile.user_id', '=', 'seg_user.id')
			->where('seg_user.id',Session::get('comjunplus.usuario.id'))
			->get();

			$orden->name_client = $cliente[0]->names.' '.$cliente[0]->surnames;
			$orden->adress_client = $cliente[0]->city.' - '.$cliente[0]->adress;
			$orden->email_client = $cliente[0]->email;
			$orden->number_client = $cliente[0]->movil_number.', ' .$cliente[0]->fix_number;
			$orden->client_id = $cliente[0]->user_id;
		}
		$orden->active= true;
		$orden->stage_id = 1;

		$data = Array();
		$productos = Array();
		foreach($request->input() as $key=>$value){
			if(strpos($key,'prod_') !== false){
				$vector=explode('_',$key);
				$n=count($vector);
				$id_prod = end($vector);
				
				$productos[$vector[$n-2]][$id_prod][$vector[1]] = str_replace(",,","",$value);
				$data['detalle'][$vector[$n-2]][$id_prod][$vector[1]] = str_replace(",,","",$value);
			}
		}

		if(count($productos)){
			//buscamos la tienda y su tendero
			$tienda = \DB::table('clu_store')
			->select('clu_store.*','seg_user.email','seg_user.name as uname','seg_user_profile.names as nombres_tendero','seg_user_profile.surnames as apellidos_tendero','seg_user_profile.movil_number','seg_user_profile.fix_number','seg_user.id as user_id')
			->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
			->leftjoin('seg_user_profile', 'clu_store.user_id', '=', 'seg_user_profile.user_id')	
			->leftjoin('clu_products', 'clu_store.id', '=', 'clu_products.store_id')			
			->where('clu_products.id',key($productos))
			->get();

			$orden->store_id = $tienda[0]->id;		
			try {
				//guardado de pedido en base
				$orden->save();	
			}catch (ModelNotFoundException $e) {				
				return Redirect::back()->with('error',['No se pudo guardar la orden de pedido, Intentalo nuevamente.']);
			}

			//guardado de anotaciones
			if(!empty($request->input('description'))){
				$anotacion = new Anotacion();
				$anotacion->user_name = $orden->name_client;
				$anotacion->date = $hoy->format('Y-m-d H:i:s');
				$anotacion->description = $request->input('description');
				$anotacion->active = true;
				$anotacion->order_id = $orden->id;				
				try {
					//guardado de anotacion de pedido
					$anotacion->save();
				}catch (ModelNotFoundException $e) {				
					return Redirect::back()->with('error',['No se pudo guardar la orden de pedido, Intentalo nuevamente. Error en guardar anotaciones ']);
				}
			}		
			
			//guardado de detalles
			foreach ($productos as $id_prod => $prod) {
				//de un producto pude haber diferentes configuraciones			
				foreach ($prod as $key => $values) {					
					$detalle = new Detalle();
					$detalle->product = $values['nprod'];
					$detalle->price = $values['precio'];
					$detalle->volume = $values['volume'];
					$detalle->description = $values['crtrcs'];
					$detalle->product_id = $id_prod;
					$detalle->order_id = $orden->id;
					try{
						$detalle->save();
					}catch (ModelNotFoundException $e) {				
						return Redirect::back()->with('error',['No se pudo guardar la orden de pedido, Intentalo nuevamente. Error en guardar detalles']);
					}
				}				
			}
			
			//envio de correo a tendero de pedido			
			$data['tienda'] = $tienda[0]->name;
			$data['orden_id'] = $orden->id;
			$data['email'] = $tienda[0]->email;
			$data['direccion_tienda'] = $tienda[0]->city.' - '.$tienda[0]->adress;
			$data['ciudad_tienda'] = $tienda[0]->city;
			$data['telefono_tienda'] = $tienda[0]->movil_number.' - '.$tienda[0]->fix_number;
			$data['imagen'] = 'users/'.$tienda[0]->uname.'/stores/'.$tienda[0]->image;		

			$data['nombres_tendero'] =  $tienda[0]->nombres_tendero;
			$data['apellidos_tendero'] = $tienda[0]->apellidos_tendero;

			$data['nombre_cliente'] = $orden->name_client;
			$data['adress_client'] = $orden->adress_client;
			$data['email_client'] = $orden->email_client;
			$data['number_client'] = $orden->number_client;
			$data['id_client'] = $orden->client_id;

			$data['order_description'] = $request->input('description');

			$data['url'] = $request->url();
			
			//envio de correo al tendero
			try{
				Mail::send('email.order',$data,function($message) use ($tienda,$orden) {
					$message->from(Session::get('mail'),Session::get('copy').' - '.$orden->id);
					$message->to($tienda[0]->email,$tienda[0]->name)->subject('Orden de Pedido.');
				});
			}catch (\Exception  $e) {	
				$mensage[]='No se logro enviar el correo al Tendero';				
			}

			//envio de correo a cliente, si falla notificar al tendero en mensage
			try{
				Mail::send('email.order_client',$data,function($message) use ($orden) {
					$message->from(Session::get('mail'),Session::get('copy').' - '.$orden->id);
					$message->to($orden->email_client,$orden->name_client)->subject('Orden de Pedido.');
				});
			}catch (\Exception  $e) {	
				$mensage[]='El correo suministrado no es valido';
				$mensage[]='Si no eres usuario de ComprarJuntos lo mejor es realizar nuevamente el pedido. Si ya eres usuario, tu correo electronico esta mal diligenciado y deberias correjirlo';				
			}

			//envio a buzon interno de pedido, a tendero
			$mensaje = new Mensaje();
			$mensaje->subject = 'Orden de Pedido';
			$mensaje->date = $hoy->format('Y-m-d H:i:s');
			$mensaje->object = 'clu_order';
			$mensaje->object_id = $orden->id;
			$mensaje->user_receiver_id = $tienda[0]->user_id;//tendero			
			$mensaje->user_sender_id = 1;//envia el sistema, super admin			

			$html = '<div>'.
					'Nueva Orden'.
					'</div>';
			$mensaje->body = $html;

			try {				
				$mensaje->save();	
			}catch (ModelNotFoundException $e) {				
				//no hacer nada
			}

			//envio a buzon interno de pedido, a cliente
			if($orden->client_id){
				$mensaje = new Mensaje();
				$mensaje->subject = 'Orden de Pedido';
				$mensaje->date = $hoy->format('Y-m-d H:i:s');
				$mensaje->object = 'clu_order';
				$mensaje->object_id = $orden->id;
				$mensaje->user_receiver_id = $orden->client_id;//tendero			
				$mensaje->user_sender_id = 1;//envia el sistema. superadmin

				$html = '<div>'.
						'Nueva Orden'.
						'</div>';
				$mensaje->body = $html;

				try {				
					$mensaje->save();	
				}catch (ModelNotFoundException $e) {				
					//no hacer nada
				}
			}

			//retornar ala tienda con mensajes de ejecuciòn			
			$mensage[]='El pedido fue enviado con EXITO!, Con Consecutivo: '.$orden->id;
			return Redirect::back()->with('message',$mensage);
		}else{
			//la tienda no tiene productos
			return Redirect::back()->with('error',['Error Inesperado, no alcanzo a llegar ningun producto.']);
		}
		
	}
	

}
