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
			<div class="panel panel-default">
				<div class="panel-heading">ComprarJuntos te Informa</div>
				<div class="panel-body">Orden Nùmero:{{ $orden_id }} - Tienda: {{ $tienda }} </div>
				<div class="panel-footer"><a href = "{{url('/')}}"> ComprarJuntos</a></div>
			</div>			
		</div>		
	</body>
	
</html>
