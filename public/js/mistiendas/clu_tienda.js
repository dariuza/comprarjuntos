function clu_tienda() {
	this.datos_pie = [];
	this.table = '';
	this.fillable = ['Nombre','Precio','Categorìa','Descripciòn'];
	
}

clu_tienda.prototype.onjquery = function() {
};

clu_tienda.prototype.opt_select = function(controlador,metodo) {
	
	if(clu_tienda.table.rows('.selected').data().length){		
		window.location=metodo + "/" + clu_tienda.table.rows('.selected').data()[0]['id'];
	}else{
		$('.alerts').html('<div class="alert alert-info fade in"><strong>¡Seleccione un registro!</strong>Esta opción requiere la selección de un registro!!!.<br><br><ul><li>Selecciona un registro dando click sobre él, luego prueba nuevamente la opción</li></ul></div>');
	}
};

clu_tienda.prototype.validateNuevaTienda = function() {
	
	if($("#form_nueva_tienda :input")[1].value =="" || $("#form_nueva_tienda :input")[2].value =="" || $("#form_nueva_tienda :input")[3].value =="" || $("#form_nueva_tienda :input")[4].value ==""  || $("#form_nueva_tienda :input")[8].value ==""){
		$('#nuevatienda_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close close_alert_edit_perfil" data-dismiss="alert">&times;</button><strong>!Envio Fallido!</strong></br> Faltan campos por diligenciar.</div>');
		//pintar los inputs problematicos
		for(var i=0; i < $("#form_nueva_tienda :input").length ; i++){
	        if( i==1 || i==2 || i==3 || i==4 || i==8) {
	            if($("#form_nueva_tienda :input")[i].value ==""){
	                $($("#form_nueva_tienda :input")[i]).addClass('input_danger');
	            }
	            if($("#form_nueva_tienda :input")[8].value ==""){
	            	$(".categorias").addClass('input_danger');
	            }
	        }
        }
        $(".close_alert_edit_perfil").on('click', function () { 
        	$("#form_nueva_tienda :input").removeClass("input_danger");
        	$(".categorias").removeClass('input_danger');
        });
		return false;
	}
	
	return true;
};

clu_tienda.prototype.validateNuevoProducto = function() {
	if($("#form_nuevo_producto :input")[1].value =="" || $("#form_nuevo_producto :input")[2].value ==""){
		$('#nuevoproducto_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close close_alert_product" data-dismiss="alert">&times;</button><strong>!Envio Fallido!</strong></br> Faltan campos por diligenciar.</div>');
		//pintar los inputs problematicos
		for(var i=0; i < $("#form_nuevo_producto :input").length ; i++){
	        if( i==1 || i==2 ) {
	            if($("#form_nuevo_producto :input")[i].value ==""){
	                $($("#form_nuevo_producto :input")[i]).addClass('input_danger');
	            }	            
	        }
        }
        $(".close_alert_product").on('click', function () { 
        	$("#form_nuevo_producto :input").removeClass("input_danger");        	
        });
		return false;
	}
	return true;
}

clu_tienda.prototype.consultaRespuestaProducts = function(result) {

	$('#productos_modal .modal-title').html('Productos Tienda '+result.request.name);
	if(!result.productos){
		$('#productos_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!La tienda aùn no tiene Productos!</strong></br> Para crear un nuevo producto, no esperes màs y crea un producto dando click en la opciòn <a href="#"><div class="" id="btn_nueva_tienda_a" data-toggle="modal" data-target="#nuevoproducto_modal"><b> Crear un Producto</b></div></a></div>');
	}
	$('#productos_modal').modal();
	//llenamos el select de categorias
	categoria_select=document.getElementById('categoria_select')
	categoria_select.innerHTML = "";
	for (var key in result.data) {
		var opt = document.createElement('option');
		opt.value = key;
		opt.innerHTML = result.data[key];
		categoria_select.appendChild(opt);
	}
	//actualiza el select dinamico
	$('#categoria_select').trigger("chosen:updated");
	
	$('#productos_modal').modal();
};

clu_tienda.prototype.consultaRespuestaProduct = function(result) {
	clu_tienda.row.child( clu_tienda.format(clu_tienda.row.data())).show();
};

clu_tienda.prototype.format= function(d) {    			
    return ''+
    '<div class="panel panel-default">'+
    	'<div class="panel-heading">'+
    		'<a href="#" style="text-decoration: none; color: #777">'+
				'<div class="" id="btn_editar_producto" data-toggle="modal" data-target="#nuevoproducto_modal">'+
					'<span class="glyphicon glyphicon-cog" aria-hidden="true" style=""></span>'+
					'<span> Editar este Producto</span>'+
				'</div>'+
			'</a>'+
    	'</div>'+			        
    	'<div class="panel-body">'+
			'<div class="row">'+
				'<div class="col-md-12">'+
					'<div class="col-md-8 product_more">'+
						'<label for="description" class="col-md-12 control-label">Descripciòn</label>'+
						''+d.description+
					'</div'+
					'<div class="col-md-4">'+
					'</div'+
				'</div>'+
			'</div>'+
    	'</div>'+    
    '</div>';
};

var clu_tienda = new clu_tienda();



