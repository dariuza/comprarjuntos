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
		/*background-size: 100% 175px;*/
		background-repeat: no-repeat;
    	background-position: center;
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
	.chosen-container .chosen-container-multi{
		border: 1px solid #ccc !important;
		border-radius: 4px !important;
	}
	.categorias{
		width: 100% !important;
		border-radius: 4px !important;
		position: relative !important;
		min-height: 1px !important;
		padding-right: 15px !important;
		padding-left: 15px !important;			
	}
	.fa{
		/*color:#ffcc00;*/
	}
	table.dataTable.no-footer {
	    border-bottom: 1px solid #111 !important;
	    border: 1px solid transparent;
	}

	</style>

	<link rel="stylesheet" href="{{ url('css/font-awesome.min.css') }}">

	<div class="row visible-lg" style="margin-top: 5%;"></div>
	<div class="row visible-md" style="margin-top: 7%;"></div>
	<div class="row visible-sm" style="margin-top: 10%;"></div>
	<div class="row visible-xs" style="margin-top: 16%;"></div>

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
	
	<div class="row tienda_banner" style="height: 200px;font-size: 40px; color: {{$tienda[0]->color_two}} !important; padding: 1%;margin-bottom: 1%; ">
		@if($tienda[0]->banner == 'default.png')
			{{$tienda[0]->name}}
		@endif
	</div>
	<div class="col-md-10 col-md-offset-1" style="margin-bottom: 1%;">
		<div class="row col-md-6">
			<div class="col-md-5">
			{{ Html::image('users/'.$tienda[0]->user_name.'/stores/'.$tienda[0]->image,'Imagen no disponible',array( 'style'=>'width: 100%;height: 200px;border-radius: 0%;' ))}}	
			</div>
			<div class="col-md-7 col-sd-offset-0" style="text-align: center;">				
				<div>{{$tienda[0]->description}}</div>
				<div><span class="glyphicon glyphicon-map-marker" aria-hidden="true">{{$tienda[0]->department}}, {{$tienda[0]->city}}</span></div>
				<div>{{$tienda[0]->adress}}</div>
				@if($tienda[0]->web)
					<div><i class="fa fa-cloud" aria-hidden="true"></i> <a href="https://{{$tienda[0]->web}}" target="_blank">{{$tienda[0]->web}}</a></div>
				@endif
				@if($tienda[0]->fanpage)
					<div><i class="fa fa-facebook" aria-hidden="true"></i> <a href="https://{{$tienda[0]->fanpage}}" target="_blank">{{$tienda[0]->fanpage}}</a></div>
				@endif

				@if($tienda[0]->movil)
					<div><i class="fa fa-whatsapp" aria-hidden="true"></i> {{$tienda[0]->movil}}</div>
				@endif			
				
			</div>	
		</div>
		<div class="row col-md-3" style="text-align: center;">
			<div><b>REPUTACIÒN</b></div>			
			@if($tienda[0]->reputacion == 0)
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
			@elseif($tienda[0]->reputacion >= 5)
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
			@elseif($tienda[0]->reputacion >= 4.5)
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i>
			@elseif($tienda[0]->reputacion >= 4)
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>			
			@elseif($tienda[0]->reputacion >= 3.5)
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>			
			@elseif($tienda[0]->reputacion >= 3)
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
			@elseif($tienda[0]->reputacion >= 2.5)
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
			@elseif($tienda[0]->reputacion >= 2)
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
			@elseif($tienda[0]->reputacion >= 1.5)
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
			@elseif($tienda[0]->reputacion >= 1)
				<i class="fa fa-star fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
			@elseif($tienda[0]->reputacion >= 0.5)
				<i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
				<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>			
			@endif
			
			<div>El porcentaje de satisfacción  del servicio en {{ucwords($tienda[0]->name)}} es de {{round($tienda[0]->reputacionpercent*100)}}%.</div>
			<div>Ventas Concretadas: {{$tienda[0]->ordenes}}</div>

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
				<button type="button" class="btn btn-default" onclick="window.location.hash = '#calificaciones';">Calificaciones</button>
			</div>
		</div>
	</div>
	<!--Listado de productos-->
	<div class="col-md-10 col-md-offset-1">	
		@foreach($productos as $producto)
			<div class="col-md-3 col-mx-offset-1" style="text-align: center;">
				<div class="panel panel-default">					
					<div class="panel-body">
				    	<div class="row">
				    		<div class="col-md-12 option_add_product" id ="{{$producto->name}}_{{$producto->id}}">				    			
			    				{{ Html::image('users/'.$tendero[0]->user_name.'/products/'.$producto->image1,'Imagen no disponible',array( 'style'=>'width: 90%;height: 200px;border-radius: 0%;' ))}}				    							    			
				    		</div>

				    		<div class="col-md-12 panel-footer"  style="background-color:{{$tienda[0]->color_one}}; color: {{$tienda[0]->color_two}}; border-color:{{$tienda[0]->color_two}};padding: 2px;">				    			
				    			<div class="col-md-4 col-mx-offset-0" style="font-size: 14px;">
					    			{{$producto->name}}				    			
				    			</div>	
				    			<div class="col-md-4 col-mx-offset-0 option_store">			    			
				    				<span class="glyphicon glyphicon-signal option_store_icon" aria-hidden="true"></span>
				    				<div style="font-size: 10px;">Descripciòn</div>
				    			</div>
				    			<div class="col-md-4 col-mx-offset-0 option_store option_add_product" id ="{{$producto->name}}_{{$producto->id}}">			    			
				    				<span class="glyphicon glyphicon-shopping-cart option_store_icon" aria-hidden="true"></span>
				    				<div style="font-size: 10px;">Al Carrito</div>
				    			</div>	
				    		</div>
				    	</div>
				    </div>				    
				</div>
			</div>
		@endforeach
	</div>

	<!--Listado de reseñas-->
	<div id="calificaciones" class="col-md-10 col-md-offset-1" style="margin-top: 2%;">
		<div class="panel panel-default">
			<div class="panel-heading" style="text-align: center;"><b>CALIFICACIONES DEL SERVICIO</b></div>
			<div class="panel-body">
				<table id="table_orders" class="display responsive no-wrap " cellspacing="0" width="96%" style="margin: auto;">
					<thead >
			            <tr>
			            	<td></td>			            			            	
		        			<td>CLIENTE</td>
		        			<td>CALIFICACIÓN</td>
		        			<td>RESEÑA</td>
		        			<td>FECHA</td>		        			
			            </tr>
			        </thead>              
				</table>
			</div>
		</div>		
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
					<div class="row">
						<div class="col-md-7">
							{!! Form::hidden('id_store_cart_modal',null,array('id'=>'id_store_cart_modal')) !!}
							{!! Form::hidden('id_product_cart_modal',null,array('id'=>'id_product_cart_modal')) !!}
							<div class="col-md-12">
								<label for="price_cart_modal_for" class="col-md-3 control-label">Precio:</label>
								<label for="price_cart_modal" class="col-md-9 control-label">
									$<span id="price_cart_modal_span"></span>
								</label>
							</div>
							<div class="col-md-12">
								<div id="unity_cart_modal" class="col-md-12"></div>
							</div>
							<div class="col-md-12" style="margin-bottom: 5%;">
								{!! Form::text('volume_cart_modal',1, array('id'=>'volume_cart_modal', 'class' => 'form-control solo_numeros','placeholder'=>'Cantidad a comprar')) !!}
							</div>
							<div id="div_cart_colors" class="col-md-12" style="margin-bottom: 3%;">
								<label for="color_cart_modal_for" class="col-md-3 control-label">Color</label>
								<div class="col-md-9">
									{!! Form::select('colores_cart_select',array('0'=>'Elije un color'),array(), array('id'=>'colores_cart_select','class' => 'form-control chosen-select col-md-12' ,'data-placeholder'=>'Elije un color','tabindex'=>'4')) !!}
								</div>
							</div>
							<div id="div_cart_sizes" class="col-md-12" style="margin-bottom: 3%;">
								<label for="sizes_cart_modal_for" class="col-md-3 control-label">Talla</label>
								<div class="col-md-9">
									{!! Form::select('sizes_cart_select',array('0'=>'Elije un tamaño'),array(), array('id'=>'sizes_cart_select','class' => 'form-control chosen-select col-md-12' ,'data-placeholder'=>'Elije una talla','tabindex'=>'4')) !!}
								</div>
							</div>
							<div id="div_cart_flavors" class="col-md-12" style="margin-bottom: 3%;">
								<label for="flavors_cart_modal_for" class="col-md-3 control-label">Sabor</label>
								<div class="col-md-9">
									{!! Form::select('flavors_cart_select',array('0'=>'Elije un sabor'),array(), array('id'=>'flavors_cart_select','class' => 'form-control chosen-select col-md-12' ,'data-placeholder'=>'Elije un sabor','tabindex'=>'4')) !!}
								</div>
							</div>
							<div id="div_cart_materials" class="col-md-12" style="margin-bottom: 3%;">
								<label for="materials_cart_modal_for" class="col-md-3 control-label">Material</label>
								<div class="col-md-9">
									{!! Form::select('materials_cart_select',array('0'=>'Elije un material'),array(), array('id'=>'materials_cart_select','class' => 'form-control chosen-select col-md-12' ,'data-placeholder'=>'Elije un material','tabindex'=>'4')) !!}
								</div>
							</div>
							<div id="div_cart_model" class="col-md-12">
								<label for="model_cart_modal_for" class="col-md-3 control-label">Modelo:</label>
								<div id="model_cart_modal" class="col-md-9" ></div>
							</div>
							
						</div>
						<div class="col-md-5">
							<div class="col-md-12" style="text-align: center;font-size: 14px;">
								<label for="prod_cart_modal_for" class="col-md-12 control-label"></label>
								{{ Html::image('users/'.$tendero[0]->user_name.'/products/default.png','Imagen no disponible',array('id'=>'prod_img_cart_modal','style'=>'width: 100%;'))}}
							</div>
							<div id="div_cart_description" class="col-md-12">
								<label for="description_cart_modal_for" class="col-md-12 control-label">Descripción</label>
								<div id="dercription_cart_modal" class="col-md-12" ></div>
							</div>							
						</div>
					</div>
				</div>
				<div class="modal-footer">
				    <button type="submit" id="button_cart_modal" class="btn btn-default" >Agregar</button>
				    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        </div> 
		 	</div>
		</div>
	</div>

	<div class="modal fade" id="cart_modal" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
		 		<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Carro de Compras</h4>
				</div>
				<div class = "alerts-module"></div>				
				<div class="modal-body">
					<div class="row">
						{!! Form::open(array('url' => 'welcome/addorder','id'=>'cart_form','onsubmit'=>'javascript:return seg_user.validateCart()')) !!}
							<div id="inputs_info"></div>
						{!! Form::close() !!}
					</div>
				</div>
				<div class="modal-footer">
					<div class="col-md-8" id="totales" style="text-align: left;">
						<span>Cantidad de productos a llevar: <label id="cantidad_cart" ></label>. Total a pagar: <label id="precio_total" ></label></span>
					</div>
					<div class="col-md-4">
						<button type="submit"  form = "cart_form" id="submit_cart_modal" class="btn btn-default" >Enviar Pedido</button>
				    	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar Carro</button>
					</div>
				    
		        </div>
			</div>
		</div>
	</div>

	<!--Para captar los datos de los invitados que desean comprar-->
	<div class="modal fade" id="invitado_cart_modal" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Información de contacto</h4>
				</div>
				<div class = "alerts-module" style="font-size: 14px;"></div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							{!! Form::label('nombres', 'Nombres', array('class' => 'col-md-12 control-label')) !!}
							{!! Form::text('name_invitado_modal',null, array('id'=>'name_invitado_modal', 'class' => 'form-control','placeholder'=>'Ingresa tus Nombres')) !!}
						</div>

						<div class="col-md-12">
							{!! Form::label('direccion', 'Dirección', array('class' => 'col-md-12 control-label')) !!}
							{!! Form::text('dir_invitado_modal',null, array('id'=>'dir_invitado_modal', 'class' => 'form-control','placeholder'=>'Dirección Y Ciudad de recidencia')) !!}
						</div>

						<div class="col-md-12">
							{!! Form::label('email', 'Correo Electrónico', array('class' => 'col-md-12 control-label')) !!}
							{!! Form::email('email_invitado_modal',null, array('id'=>'email_invitado_modal', 'class' => 'form-control','placeholder'=>'Ingresa tus correo electrónico')) !!}
						</div>

						<div class="col-md-12">
							{!! Form::label('numero', 'Número Teléfonico', array('class' => 'col-md-12 control-label')) !!}
							{!! Form::text('tel_invitado_modal',null, array('id'=>'tel_invitado_modal', 'class' => 'form-control solo_numeros','placeholder'=>'Ingres un fijo o un móvil')) !!}
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<div class="col-md-12">
						<button type="submit"  form = "cart_form" id="submit_cart_modal" class="btn btn-default" >Enviar Pedido</button>
				    	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar Carro</button>
					</div>
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
	<script type="text/javascript" src="{{ url('js/chosen.jquery.min.js') }}"></script>
	<script type="text/javascript">
		//listar las reseñas
		javascript:seg_user.table_orders = $('#table_orders').DataTable( {
		    "responsive": true,
		    "processing": true,
		    "bLengthChange": false,
		    "bFilter": false,
			"ordering": false,
        	"info":     false,
		    "serverSide": true,	        
		    "ajax": "{{url('welcome/listarajaxorders')}}",	
		    "iDisplayLength": 25,       
		    "columns": [
		    	{
	                "className":      'details-control',
	                "orderable":      false,
	                "data":           null,
	                "defaultContent": ''
	            },					   

		        { "data": "name_client" },
		        { "data": "resenia",render: function ( data, type, row ) {
		        		return '<div>hola</div>';
		        	}
		    	}, 
		        { "data": "resenia_test" },
		        { "data": "date" }		        		        
		    ],	       
		    "language": {
		        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
		    },		   
		    "fnRowCallback": function( nRow, aData ) {
            }
		});

		$('.option_add_product').on('click', function (e) {
			var datos = new Array();
			datos['id'] = this.id.split('_')[1];
			datos['name'] = this.id.split('_')[0];
			seg_ajaxobject.peticionajax($('#form_add_product').attr('action'),datos,"seg_user.consultaRespuestaAddCart");					
		});

		$('#button_cart_modal').on('click', function (e) {
			//primero verifficamos la existencia de la cantidad y de las caracteristicas
			if(!$('#volume_cart_modal').val() != ''){
				$('#add_cart_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Problemas al agregar el producto!</strong> Debes agregar una cantidad en el campo: Cantidad a comprar.</div>');				
			}else{

				//verificamos la existecia de las caracteristicas
				var add = true;
				if($('#colores_cart_select option').length > 1){
					//tiene varios colores
					if($('#colores_cart_select').val() == "0"){
						//no se selecciono ninguna opción
						add = false;
						$('#add_cart_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!El producto esta disponible en uno o varios colores!</strong> Debes elejir un color para continuar.</div>');	
						
					}
				}
				if($('#sizes_cart_select option').length > 1){
					//tiene varios colores
					if($('#sizes_cart_select').val() == "0"){
						//no se selecciono ninguna opción
						add = false;
						$('#add_cart_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!El producto esta disponible en uno o varios tamaños!</strong> Debes elejir un tamaño para continuar.</div>');
					}
				}

				if($('#flavors_cart_select option').length > 1){
					//tiene varios colores
					if($('#flavors_cart_select').val() == "0"){
						//no se selecciono ninguna opción
						add = false;
						$('#add_cart_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!El producto esta disponible e uno o varios sabores!</strong> Debes elejir un sabor para continuar.</div>');	
						
					}
				}

				if($('#materials_cart_select option').length > 1){
					//tiene varios colores
					if($('#materials_cart_select').val() == "0"){
						//no se selecciono ninguna opción
						add = false;
						$('#add_cart_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!El producto esta disponible e uno o varios matariales!</strong> Debes elejir un material para continuar.</div>');
					}
				}

				var close_modal = true;
				if(add){
					//todas las caracteristicas esta devidamente diligenciadas
					var add_prod = true;
					//verificamos el objeto carrito, id_tienda, aun no funcional

					
					//verificar que el objeto no este previament agregado
					if(seg_user.cart_products.length){					
						for(var i=0; i < seg_user.cart_products.length;i++){
							if(seg_user.cart_products[i][0] == $('#id_product_cart_modal').val()){
								//ya exixte el producto id
								var color = false;								
								if(seg_user.cart_products[i][3] != ''){
									//tiene color
									if(seg_user.cart_products[i][3] == $('#colores_cart_select').val()){
										//el color es el mismo
										color = true;
									}
								}else{color =true;}

								var size = false;								
								if(seg_user.cart_products[i][4] != ''){
									//tiene tamaño
									if(seg_user.cart_products[i][4] == $('#sizes_cart_select').val()){
										//el color es el mismo
										size = true;
									}
								}else{size =true;}

								var sabor = false;								
								if(seg_user.cart_products[i][5] != ''){
									//tiene tamaño
									if(seg_user.cart_products[i][5] == $('#flavors_cart_select').val()){
										//el color es el mismo
										sabor = true;
									}
								}else{sabor =true;}

								var material = false;								
								if(seg_user.cart_products[i][6] != ''){
									//tiene tamaño
									if(seg_user.cart_products[i][6] == $('#materials_cart_select').val()){
										//el color es el mismo
										material = true;
									}
								}else{material =true;}
								
								if(color && size && sabor && material){
									//todas las caracteristicas son las mismas
									$('#add_cart_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!El producto ya se encuentra agregado!</strong> Para editar sus datos da click en el Carrito de compras.</div>');
									close_modal = false;
									add_prod = false;
									break;						

								}
															
							}
						}

						if(add_prod){
							//hay un nuevo producto por agregar
							var prod = new Array();
							prod[0] = $('#id_product_cart_modal').val();
							prod[1] = $("#price_cart_modal_span").html();
							prod[2] = $('#volume_cart_modal').val();
							prod[3] = '';
							if($('#colores_cart_select option').length > 1)prod[3] = $('#colores_cart_select').val();
							prod[4] = '';
							if($('#sizes_cart_select option').length > 1)prod[4] = $('#sizes_cart_select').val();
							prod[5] = '';
							if($('#flavors_cart_select option').length > 1)prod[5] = $('#flavors_cart_select').val();
							prod[6] = '';
							if($('#materials_cart_select option').length > 1)prod[6] = $('#materials_cart_select').val();
							prod[7] = $("label[for='prod_cart_modal_for']").html();
							prod[8] = $("#dercription_cart_modal").html();
							prod[9] = $('#prod_img_cart_modal')[0].src;
							
							//agregamos el producto en la ultima posicion					
							seg_user.cart_products[seg_user.cart_products.length] = prod;
							add_prod = true;

						}
					}else{
						//primer producto que agregar
						var prod = new Array();
						prod[0] = $('#id_product_cart_modal').val();
						prod[1] = $("#price_cart_modal_span").html();
						prod[2] = $('#volume_cart_modal').val();
						prod[3] = '';
							if($('#colores_cart_select option').length > 1)prod[3] = $('#colores_cart_select').val();
						prod[4] = '';
						if($('#sizes_cart_select option').length > 1)prod[4] = $('#sizes_cart_select').val();
						prod[5] = '';
						if($('#flavors_cart_select option').length > 1)prod[5] = $('#flavors_cart_select').val();
						prod[6] = '';
						if($('#materials_cart_select option').length > 1)prod[6] = $('#materials_cart_select').val();
						prod[7] = $("label[for='prod_cart_modal_for']").html();
						prod[8] = $("#dercription_cart_modal").html();
						prod[9] = $('#prod_img_cart_modal')[0].src;
						seg_user.cart_products[0] = prod;				
					}
					
					//agregamos el nuevo producto al objetot carrito

					//agregamos el brand al carrito
					if(add_prod){
						if($('#bange_cart').html() == ""){
							$('#bange_cart').html(1);	
						}else{
							$('#bange_cart').html(parseInt($('#bange_cart').html())+1);
						}
					}
					//cerrar el modal
					if(close_modal)$('#add_cart_modal').modal('toggle');	

				}
							
			}
		});

		//ocultamos los div de caracteristicas de los productos
		$('#div_cart_colors').hide();
		$('#div_cart_sizes').hide();
		$('#div_cart_flavors').hide();
		$('#div_cart_materials').hide();
		$('#div_cart_model').hide();
		$('#div_cart_description').hide();

		//ocultamos los div luego de una cierre del modal
		$('#add_cart_modal').on('hidden.bs.modal', function () {
			$('#div_cart_colors').hide();
			$('#div_cart_sizes').hide();
			$('#div_cart_flavors').hide();
			$('#div_cart_materials').hide();			
			$('#div_cart_model').hide();
			$('#div_cart_description').hide();
			$('#volume_cart_modal').val(1);
			//nulificamos los selects
			list = document.getElementById("colores_cart_select");
	        fistChild=list.firstChild;        
	        while (list.hasChildNodes()) {   
	            list.removeChild(list.firstChild);
	        }        
	        list.appendChild(fistChild);
	        list = document.getElementById("sizes_cart_select");
	        fistChild=list.firstChild;        
	        while (list.hasChildNodes()) {   
	            list.removeChild(list.firstChild);
	        }        
	        list.appendChild(fistChild);
	        list = document.getElementById("flavors_cart_select");
	        fistChild=list.firstChild;        
	        while (list.hasChildNodes()) {   
	            list.removeChild(list.firstChild);
	        }        
	        list.appendChild(fistChild);
	        list = document.getElementById("materials_cart_select");
	        fistChild=list.firstChild;        
	        while (list.hasChildNodes()) {   
	            list.removeChild(list.firstChild);
	        }        
	        list.appendChild(fistChild);
			
		});

		//ocultamos borramos todos los objetos del form menos en  token
		$('#cart_modal').on('hidden.bs.modal', function () {
			for(var i=0;i<$('#cart_form').children().length;i++){
				if($('#cart_form').children()[i].name != "_token"){
					if($('#cart_form').children()[i].id != "inputs_info"){
						$('#cart_form').children()[i].remove();	
					}					
				}
			}			

		});

		$( ".solo_numeros" ).keypress(function(evt) {
			 evt = (evt) ? evt : window.event;
		    var charCode = (evt.which) ? evt.which : evt.keyCode;
		    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		        return false;
		    }
		    return true;
		});

		//al cerrar el modal de captacion de informaciòn se cierre el modal de carrito
		$('#invitado_cart_modal').on('hidden.bs.modal', function () {			
			$('#cart_modal').modal('hide');			
		});

		//$('.chosen-select').chosen();
		//$('.chosen-container').width('100%');

	</script>
@endsection