@extends('app')

@section('content')	
	<style>
	.tienda_banner{
		background-image: url("{{url('users/'.$tienda[0]->user_name.'/banners/'.$tienda[0]->banner)}}");
		 background-size: 100% 125px;
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
	
	<div class="col-md-12 col-md-offset-0 tienda_banner" style="height: 125px;">	
	</div>
	
@endsection

@section('modal')	
@endsection

@section('script')
@endsection