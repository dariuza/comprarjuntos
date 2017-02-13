@extends('app')

@section('content')	
	<style>
	.panel-body {		    
	    padding-bottom: 0px;
	}
	.navbar-default {
	    background-color: {{$tienda[0]->color_one}} !important;
	    border-color: #e7e7e7;
	}
	.navbar-default .navbar-brand{
		color: {{$tienda[0]->color_two}} !important;
	}
	.navbar-default .navbar-nav > li > a{
		color: {{$tienda[0]->color_two}} !important;	
	}
	.tienda_banner{
		background-image: url("{{url('users/'.$tienda[0]->user_name.'/banners/'.$tienda[0]->banner)}}");
		background-size: 100% 175px;
	}
	.center-block {
	  display: block;
	  margin-left: auto;
	  margin-right: auto;
	  text-align: center;
	}
	.option_store{
		text-align: center;
		cursor:pointer;			
	}

	</style>
	<div class="row">	
		<div class="alerts col-md-12 col-md-offset-0">
		<!-- $error llega si la función validator falla en autenticar los datos -->
			@if (count($errors) > 0)
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>Algo no va bien con el acceso!</strong> Hay problemas con los datos diligenciados.
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>											
				</div>
			@endif
			
			@if(Session::has('message'))
				<div class="alert alert-info alert-dismissible fade in" role="alert" >
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>¡Operación exitosa!</strong>  El proceso se ha ejecutado adecuadamente.<br>
					<ul>
						@foreach (Session::get('message') as $message)
							<li>{{ $message }}</li>
						@endforeach								
														
					</ul>
				</div>
		                
			@endif
			
			@if(Session::has('alerta'))
				<div class="alert alert-warning alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>¡Algo no va bien!</strong>  El proceso no se ejecuto correctamente.<br>			
					<ul>								
						@foreach (Session::get('alerta') as $alerta)
							<li>{{ $alerta }}</li>
						@endforeach															
					</ul>
				</div>                
			@endif		            
			
		    @if(Session::has('error'))
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>¡Algo no va bien!</strong>  El proceso no pudo ejecutarce.<br>
					<ul>								
						@foreach (Session::get('error') as $error)
							<li>{{ $error }}</li>					
					@endforeach															
					</ul>				
				</div>                
			@endif
		</div>
	</div>
	
	<div class="row tienda_banner" style="height: 175px;font-size: 40px; color: {{$tienda[0]->color_two}} !important; padding: 1%;margin-bottom: 1%; ">
		@if($tienda[0]->banner == 'default.png')
			{{$tienda[0]->name}}
		@endif
	</div>
	<div class="col-md-10 col-md-offset-1" style="margin-bottom: 1%;">
		<div class="row col-md-7">
			<div class="col-md-5">
			{{ Html::image('users/'.$tienda[0]->user_name.'/stores/'.$tienda[0]->image,'Imagen no disponible',array( 'style'=>'width: 100%;height: 200px;border-radius: 0%;' ))}}	
			</div>
			<div class="col-md-7 col-sd-offset-0">
				<div><b>{{$tienda[0]->name}}</b></div>
				<div>{{$tienda[0]->description}}</div>
				<div><span class="glyphicon glyphicon-map-marker" aria-hidden="true">{{$tienda[0]->department}}, {{$tienda[0]->city}}</span></div>
				<div>{{$tienda[0]->adress}}</div>				
			</div>	
		</div>
		<div class="row col-md-2">
		</div>
		<div class="row col-md-3" style="text-align: center;">
			<div> PROPIETARIO DE LA TIENDA</div>
			{{ Html::image('users/'.$tendero[0]->user_name.'/profile/'.$tendero[0]->avatar,'Imagen no disponible',array( 'style'=>'width: auto; height: 150px;border:2px solid #ddd;border-radius: 50%;' ))}}
			<div>{{$tendero[0]->names}} {{$tendero[0]->surnames}} </div>
			<div><span class="glyphicon glyphicon-envelope" aria-hidden="true"> Contacto</span></div>
		</div>		
	</div>
	<div class="col-md-10 col-md-offset-1" style="margin-bottom: 2%;">
		<div class="title m-b-md center-block">
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default">Articulos</button>				
				<button type="button" class="btn btn-default">Categorias</button>				
				<button type="button" class="btn btn-default">Ubicaciòn</button>
				<button type="button" class="btn btn-default">Estadisticas</button>				
				<button type="button" class="btn btn-default">Grupos de Consumo</button>
				<button type="button" class="btn btn-default">Reseñas</button>
			</div>
		</div>
	</div>
	<!--Listado de productos-->
	<div class="col-md-10 col-md-offset-1">	
		@foreach($productos as $producto)
			<div class="col-md-3 col-mx-offset-1">
				<div class="panel panel-default">					
					<div class="panel-body">
				    	<div class="row">
				    		<div class="col-md-12">				    			
			    				{{ Html::image('users/'.$tendero[0]->user_name.'/products/'.$producto->image1,'Imagen no disponible',array( 'style'=>'width: 100%;height: 150px;border-radius: 0%;' ))}}				    							    			
				    		</div>

				    		<div class="col-md-12 panel-footer"  style="background-color:{{$tienda[0]->color_one}}; color: {{$tienda[0]->color_two}}; border-color:
				    	{{$tienda[0]->color_two}};padding: 2px;">				    			
				    			<div class="col-md-4 col-mx-offset-0">				    				
					    			{{$producto->name}}				    			
				    			</div>	
				    			<div class="col-md-4 col-mx-offset-0 option_store">			    			
				    				<span class="glyphicon glyphicon-signal option_store_icon" aria-hidden="true"></span>
				    				<div style="font-size: 10px;">Informacion de interes</div>
				    			</div>
				    			<div class="col-md-4 col-mx-offset-0 option_store option_add_product" id ="{{$producto->name}}_{{$producto->id}}">			    			
				    				<span class="glyphicon glyphicon-shopping-cart option_store_icon" aria-hidden="true"></span>
				    				<div style="font-size: 10px;">Agregar al Carrito</div>
				    			</div>	
				    		</div>
				    	</div>
				    </div>				    
				</div>
			</div>
		@endforeach
	</div>

	
@endsection

@section('modal')
	<!--Modal para agregar al carrito-->
	<div class="modal fade" id="add_cart_modal" role="dialog" >
		 <div class="modal-dialog">
		 	<div class="modal-content">
		 		<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Agregar Producto</h4>
				</div>
				<div class = "alerts-module"></div>				
				<div class="modal-body">
				</div>
				 <div class="modal-footer">
			         <button type="submit" class="btn btn-default" >Agregar</button>
			         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        </div> 
		 	</div>
		 </div>
	</div>

	@if (Auth::guest())
	<!-- Modals para invitados -->

	<!--Modal para login-->
	<div class="modal fade" id="login_modal" role="dialog" >
	    <div class="modal-dialog  modal-sm">	    
	      <!-- Modal content-->
	      <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Ingreso a ComprarJuntos</h4>
				</div>
				<div class = "alerts-module"></div>				
				<div class="modal-body">
					<div class="row ">
						<div class="col-md-12 col-md-offset-0 row_init">
							{!! Form::open(array('url' => '/ingreso', 'method' => 'get','id'=>'login','onsubmit'=>'javascript:return seg_user.validateLogin()')) !!}
								<div class="panel-body">
												
									<div class="form-group">
										{!! Form::label('usuario', 'Usuario', array('class' => 'col-md-12 control-label')) !!}						
										<div class="col-md-12">
											{!! Form::text('usuario', old('usuario'), array('class' => 'form-control','placeholder'=>'Ingresa tu nombre usuario', 'autofocus'=>'autofocus'))!!}
										</div>
									</div>
			
									<div class="form-group">
										{!! Form::label('contraseña', 'Contraseña', array('class' => 'col-md-12 control-label')) !!}
										<div class="col-md-12">
											{!! Form::password('contraseña', array('class' => 'form-control','placeholder'=>'Ingresa tu contraseña')) !!}
										</div>
									</div>

									<div class="col-md-12" data-toggle="modal" data-target="#rpsw_modal" style="margin-top: 10px; font-size: 16px;">
										<a href="#">Recuperar Contraseña</a>
									</div>
								</div>							
			
							{!! Form::close() !!}
						</div>						
					</div>
		        </div>
		        <div class="modal-footer">
		          <button type="submit" form = "login" class="btn btn-default " >Ingresar</button>
		          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        </div>     
	      </div>
      </div>
	</div>
	
	<!-- Para recuperar el pasword por medio del corro electronico -->
	<div class="modal fade" id="rpsw_modal" role="dialog" >
	    <div class="modal-dialog  modal-sm">	    
	      <!-- Modal content-->
	      <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Recuperar contraseña</h4>
				</div>
				<div class = "alerts-module"></div>				
				<div class="modal-body">
					<div class="row ">
						<div class="col-md-12 col-md-offset-0 row_init">
							{!! Form::open(array('id'=>'rpsw','url' => '/recuperarcontraseña','method'=>'get')) !!}
				        		<div class="form-group">
									{!! Form::label('email', 'Correo Electronico', array('class' => 'col-md-12 control-label')) !!}
									<div class="col-md-12">
										{!! Form::email('email','', array('class' => 'form-control','placeholder'=>'Ingresa tu email', 'autofocus'=>'autofocus')) !!}
									</div>
								</div>
								      
					        {!! Form::close() !!}
						</div>						
					</div>
		        </div>
		        <div class="modal-footer">
		          <button type="submit" form = "rpsw" class="btn btn-default " >Enviar</button>
		          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>		                  
		        </div>     
	      </div>
      </div>
	</div>
	
	<!--Modal para el Formulario de registro-->
	<div class="modal fade" id="registry_modal" role="dialog" >
	    <div class="modal-dialog  modal-sm">	    
	      <!-- Modal content-->
	      <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Formulario de Registro</h4>
				</div>
				<div class = "alerts-module"></div>				
				<div class="modal-body">
					<div class="row ">
						<div class="col-md-12 col-md-offset-0 row_init">
							{!! Form::open(array('id'=>'registry','url' => '/registro','method'=>'get','onsubmit'=>'javascript:return seg_user.validateRegistry()')) !!}
				        		<div class="form-group">				        		

									{!! Form::label('usuario', 'Usuario', array('class' => 'col-md-12 control-label')) !!}						
									<div class="col-md-12">
										{!! Form::text('usuario', old('usuario'), array('class' => 'form-control','placeholder'=>'Ingresa tu nombre usuario', 'autofocus'=>'autofocus'))!!}
									</div>
									
									{!! Form::label('email', 'Correo Electronico', array('class' => 'col-md-12 control-label')) !!}
									<div class="col-md-12">
										{!! Form::email('email','', array('class' => 'form-control','placeholder'=>'Ingresa tu email, no es obligatorio')) !!}
									</div>			
									
									{!! Form::label('contraseña_uno', 'Contraseña', array('class' => 'col-md-12 control-label')) !!}
									<div class="col-md-12">
										{!! Form::password('contraseña_uno', array('class' => 'form-control','placeholder'=>'Ingresa tu contraseña')) !!}
									</div>
									
									{!! Form::label('contraseña_dos', 'Contraseña Nuevamente', array('class' => 'col-md-12 control-label')) !!}
									<div class="col-md-12">
										{!! Form::password('contraseña_dos', array('class' => 'form-control','placeholder'=>'Ingresa nuevamente tu contraseña')) !!}
									</div>
									
								</div>
								      
					        {!! Form::close() !!}
						</div>						
					</div>
		        </div>
		        <div class="modal-footer">
		          <button type="submit" form = "registry" class="btn btn-default " >Enviar</button>
		          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>		                  
		        </div>     
	      </div>
      </div>
	</div>
	@endif

	{!! Form::open(array('id'=>'form_add_product','url' => 'welcome/addproduct')) !!}		
    {!! Form::close() !!}

@endsection

@section('script')
	<script type="text/javascript">
		$('.option_add_product').on('click', function (e) {
			var datos = new Array();
			datos['id'] = this.id.split('_')[1];
			datos['name'] = this.id.split('_')[0];
			seg_ajaxobject.peticionajax($('#form_add_product').attr('action'),datos,"seg_user.consultaRespuestaAddCart");					
		});

	</script>
@endsection