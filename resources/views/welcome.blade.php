@extends('app')
@section('content')
	<style>
		.input_danger{
			color: #a94442;
    		background-color: #f2dede;
    		border-color: #ebccd1;
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
						@if ($message  == 'Perfil1')
							<li>  El perfil de usuario se halla ubicado en la esquina superior derecha al desplegar las opciones del botón que tiene tu nombre de usuario: {{Session::get('comjunplus.usuario.name')}}.  <a  href="{{ url('/perfil/'.Session::get('comjunplus.usuario.id')) }}">Ó dando CLICK AQUI</a>  </li>													
						@elseif ($message  == 'Perfil2' || $message  == 'Perfil3')						
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
				</ul></br>
				<div data-toggle="modal" data-target="#rpsw_modal" style = "cursor:pointer;" ><strong>Recuperar Contraseña AQUI!!!</strong></div>
			</div>                
		@endif
	</div>
	</div>
	
	<div class="title m-b-md col-md-12">
		<div class="btn-group" role="group">
		@foreach ($categorias as $llave_categoria => $categoria)
			<button type="button" class="btn btn-default">{{$categoria->name}}</button>			
		@endforeach
		</div>
	</div>
@endsection

@section('modal')
	
	<!-- Modal para cambiar de pasword -->
	<div class="modal fade" id="cpsw_modal" role="dialog" >
	    <div class="modal-dialog  modal-sm">    
	      <!-- Modal content-->
	      <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cambiar contraseña</h4>
				</div>
				<div class = "alerts-module"></div>				
				<div class="modal-body">
					<div class="row ">
						<div class="col-md-12 col-md-offset-0 row_init">
							{!! Form::open(array('id'=>'cpsw','url' => '/cambiarcontraseña','method'=>'get','onsubmit'=>'javascript:return seg_user.validatePassword()')) !!}
				        		<div class="form-group">
									{!! Form::hidden('usuario', Session::get('user.name')) !!}
									{!! Form::label('contraseña_uno', 'Contraseña', array('class' => 'col-md-12 control-label')) !!}
									<div class="col-md-12">
										{!! Form::password('contraseña', array('class' => 'form-control','placeholder'=>'Ingresa tu nueva contraseña', 'autofocus'=>'autofocus')) !!}
									</div>
									
									{!! Form::label('contraseña_dos', 'Contraseña Nuevamente', array('class' => 'col-md-12 control-label')) !!}
									<div class="col-md-12" data-toggle="modal" data-target="#rpsw_modal">
										{!! Form::password('contraseña_dos', array('class' => 'form-control','placeholder'=>'Ingresa nuevamente tu contraseña')) !!}
									</div>
									
								</div>
								      
					        {!! Form::close() !!}
						</div>						
					</div>
		        </div>
		        <div class="modal-footer">
		          <button type="submit" form = "cpsw" class="btn btn-default " >Enviar</button>
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
	@else
	<!-- Modal para usuarios logueados-->
	<!-- Modal para editar datos de perfil -->
	<div class="modal fade" id="cpep_modal" role="dialog" >
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Editar Datos de Perfil {{Session::get('comjunplus.usuario.name')}}</h4>
				</div>
				<div class = "alerts-module"></div>	
				<div class="modal-body col-md-12">
					
					{!! Form::open(array('id'=>'cpfep','url' => '/editarperfil','method'=>'post','files'=>true,'onsubmit'=>'javascript:return seg_user.validateEditPerfil()')) !!}
					<div class="row col-md-12 ">
					{!! Form::hidden('usuario_id', Session::get('comjunplus.usuario.id')) !!}	
					<div class="col-md-4">																			
						<div class="form-group ">														
							{!! Form::label('usuario', 'Usuario', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::text('usuario',value(Session::get('comjunplus.usuario.name')), array('class' => 'form-control','placeholder'=>'Ingresa tu nombre de usuario','disabled'=>'disabled')) !!}
							</div>
							
							{!! Form::label('nombres', 'Nombres', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::text('nombres',value(Session::get('comjunplus.usuario.names')), array('class' => 'form-control','placeholder'=>'Nombres completos', 'autofocus'=>'autofocus')) !!}
							</div>
							
							{!! Form::label('apellidos', 'Apellidos', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::text('apellidos',value(Session::get('comjunplus.usuario.surnames')), array('class' => 'form-control','placeholder'=>'Apellidos completos')) !!}
							</div>
							
							{!! Form::label('identificacion', 'Identificación', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::text('identificacion',value(Session::get('comjunplus.usuario.identificacion')), array('class' => 'form-control','placeholder'=>'C.C, C.E ó T.I')) !!}
							</div>
							
							{!! Form::label('fecha_nacimiento', 'Fecha de Nacimiento', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">																
								{!! Form::text('fecha_nacimiento',value(Session::get('comjunplus.usuario.birthdate')), array('class' => 'form-control','placeholder'=>'aaaa-mm-dd')) !!}								
							</div>	
							
							{!! Form::label('correo_electronico', 'Correo Electronico', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::text('correo_electronico',value(Session::get('comjunplus.usuario.email')), array('class' => 'form-control','placeholder'=>'Ingresa tu email')) !!}
							</div>
																							
						</div>						
					</div>
					
					<div class=" col-md-4 ">						
						<div class="form-group ">								
													
							{!! Form::label('departamento', 'Departamento', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::select('departamento',$departamentos,value(Session::get('comjunplus.usuario.state')), array('class' => 'form-control','placeholder'=>'Departamento de residencia')) !!}
							</div>
							
							{!! Form::label('municipio', 'Municipio', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::select('municipio',$ciudades,value(Session::get('comjunplus.usuario.city')), array('class' => 'form-control','placeholder'=>'Municipio de recidencia')) !!}
							</div>
							
							{!! Form::label('direccion', 'Dirección', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::text('direccion',value(Session::get('comjunplus.usuario.adress')), array('class' => 'form-control','placeholder'=>'Dirección Recidencial')) !!}
							</div>	
							
							{!! Form::label('telefono_movil', 'Teléfono Fijo', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::text('telefono_fijo',value(Session::get('comjunplus.usuario.fix_number')), array('class' => 'form-control','placeholder'=>'Ingresa tu Fijo')) !!}
							</div>
							
							{!! Form::label('telefono_movil', 'Teléfono Móvil', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::text('telefono_movil',value(Session::get('comjunplus.usuario.movil_number')), array('class' => 'form-control','placeholder'=>'Ingresa tu Celular')) !!}
							</div>
							
							{!! Form::label('fuente', 'Fuente Tipográfica', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::select('fuente_tipografica',array('default' => 'default', 'flowers' => 'flowers'),value(Session::get('comjunplus.usuario.template')), array('class' => 'form-control','placeholder'=>'Elige Una fuente tipografica')) !!}			
							</div>
																						
						</div>						
					</div>

					<div class=" col-md-4 ">	
						<div class="form-group ">
							{!! Form::label('img_user', 'Imagen de Usuario', array('class' => 'col-md-12 control-label')) !!}
							{{ Html::image('users/'.Session::get('comjunplus.usuario.name').'/profile/'.Session::get('comjunplus.usuario.avatar'),'Imagen no disponible',array( 'style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;' ))}}
							
						</div>
						<div>
							{!! Form::file('image',array('id'=>'img_user','style'=>'font-size: 14px;')) !!}
						</div>
					</div>
					
					</div>
					
					{!! Form::close() !!}
					</div><!-- Cierre de modal body -->				
				
				<div class="modal-footer">
		          <button type="submit" form = "cpfep" class="btn btn-default " >Enviar</button>
		          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>		                  
		        </div>
		         
			</div>
		 </div>
	</div>
	
	@endif	

	{!! Form::open(array('id'=>'form_consult_city','url' => 'user/consultarcity')) !!}		
    {!! Form::close() !!}

@endsection

@section('script')
	<!-- Cambio de Contraseña -->
	@if(Session::has('user'))		
		<script> $("#cpsw_modal").modal(); </script>
	@endif
	<!-- Perfil de usuario -->
	@if(Session::has('message'))
		@if(in_array('Perfil2',Session::get('message')))
			<script> 
				$("#cpep_modal").modal(); 
				$('#cpep_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!El perfil de usuario esta incompleto!</strong> Faltan campos por diligenciar.</div>');
			</script>
		@endif
		@if(in_array('Perfil3',Session::get('message')))
			<script> 
				$("#cpep_modal").modal();
				$('#cpep_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!El perfil de usuario esta incompleto!</strong> Para crear tu primer tienda primero debes diligenciar la informaciòn de tu perfil de usuario.</div>');
			</script>
		@endif		
	@endif
	<script type="text/javascript">  
		$('#fecha_nacimiento').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true,			
			language: "es"
		});
		$( "#departamento" ).change(function() {
			var datos = new Array();
			datos['id'] =$( "#departamento option:selected" ).val();			   
			seg_ajaxobject.peticionajax($('#form_consult_city').attr('action'),datos,"seg_user.consultaRespuestaCity");
		});
	</script>
@endsection
