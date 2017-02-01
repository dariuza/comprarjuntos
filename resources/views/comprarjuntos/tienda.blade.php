@extends('app')

@section('content')
	<style>
		.input_danger{
			color: #a94442;
    		background-color: #f2dede;
    		border-color: #ebccd1;
		}
		.option_store{
			text-align: center;
			cursor:pointer;			
		}

		.option_store a{
			text-decoration:none;			
		}
		.option_store_icon{
			font-size: 17px;
		}
		.option_store:hover{			
			color: #000 !important;
		}
		.option_store a:hover{			
			color: #000 !important;
		}
		.modal-header a:hover{
			color: #333 !important;
		}
		
	</style>
	<link  rel="stylesheet" href="{{ url('css/bootstrap-colorpicker.min.css') }}" type="text/css" />
	<link  rel="stylesheet" href="{{ url('css/bootstrap-social.css') }}" type="text/css" />
	<link  rel="stylesheet" href="{{ url('css/font-awesome.css') }}" type="text/css" />	
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
					</ul></br>						
					<div data-toggle="modal" data-target="#rpsw_modal" style = "cursor:pointer;" ><strong>Recuperar Contraseña AQUI!!!</strong></div>
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
							@if ($message  == 'Tiendas0')
								<li style="display: inline-flex;"> {{Session::get('comjunplus.usuario.names')}}, no tienes ninguna tienda que administar. No esperes màs y crea una dando click en la opciòn.&nbsp;<a href="#"><div class="" id="btn_nueva_tienda_a" data-toggle="modal" data-target="#nuevatienda_modal"><b> Crear una tienda</b></div></a> </li>
							@else
								<li>{{ $message }}</li>
							@endif
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

	<!--Listar las tiendas-->
	<div class="col-md-12 col-md-offset-0">
		@foreach(Session::get('modulo.tiendas') as $tienda)		
			<div class="col-md-2 col-mx-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading" style="background-color:{{$tienda->color_one}}; color: {{$tienda->color_two}}; border-color:{{$tienda->color_two}};">{{$tienda->name}}
						@if($tienda->status == 'Activa')
							<span class="glyphicon glyphicon-ok" aria-hidden="true" style="float: right;font-size: 20px;"></span>
						@else
							<span class="glyphicon glyphicon-remove" aria-hidden="true" style="float: right;font-size: 20px;"></span>
						@endif
						
					</div>
				    <div class="panel-body">
				    	<div class="row">
				    		<div class="col-md-12">
				    			<a href="{{url('/'.$tienda->name)}}">
				    				{{ Html::image('users/'.Session::get('comjunplus.usuario.name').'/stores/'.$tienda->image,'Imagen no disponible',array( 'style'=>'width: 100%;height: 125px;border-radius: 0%;' ))}}	    				
				    			</a>
				    			
				    		</div>
				    	</div>
				    </div>
				    <div class="panel-footer " style="background-color:{{$tienda->color_one}}; color: {{$tienda->color_two}}; border-color:
				    	{{$tienda->color_two}};">
				    	<div class="row">
				    		<div class="col-md-3 col-mx-offset-0 option_store" style="color:{{$tienda->color_two}};">
				    			<a href="{{url('/mistiendas/actualizar/'.$tienda->id.'/'.Session::get('comjunplus.usuario.id'))}}" style="color:{{$tienda->color_two}};">
				    				<span class="glyphicon glyphicon-cog option_store_icon" aria-hidden="true"></span>
				    				<div style="font-size: 10px;">Editar Tienda</div>
				    			</a>
				    		</div>
				    		<div class="col-md-3 col-mx-offset-0 option_store option_products" style="color:{{$tienda->color_two}};" id ="{{$tienda->name}}_{{$tienda->id}}"> 			
				    			<span class="glyphicon glyphicon-th option_store_icon" aria-hidden="true"></span>
				    			<div style="font-size: 10px; margin-left: -10px;">Productos</div>
				    		</div>
				    		<div class="col-md-3 col-mx-offset-0 option_store" style="color:{{$tienda->color_two}};">				    			
				    			<span class="glyphicon glyphicon-book option_store_icon"  aria-hidden="true"></span>
				    			<div style="font-size: 10px;">Pedidos</div>
				    		</div>
				    		<div class="col-md-3 col-mx-offset-0 option_store" style="color:{{$tienda->color_two}};">				    			
				    			<span class="glyphicon glyphicon-home option_store_icon" aria-hidden="true"></span>
				    			<div style="font-size: 10px;">Ver Tienda</div>
				    		</div>				    		
				    	</div>				    	
				    </div>
			   </div>				
			</div>			
		@endforeach
	</div>

@endsection

@section('modal')	
	<!-- Modal crear tienda -->
	<div class="modal fade" id="nuevatienda_modal" role="dialog" >
		<div class="modal-dialog modal-lg">
		 <!-- Modal content-->
	      <div class="modal-content">
	      	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">@if(Session::has('_old_input.edit')) Editar @else Nueva @endif Tienda</h4>
			</div>
			<div class = "alerts-module"></div>
			{!! Form::open(array('url' => Session::get('controlador').'nuevatienda', 'id'=>'form_nueva_tienda','files'=>true,'onsubmit'=>'javascript:return clu_tienda.validateNuevaTienda()')) !!}
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li role="presentation" class="active"><a href="#tab1" data-toggle="tab">Informaciòn Basica</a></li>
					<li role="presentation"><a href="#tab2" data-toggle="tab">Infomaciòn Complementaria</a></li>
					@if(Session::has('_old_input.edit'))
						<li role="presentation"><a href="#tab3" data-toggle="tab">Infomaciòn de Interes</a></li>
					@endif			
				</ul>
				<div class="tab-content">					
					<div class="tab-pane fade in active" id="tab1">
						<div class="row ">
							<div class="col-md-12 col-md-offset-0 row_init">								
								<div class="row col-md-12 ">
									<div class="col-md-4">
										<div class="form-group ">
											{!! Form::label('nombre', 'Nombre', array('class' => 'col-md-12 control-label')) !!}
											<div class="col-md-12">
												{!! Form::text('nombre',old('nombre'), array('class' => 'form-control','placeholder'=>'Ingresa el Nombre o La Razòn Social')) !!}
											</div>

											{{--
												{!! Form::label('nit', 'NIT', array('class' => 'col-md-12 control-label')) !!}
												<div class="col-md-12">
													{!! Form::text('nit',old('nit'), array('class' => 'form-control','placeholder'=>'Nùmero de identificaciòn Tributaria')) !!}
												</div>
											--}}

											{!! Form::label('departamento', 'Departamento', array('class' => 'col-md-12 control-label')) !!}
											<div class="col-md-12">
												{!! Form::select('departamento',Session::get('modulo.departamentos'),old('departamento'), array('class' => 'form-control','placeholder'=>'Departamento de Tienda')) !!}
											</div>
											
											{!! Form::label('municipio', 'Municipio', array('class' => 'col-md-12 control-label')) !!}
											<div class="col-md-12">
												{!! Form::select('municipio',Session::get('modulo.ciudades'),old('municipio'), array('class' => 'form-control','placeholder'=>'Municipio de Tienda')) !!}
											</div>
											
											{!! Form::label('direccion', 'Dirección', array('class' => 'col-md-12 control-label')) !!}
											<div class="col-md-12">
												{!! Form::text('direccion',old('direccion'), array('class' => 'form-control','placeholder'=>'Dirección de Tienda')) !!}
											</div>

											{!! Form::label('categorias', 'Categorias', array('class' => 'col-md-12 control-label')) !!}
											<div class="col-md-12">									
												<div class="input-group ">									
													{!! Form::text('categorias',old('categorias'), array('class' => 'form-control','placeholder'=>'Datos separado por una coma','aria-label'=>'Amount (to the nearest dollar)')) !!}
													<span class="input-group-addon" data-toggle="tooltip" title="Las categorias agrupan los diferentes productos de la tienda. Ejemplo: bisuterìa,accesorios,regalos">?</span>
												</div>
											</div>

											
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group ">
											
											{!! Form::label('color_uno', 'Color Primario', array('class' => 'col-md-12 control-label')) !!}
											<div class="col-md-12">
												<div id="cp1" class="input-group colorpicker-component">
													@if(old('color_uno'))
														{!! Form::text('color_uno',old('color_uno'), array('class' => 'form-control sample-selector','placeholder'=>'Color Primario de tu tienda')) !!}
													@else
														{!! Form::text('color_uno','#ddd', array('class' => 'form-control sample-selector','placeholder'=>'Color Primario de tu tienda')) !!}
													@endif
													
													<span class="input-group-addon"><i></i></span>
												</div>
											</div>

											{!! Form::label('color_dos', 'Color Secundario', array('class' => 'col-md-12 control-label')) !!}
											<div class="col-md-12">
												<div id="cp2" class="input-group colorpicker-component">
													@if(old('color_dos'))
														{!! Form::text('color_dos',old('color_dos'), array('class' => 'form-control sample-selector','placeholder'=>'Color Secundario de tu tienda')) !!}											
													@else
														{!! Form::text('color_dos','#333', array('class' => 'form-control sample-selector','placeholder'=>'Color Secundario de tu tienda')) !!}											
													@endif
													<span class="input-group-addon"><i></i></span>
												</div>
											</div>

											{!! Form::label('descripcion', 'Descripciòn', array('class' => 'col-md-12 control-label')) !!}
											<div class="col-md-12">
												{!! Form::textarea('descripcion',old('descripcion'), array('class' => 'form-control','rows' => 7,'placeholder'=>'Descripciòn de tu Tienda')) !!}
											</div>

										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group" >
											<div class="col-md-12" style="text-align: center; margin-bottom: 9px;">
												{!! Form::label('img_store', 'Imagen de Tienda', array('class' => 'col-md-12 control-label')) !!}
												@if( old('img_store'))
													{{ Html::image('users/'.Session::get('comjunplus.usuario.name').'/stores/'.old('img_store'),'Imagen no disponible',array( 'style'=>'width: 90%; border:2px solid #ddd;border-radius: 0%;'))}}
												@else
													{{ Html::image('users/'.Session::get('comjunplus.usuario.name').'/stores/default.png','Imagen no disponible',array( 'style'=>'width: 90%; border:2px solid #ddd;border-radius: 0%;'))}}
												@endif												
											</div>
											<div>
												{!! Form::file('image_store',array('id'=>'image_store','style'=>'font-size: 14px;')) !!}
											</div>
											<div class="col-md-12" style="margin-top: 28px;">		
												<button id="to_tab2" type="button" class="btn btn-default" style="width: 100%;">Siguiente >></button>												
											</div>
											
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<div class="tab-pane fade " id="tab2">
						<div class="row ">
							<div class="col-md-12 col-md-offset-0 row_init">								
								<div class="row col-md-12 ">
									<div class="col-md-4">
										<div class="form-group ">
											<label for="sitio_web" class="col-md-12 control-label"><span class="fa fa-soundcloud"></span>  Sitio Web</label>												
											<div class="col-md-12">
												{!! Form::text('sitio_web',old('sitio_web'), array('class' => 'form-control','placeholder'=>'URL del sitio de tu tienda')) !!}
											</div>

											<label for="facebook_web" class="col-md-12 control-label"><span class="fa fa-facebook"></span>  Pàgina de Facebook</label>
											<div class="col-md-12">
												{!! Form::text('facebook_web',old('facebook_web'), array('class' => 'form-control','placeholder'=>'URL de la FanPage de Facebook')) !!}
											</div>

											<label for="movil" class="col-md-12 control-label"><span class="fa fa-whatsapp"></span>  Movil WhatsUP</label>											
											<div class="col-md-12">
												{!! Form::text('movil',old('movil'), array('class' => 'form-control','placeholder'=>'Ìngresa un nùmero de Celular')) !!}
											</div>

											<label for="ubicacion" class="col-md-12 control-label"><span class="fa fa-google"></span>  Ubicaciòn</label>											
											<div class="col-md-12">
												<div class="input-group">	
													{!! Form::text('ubicacion',old('ubicacion'), array('class' => 'form-control','placeholder'=>'Ubicaciòn en Google Maps')) !!}
													<span class="input-group-addon" style="cursor: pointer;"  data-toggle="modal" data-target="#guiaubicacion_modal">?</span>
												</div>
											</div>

											{!! Form::label('prioridad', 'Prioridad' , array('class' => 'col-md-12 control-label')) !!} 
											<div class="col-md-12"><div class="input-group ">									
													{!! Form::text('prioridad',old('prioridad'), array('class' => 'form-control','placeholder'=>'Prioridad de la Tienda para ComprarJuntos')) !!}
													<span class="input-group-addon" data-toggle="tooltip" title="La prioridad es un nùmero que indica el orden en el cual se listaran las tiendas dentro de ComprarJuntos.">?</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group " style="text-align: center;";>
											{!! Form::label('img_banner', 'Imagen Tipo Banner' , array('class' => 'col-md-12 control-label')) !!}
											<div class="col-md-12">
												Un Banner es una imagen ubicada en la parte superior de la tienda, su objetivo es dar la bienvenida a los visitantes, la cùal puede tratarse de un mensaje de amor y paz, una promociòn o una metafora visual de la mision y la visiòn de la tienda.
											</div>

											<div class="col-md-12" style="text-align: center; margin-bottom: 9px; margin-top: 9px;">
												@if( old('img_banner'))
													{{ Html::image('users/'.Session::get('comjunplus.usuario.name').'/banner/'.old('img_banner'),'Imagen no disponible',array( 'style'=>'width: 90%; border:2px solid #ddd;border-radius: 0%;'))}}
												@else
													{{ Html::image('users/'.Session::get('comjunplus.usuario.name').'/banner/default.png','Imagen no disponible',array( 'style'=>'width: 90%; border:2px solid #ddd;border-radius: 0%;'))}}
												@endif
											</div>
											<div class="col-md-12" style="text-align: center;">
												{!! Form::file('image_banner',array('id'=>'image_banner','style'=>'font-size: 14px;')) !!}
										</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@if(Session::has('_old_input.edit'))
					<div class="tab-pane fade " id="tab3">
						<div class="row ">
							<div class="col-md-12 col-md-offset-0 row_init">								
								<div class="row col-md-12 ">
									<div class="col-md-4">
										<div class="form-group ">
											{!! Form::label('estado', 'Estado', array('class' => 'col-md-12 control-label')) !!}
											<div class="col-md-12">											
											@if(old('status') == 'Activa' )												
												<div>{{Form::radio('estado', 'Activa', true)}} Activa</div>
												<div>{{Form::radio('estado', 'Desactiva', false)}} Desactiva</div>		
											@else
												<div>{{Form::radio('estado', 'Activa', false)}} Activa</div>
												<div>{{Form::radio('estado', 'Desactiva', true)}} Desactiva</div>
											@endif
											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>											
					</div>
					@endif				
				</div>				
			</div>
			{!! Form::hidden('edit', old('edit')) !!}
			{!! Form::hidden('store_id', old('store_id')) !!}
			{!! Form::close() !!}
			<div class="modal-footer">
		          <button type="submit" form = "form_nueva_tienda" class="btn btn-default " > @if(Session::has('_old_input.edit')) Editar @else Crear @endif Tienda</button>
		          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>		                  
		        </div>
	      	</div>
		</div>
	</div>

	<div class="modal fade" id="guiaubicacion_modal" role="dialog" >
		<div class="modal-dialog modal-lg">
		 <!-- Modal content-->
	      <div class="modal-content">
	      	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Guia para el Campo Ubicaciòn de una Tienda</h4>
			</div>
			<div class = "alerts-module"></div>
			<div class="modal-body">
				<div class="row ">
					<div class="col-md-12 col-md-offset-0 row_init">
					</div>
				</div>
			</div>
			<div class="modal-footer">		         
		          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>		                  
		        </div>
	      	</div>
		</div>
	</div>

	<div class="modal fade" id="productos_modal" role="dialog" >
		<div class="modal-dialog modal-lg">
		 <!-- Modal content-->
	      <div class="modal-content">
	      	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Productos Tienda</h4>
				<a href="#" style="text-decoration: none; color: #777">
				<div class="" id="btn_nuevo_producto" data-toggle="modal" data-target="#nuevoproducto_modal">
					<span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: 12px;"></span>
					<span>Crear un Producto</span>
				</div>
				</a>
			</div>
			<div class = "alerts-module"></div>
			<div class="modal-body">
				<div class="row ">
					<div class="col-md-12 col-md-offset-0 row_init">
						<table id="example" class="display responsive no-wrap " cellspacing="0" width="100%">
					         <thead>
					            <tr>					            	
			            			<th>Nombre</th>
			            			<th>Precio</th>
			            			<th>Categorìa</th>
			            			<th>Descripciòn</th>
					            </tr>
					        </thead>              
					    </table> 
					</div>
				</div>
			</div>
			<div class="modal-footer">				
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>		                  
		        </div>
	      	</div>
		</div>
	</div>

	<div class="modal fade" id="nuevoproducto_modal" role="dialog" >
		<div class="modal-dialog">
			<div class="modal-content">
		      	<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Nuevo Producto</h4>				
				</div>
				<div class = "alerts-module"></div>
				<div class="modal-body">
				</div>
			</div>
		</div>
	</div>

	<!-- Form en blanco para consultar Ciudades -->
	{!! Form::open(array('id'=>'form_consult_city','url' => 'user/consultarcity')) !!}		
    {!! Form::close() !!}

    {!! Form::open(array('id'=>'form_consult_products','url' => 'mistiendas/consultarproducts')) !!}		
    {!! Form::close() !!}


@endsection
@section('script')
	<script type="text/javascript" src="{{ url('js/bootstrap-colorpicker.min.js') }}"></script>
	<script type="text/javascript">
		$( "#departamento" ).change(function() {
			var datos = new Array();
			datos['id'] =$( "#departamento option:selected" ).val();			   
			seg_ajaxobject.peticionajax($('#form_consult_city').attr('action'),datos,"seg_user.consultaRespuestaCity");
		});
		
		$('[data-toggle="tooltip"]').tooltip();
		
		$('#cp1').colorpicker({ /*options...*/ });
		$('#cp2').colorpicker({ /*options...*/ });
		$('.sample-selector').colorpicker({ /*options...*/ });
		
		$('#to_tab2').on('click', function (e) {
		    $('.nav-tabs a[href="#tab2"]').tab('show');
		});

		//Consultar los productos de la tienda
		$('.option_products').on('click', function (e) {
			var datos = new Array();
			datos['id'] = this.id.split('_')[1];
			datos['name'] = this.id.split('_')[0];			
		    seg_ajaxobject.peticionajax($('#form_consult_products').attr('action'),datos,"clu_tienda.consultaRespuestaProducts",false);

		    //llamado sincrono, para cambiar el id de tienda

		    javascript:clu_tienda.table = $('#example').DataTable( {		
			    "responsive": true,
			    "columnDefs": [
			        { responsivePriority: 1, targets: 0 },
			        { responsivePriority: 2, targets: -1 }
	    		],
			    "processing": true,
			    "bLengthChange": false,
			    "serverSide": true,
			    "bDestroy": true,      
			    "ajax": "{{url('mistiendas/listarajax')}}",
			    "iDisplayLength": 25,     	       
			    "columns": [				   
					{ "data": "name"},
					{ "data": "price"},		        
					{ "data": "category"},  	    
			        { "data": "description"}		                   
			    ],       
			    "language": {
			        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
			    },
			});
		});		

	</script>
	@if(old('edit'))		
		<script> $("#nuevatienda_modal").modal(); </script>
	@endif	
@endsection