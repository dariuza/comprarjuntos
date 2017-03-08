<html lang="es">
	<style>
		.panel{
			width: 40%;
			margin: auto;			
			border-radius: 6px;
			font-family: 'Dosis', sans-serif;
			font-size: 18px;			
			line-height: 1.42857143;
			color: #333;

			box-shadow: 0 5px 15px rgba(0,0,0,.5);

			border: 1px solid rgba(0,0,0,.2);
		}

		.panel-heading{
			/*text-align: center;*/
			padding: 15px;
			border-bottom: 1px solid #e5e5e5;
			background: #dddddd;
			/*color:777777;*/
			color: cadetblue;
		}

		.panel-body{
			padding: 15px;
			font-size: 16px;
			/*color: cadetblue;*/
		}

		.panel-footer{
			text-align: center;
			padding: 15px;
			font-size: 15px;
			border-top: 1px solid #e5e5e5;
			background: #dddddd;
			/*color:777777;*/
			color: cadetblue;			
		}

		a{
			text-decoration: none;
			color: cadetblue;
		}

	</style>	
	<body>
		<div class="container-fluid">			
			<div class="panel panel-default" style="width: 65%;margin: auto;border-radius: 6px;font-family: 'Dosis', sans-serif;font-size: 18px;line-height: 1.42857143;color: #333;box-shadow: 0 5px 15px rgba(0,0,0,.5);border: 1px solid rgba(0,0,0,.2);">
				<div class="panel-heading" style="padding: 15px;border-bottom: 1px solid #e5e5e5;background: #dddddd;">{{ strtoupper($tienda) }} te Informa</div>
				<div class="panel-body" style="padding: 15px;font-size: 16px;">
					<div>Una nueva Orden de Pedido ha llegado a tu tienda.</div>
					<div>Nùmero de Orden :{{ $orden_id }}</div>					
					<ul>
						<div>DATOS DEL CLIENTE</div>
						<li>Nombre: {{$nombre_cliente}}</li>
						<li>Dirección: {{$adress_client}}</li>
						<li>Correo Electrónico: {{$email_client}}</li>
						<li>Teléfono: {{$number_client}}</li>
					</ul>
				</div>
				<div class="panel-footer" style="text-align: center;padding: 15px;font-size: 15px;border-top: 1px solid #e5e5e5;background: #dddddd;color: cadetblue;">
					<a href = "{{url('/'.$tienda)}}"> ComprarJuntos -{{$tienda}} </a>
				</div>
			</div>			
		</div>		
	</body>
	
</html>
