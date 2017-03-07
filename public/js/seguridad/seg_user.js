function seg_user() {
	
	this.btn_editar = 1 ;
    this.cart_store_id;//esta variable de momento no se usara, incapasidad de ser global
    this.cart_products = new Array();
    this.cart_contador = 1;
    //refrescamos el brand del carrito de compras, ante el refresh de seg_user
}
	
seg_user.prototype.onjquery = function() {	
};

seg_user.prototype.validateLogin = function() {
	
	if($("#login :input")[0].value =="" || $("#login :input")[1].value ==""){
		$('#login_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Ingreso Fallido!</strong> Faltan campos por diligenciar.</div>');
		return false;
	}
	return true;
};

seg_user.prototype.validateRegistry = function() {
	if($("#registry :input")[0].value =="" || $("#registry :input")[2].value =="" || $("#registry :input")[3].value ==""){
		$('#registry_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Registro Fallido!</strong></br> Faltan campos por diligenciar.</div>');
		return false;
	}else{
		if($("#registry :input")[2].value != $("#registry :input")[3].value){	
			$('#registry_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Registro Fallido!</strong></br> La Contraseña no coincide.</div>');
			return false;
		}
	}	
	return true;
};

seg_user.prototype.validatePassword = function() {
	if($("#cpsw :input")[0].value =="" || $("#cpsw :input")[1].value =="" || $("#cpsw :input")[2].value ==""){
		$('#cpsw_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Registro Fallido!</strong></br> Faltan campos por diligenciar.</div>');
		return false;
	}else{
		if($("#cpsw :input")[1].value != $("#cpsw :input")[2].value){	
			$('#cpsw_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Registro Fallido!</strong></br> La Nueva contraseña no coincide.</div>');
			return false;
		}
	}	
	return true;
};

seg_user.prototype.validateEditPerfil = function(){
	if($("#cpfep :input")[2].value =="" || $("#cpfep :input")[3].value =="" || $("#cpfep :input")[6].value =="" || $("#cpfep :input")[7].value =="" || $("#cpfep :input")[8].value =="" || $("#cpfep :input")[9].value =="" || $("#cpfep :input")[10].value ==""){
		$('#cpep_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close close_alert_edit_perfil" data-dismiss="alert">&times;</button><strong>!Envio Fallido!</strong></br> Faltan campos por diligenciar.</div>');
		//pintamos los input faltantes
        for(var i=0; i < $("#cpfep :input").length ; i++){
            if( i==3 || i==6 || i==6 || i==8 || i==9 || i==10) {
                if($("#cpfep :input")[i].value ==""){
                    $($("#cpfep :input")[i]).addClass('input_danger');
                }
            }
        }
        //agregamos funcion a boton cierre
        $(".close_alert_edit_perfil").on('click', function () { $("#cpfep :input").removeClass("input_danger"); });
        return false;
	}
	return true;
};

seg_user.prototype.validateCart = function(){
    //verificacmos que se halle logueado, que sea un usuario de la aplicaciòn
    if($('#value_login').val() == "0"){
        //verificamos los inputs
        if( $('#name_invitado').val() && $('#dir_invitado').val() && $('#email_invitado').val()){
            return true;
        }

        if( $('#name_invitado').val() && $('#dir_invitado').val() && $('#tel_invitado').val()){
            return true;
        }
        
        //desplegamos el modal de captura de información basica
        //$('#invitado_cart_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Aún no haces parte de ComprarJuntos!</strong> Diligencia el siguiente formulario para continuar con el pedido.</div>');
        $('#invitado_cart_modal').modal();

        //vinculamos los datos
        $("#name_invitado_modal").change(function(e) {
            $("#name_invitado").val(this.value);
        });
        $("#name_invitado_modal").keyup(function(e) {
           $("#name_invitado").val(this.value); 
        });
        $("#dir_invitado_modal").change(function(e) {
            $("#dir_invitado").val(this.value);
        });
        $("#dir_invitado_modal").keyup(function(e) {
           $("#dir_invitado").val(this.value); 
        });
        $("#email_invitado_modal").change(function(e) {
            $("#email_invitado").val(this.value);
        });
        $("#email_invitado_modal").keyup(function(e) {
           $("#email_invitado").val(this.value); 
        });
        $("#tel_invitado_modal").change(function(e) {
            $("#tel_invitado").val(this.value);
        });
        $("#tel_invitado_modal").keyup(function(e) {
           $("#tel_invitado").val(this.value); 
        });

        return false;
    }    
    return true;
    
};


seg_user.prototype.lugarRespuesta = function(result) {
	//se evalua la respuesta
	if(result.respuesta){		
		$('.bnt_lugar').toggle();
		//crear alert
		if(result.data.usuario.lugar.active){
			$('.alerts').html('<div class="alert alert-success fade in"><strong>¡Activación de Escritorio!</strong> el escritorio esta activado.<br><br><ul><li>Ahora todos los mudulos consultan directamente a al escritorio</li></ul></div>');
		}else{
			$('.alerts').html('<div class="alert alert-info fade in"><strong>¡Activación de Papelera!</strong> La pepelera esta activada.<br><br><ul><li>Ahora todos los mudulos consultan directamente a la papelera</li></ul></div>');			
		}
		location.reload();
	}else{
		alert('Problemas con el cambio de lugar');		
	}
	
};
	
seg_user.prototype.edit = function(this_val) {
	if($("#form_user").size()){
		
		this.btn_editar = this.btn_editar*-1;
		var j=0;
		if(this.btn_editar == -1){
			$($(this_val.children).get(1)).html('Deshabilitar edición');
			for(var i=0; i < $("#form_user .panel-body").children().length; i++){
				if($("#form_user .panel-body").children().get(i).classList.contains('input-grp')){
					$($("#form_user .panel-body").children().get(i).children[1]).children().prop("disabled", false);
				}				
			}
			//mostramos el boton
			$($("#form_user").children().get($("#form_user").children().length-1)).children().children().show();
			
		}else{
			$($(this_val.children).get(1)).html('Habilitar edición');
			for(var i=0; i < $("#form_user .panel-body").children().length; i++){
				if($("#form_user .panel-body").children().get(i).classList.contains('input-grp')){
					$($("#form_user .panel-body").children().get(i).children[1]).children().prop("disabled", true)
				}				
			}
			//ocultar el boton
			$($("#form_user").children().get($("#form_user").children().length-1)).children().children().hide()
		}			
	}		
};
	
seg_user.prototype.iniciarDatepiker = function(obj) {
	$( "#"+obj ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
};
seg_user.prototype.changeImg = function(input){
	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#nueva_img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
};

seg_user.prototype.iniciarPie= function(contenedor_id,titulo,datos,colores){	
	if (colores === undefined || colores === null) {
		colores = ['#7cb5ec', '#434348', '#90ed7d', '#f7a35c', '#8085e9','#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1']
	}	
	$(contenedor_id).highcharts({
        chart: {
        	renderTo: 'chartcontainer',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'            
        },
        title: {
            text: titulo
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        lang:{
        	printChart : 'Descargar imagen',
        	downloadPNG : 'Descargar imagen PNG',        	
        	downloadJPEG : 'Descargar imagen JPEG',
        	downloadPDF : 'Descargar imagen PDF',
        	downloadSVG : 'Descargar imagen vectorial SVG',
        },
        
        plotOptions: {        	  
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',                              
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'                      
                    
                    }
                }
            }
        },
        colors: colores,
        series: [{
            name: "Porcentaje",
            colorByPoint: true,
            data: datos,
            point:{
                events:{
                    click: function (event) {
                        //alert(this.x + " " + this.y + " " + this.name);
                    }
                }
            }  
        }]
    });
};

seg_user.prototype.iniciarBar= function(contenedor_id,titulo_uno,titulo_dos,datos,categorias){
	$(contenedor_id).highcharts({
		chart: {
			renderTo: 'chartcontainer',
            type: 'bar'
        },
        title: {
            text: titulo_uno
        },
        xAxis: {
            categories: categorias
        },
        yAxis: {
            min: 0,
            title: {
                text: titulo_dos
            }
        },
        legend: {
            reversed: true
        },
        lang:{
        	printChart : 'Descargar imagen',
        	downloadPNG : 'Descargar imagen PNG',        	
        	downloadJPEG : 'Descargar imagen JPEG',
        	downloadPDF : 'Descargar imagen PDF',
        	downloadSVG : 'Descargar imagen vectorial SVG',
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
        series: datos
	});
};

seg_user.prototype.iniciarMultiBar= function(contenedor_id,titulo_uno,titulo_dos,titulo_tres,datos,categorias){
	$(contenedor_id).highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: titulo_uno
        },
        subtitle: {
            text: titulo_dos
        },
        xAxis: {
            categories: categorias,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: titulo_tres
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: datos
    });
};

seg_user.prototype.iniciarPila= function(contenedor_id,titulo_uno,titulo_dos,datos,categorias){
	$(contenedor_id).highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: titulo_uno
        },
        xAxis: {
            categories: categorias
        },
        yAxis: {
            min: 0,
            title: {
                text: titulo_dos
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: datos
    });
};

seg_user.prototype.consultaRespuestaCity = function(result) {    

    var list = document.getElementById("municipio");
    fistChild=list.firstChild;
    
    while (list.hasChildNodes()) {   
        list.removeChild(list.firstChild);
    }
    list.appendChild(fistChild);
    if(result.respuesta){
        if(result.data){            
            //añadimos nuevos elementos         
            for(var i = 0; i < result.data.length; i++){
                var option = document.createElement("option");
                option.value=result.data[i];
                option.textContent = result.data[i];
                list.appendChild(option);
            }
        }
    }
};

seg_user.prototype.openModalCart = function(result) {
    //se crean los objetos en el form cart
    if(seg_user.cart_products.length){        
        form = document.getElementById("cart_form");
        row = document.createElement("div");
        row.className = "row col-md-12";
        row.style.textAlign = "center";
        div_c1 = document.createElement("div");
        div_c1.className = "col-md-12";

        formgpoup = document.createElement("div");
        formgpoup.className = "form-group";

        titulo1 = document.createElement("div");
        titulo1.className = "col-md-2";

        titulo11 = document.createElement("label");
        titulo11.className = "col-md-2";
        titulo11.innerHTML = "PRODUCTO";

        titulo2 = document.createElement("label");
        titulo2.className = "col-md-2";
        titulo2.innerHTML = "PRECIO";

        titulo3 = document.createElement("label");
        titulo3.className = "col-md-2";
        titulo3.innerHTML = "CANTIDAD";

        titulo4 = document.createElement("label");
        titulo4.className = "col-md-2";
        titulo4.innerHTML = "TOTAL";

        titulo5 = document.createElement("label");
        titulo5.className = "col-md-2";
        titulo5.innerHTML = "";

        div = document.createElement("div");
        div.className = "col-md-12";
        div.appendChild(titulo1);
        div.appendChild(titulo11);
        div.appendChild(titulo2);
        div.appendChild(titulo3);
        div.appendChild(titulo4);
        div.appendChild(titulo5);

        formgpoup.appendChild(div);

        fondo_bandera = -1;
        cantidad_total = 0;
        precio_total = 0;

        for(var i=0;i<seg_user.cart_products.length;i++){

            div = document.createElement("div");
            div.className = "col-md-12";
            div.setAttribute("id", "producto_"+seg_user.cart_contador);
            if(fondo_bandera==1){
                div.style.backgroundColor = "#e7e7e7";
            }
            //div.style.height = "85px";

            //caracteristicas
            crtcs = document.createElement("input");
            crtcs.setAttribute("type", "hidden");
            crtcs.setAttribute("name", "prod_crtrcs_"+seg_user.cart_products[i][0]+"_"+seg_user.cart_contador);
            crtcs.value = ""+seg_user.cart_products[i][3]+","+seg_user.cart_products[i][4]+","+seg_user.cart_products[i][5]+","+seg_user.cart_products[i][6]+",";

            img = document.createElement("img");
            img.className = "col-md-2";
            img.src = seg_user.cart_products[i][9];
            img.style.height = "85px";
            //img.style.borderRadius = "50%";

            descripcion_div = document.createElement("div");
            descripcion_div.className = "col-md-2";
            label = document.createElement("label");
            label.className = "col-md-12";
            label.innerHTML = seg_user.cart_products[i][7];
            descripcion = document.createElement("div");
            //descripcion.innerHTML = seg_user.cart_products[i][8] + crtcs.value;
            descripcion.innerHTML =  crtcs.value.replace(/,,/g, '');
            descripcion_div.appendChild(label);
            descripcion_div.appendChild(descripcion);        

            precio = document.createElement("div");
            precio.className = "col-md-2";
            precio.innerHTML = "$"+seg_user.cart_products[i][1];
            precio.style.marginTop = "2%";

            //caracteristicas
            in_precio = document.createElement("input");
            in_precio.setAttribute("type", "hidden");
            in_precio.setAttribute("name", "prod_precio_"+seg_user.cart_products[i][0]+"_"+seg_user.cart_contador);
            in_precio.value = seg_user.cart_products[i][1];

            volumen = document.createElement("div");
            volumen.className = "col-md-2";
            volumen.style.marginTop = "2%";

            cantidad = document.createElement("input");
            cantidad.setAttribute("type", "number");
            cantidad.setAttribute("min", "0");
            cantidad.className = "form-control solo_numeros volumen_cart";
            cantidad.setAttribute("name", "prod_volume_"+seg_user.cart_products[i][0]+"_"+seg_user.cart_contador);
            cantidad.value = seg_user.cart_products[i][2];
            volumen.appendChild(cantidad);

            total = document.createElement("div");
            total.className = "col-md-2";
            total.style.marginTop = "2%";    
            total.setAttribute("id", "total_"+seg_user.cart_products[i][0]);
            total.innerHTML = "$"+( parseInt(seg_user.cart_products[i][1]) * parseInt(seg_user.cart_products[i][2]) );

            boton = document.createElement("button");
            boton.className = "btn btn-default remove";
            boton.style.marginTop = "2%";
            boton.innerHTML = "Remover";
            boton.setAttribute("id", "prod_"+seg_user.cart_contador);
            boton.setAttribute("form", "null_form");

            div.appendChild(img);
            div.appendChild(descripcion_div);
            div.appendChild(precio);
            div.appendChild(in_precio);
            div.appendChild(volumen);
            div.appendChild(crtcs);
            div.appendChild(total);
            div.appendChild(boton);

            formgpoup.appendChild(div);

            fondo_bandera = fondo_bandera*-1;
            seg_user.cart_products[i][10] = seg_user.cart_contador;
            cantidad_total = parseInt(cantidad_total) + parseInt(seg_user.cart_products[i][2]);
            precio_total = parseInt(precio_total) + (parseInt(seg_user.cart_products[i][1])*parseInt(seg_user.cart_products[i][2]));

            seg_user.cart_contador = seg_user.cart_contador+1;


        }

        $('#cantidad_cart').html(cantidad_total);
        $('#precio_total').html("$"+precio_total);

        div_c1.appendChild(formgpoup);
        row.appendChild(div_c1);

        hr = document.createElement("hr");
        hr.className = "col-md-12";

        div_c2 = document.createElement("div");
        div_c2.className = "col-md-6 col-md-offset-0";

        div_c2_t = document.createElement("div");
        div_c2_t.innerHTML = "Indicaciones o Sugerencias";
        div_c2_t.style.textAlign = "left";
        
        descript = document.createElement("textarea");
        descript.className = "form-control";
        descript.setAttribute("name", "description");
        descript.setAttribute("row", 5);
        descript.setAttribute("placeholder", "Ingresa, las sugerencias o indicaciones que el tendero deba tener encuenta con tu pedido. Ejemplo: mejor fecha de entrega, dirección alternativa, número de contacto, etc.");

        div_c2.appendChild(div_c2_t);
        div_c2.appendChild(descript);

        row.appendChild(hr);
        row.appendChild(div_c2);

        //construimos el input para descripcion

        //construimos los inputs para los invitados
        inputs = document.getElementById("inputs_info");
        inputs.innerHTML = "";
        if($('#value_login').val() == "0"){
            nombre = document.createElement("input");
            nombre.setAttribute("type", "hidden");
            nombre.setAttribute("name", "name_invitado");
            nombre.setAttribute("id", "name_invitado");

            dir = document.createElement("input");
            dir.setAttribute("type", "hidden");
            dir.setAttribute("name", "dir_invitado");
            dir.setAttribute("id", "dir_invitado");

            email = document.createElement("input");
            email.setAttribute("type", "hidden");
            email.setAttribute("name", "email_invitado");
            email.setAttribute("id", "email_invitado");

            tel = document.createElement("input");
            tel.setAttribute("type", "hidden");
            tel.setAttribute("name", "tel_invitado");
            tel.setAttribute("id", "tel_invitado");

            inputs.appendChild(nombre);
            inputs.appendChild(dir);
            inputs.appendChild(email);
            inputs.appendChild(tel);

            form.appendChild(inputs);        
        }

        form.appendChild(row);

        $('#cart_modal').modal();
        

        //eventos
        $(".remove").on('click', function (e) {
            //remover de objeto, corremos el objeto
            for(var i=0;i<seg_user.cart_products.length;i++){
                if(seg_user.cart_products[i][10] == this.id.split('_')[1])
                {                
                    seg_user.cart_products.splice( i, 1 );
                }
            }
            //remover de modal
            this.parentNode.remove();

            //reducir el brage del carrito
            $('#bange_cart').html(parseInt($('#bange_cart').html())-1);

            //recalculamos los totales
            cantidad_total = 0;
            precio_total = 0;
            for(var i=0;i<seg_user.cart_products.length;i++){
                cantidad_total = cantidad_total + parseInt(seg_user.cart_products[i][2]);
                precio_total = precio_total + (parseInt(seg_user.cart_products[i][1]) * parseInt(seg_user.cart_products[i][2]) );
            }
            $('#cantidad_cart').html(cantidad_total);
            $('#precio_total').html("$"+precio_total);

        });

        $(".solo_numeros" ).keypress(function(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        });

        $(".volumen_cart").keyup(function(e) {              
            if(this.value == ""){
                cantidad = 0;
            }else{
                cantidad = this.value;
            }
           for(var i=0;i<seg_user.cart_products.length;i++){
                if(seg_user.cart_products[i][10] == this.name.split('_')[2])
                {                
                   seg_user.cart_products[i][2] = cantidad;
                }
            }

            //recalculamos los totales
            cantidad_total = 0;
            precio_total = 0;
            for(var i=0;i<seg_user.cart_products.length;i++){
                cantidad_total = cantidad_total + parseInt(seg_user.cart_products[i][2]);
                precio_total = precio_total + (parseInt(seg_user.cart_products[i][1]) * parseInt(seg_user.cart_products[i][2]) );
            }
            $('#cantidad_cart').html(cantidad_total);
            $('#precio_total').html("$"+precio_total);
            
        });
        $(".volumen_cart").change(function(e) {              
            if(this.value == ""){
                cantidad = 0;
            }else{
                cantidad = this.value;
            }
           for(var i=0;i<seg_user.cart_products.length;i++){
                if(seg_user.cart_products[i][10] == this.name.split('_')[2])
                {                
                   seg_user.cart_products[i][2] = cantidad;
                }
            }

            //recalculamos los totales
            cantidad_total = 0;
            precio_total = 0;
            for(var i=0;i<seg_user.cart_products.length;i++){
                cantidad_total = cantidad_total + parseInt(seg_user.cart_products[i][2]);
                precio_total = precio_total + (parseInt(seg_user.cart_products[i][1]) * parseInt(seg_user.cart_products[i][2]) );
            }
            $('#cantidad_cart').html(cantidad_total);
            $('#precio_total').html("$"+precio_total);
            
        });
    }
};

seg_user.prototype.consultaRespuestaAddCart = function(result) {
    $('#id_store_cart_modal').val(result.data[0].store_id);
    $('#id_product_cart_modal').val(result.data[0].id);       
    $('#add_cart_modal .modal-title').html('Agregar '+result.request.name+' al Carrito de Compras');
    $("label[for='prod_cart_modal_for']").html(result.request.name);
    $('#prod_img_cart_modal').attr('src',$('#prod_img_cart_modal').attr('src').replace($('#prod_img_cart_modal').attr('src').split('/')[$('#prod_img_cart_modal').attr('src').split('/').length-1],result.data[0].image1));
    $("#price_cart_modal_span").html(result.data[0].price);
    if(result.data[0].description != ''){
        $('#div_cart_description').show();
        $('#dercription_cart_modal').html(result.data[0].description);
    }
    if(result.data[0].models != ''){
        $('#div_cart_model').show();
        $('#model_cart_modal').html(result.data[0].models);
    }
    
    $('#unity_cart_modal').html('Unidad de venta: '+result.data[0].unity_measure);
    
    //mostramos los div en caso de ser aplicables
    var options;
    var opt;
    var list;

    if(result.data[0].colors != ''){
        //construimos el select        
        list = document.getElementById("colores_cart_select");
        fistChild=list.firstChild;        
        while (list.hasChildNodes()) {   
            list.removeChild(list.firstChild);
        }        
        list.appendChild(fistChild);

        options = result.data[0].colors.split(',');
        
        for(var i=0;i<options.length;i++){
            opt = document.createElement("option");
            opt.value = options[i];
            opt.textContent = options[i];
            list.appendChild(opt);
        }
        $('#div_cart_colors').show();
    }

    if(result.data[0].sizes != ''){
        //construimos el select        
        list = document.getElementById("sizes_cart_select");
        fistChild=list.firstChild;        
        while (list.hasChildNodes()) {   
            list.removeChild(list.firstChild);
        }        
        list.appendChild(fistChild);

        options = result.data[0].sizes.split(',');
        
        for(var i=0;i<options.length;i++){
            opt = document.createElement("option");
            opt.value = options[i];
            opt.textContent = options[i];
            list.appendChild(opt);
        }
        $('#div_cart_sizes').show();
    }

    if(result.data[0].flavors != ''){
        //construimos el select        
        list = document.getElementById("flavors_cart_select");
        fistChild=list.firstChild;        
        while (list.hasChildNodes()) {   
            list.removeChild(list.firstChild);
        }        
        list.appendChild(fistChild);

        options = result.data[0].flavors.split(',');
        
        for(var i=0;i<options.length;i++){
            opt = document.createElement("option");
            opt.value = options[i];
            opt.textContent = options[i];
            list.appendChild(opt);
        }
        $('#div_cart_flavors').show();
    }

    if(result.data[0].materials != ''){
        //construimos el select        
        list = document.getElementById("materials_cart_select");
        fistChild=list.firstChild;        
        while (list.hasChildNodes()) {   
            list.removeChild(list.firstChild);
        }        
        list.appendChild(fistChild);

        options = result.data[0].materials.split(',');
        
        for(var i=0;i<options.length;i++){
            opt = document.createElement("option");
            opt.value = options[i];
            opt.textContent = options[i];
            list.appendChild(opt);
        }
        $('#div_cart_materials').show();
    }

    $('#add_cart_modal').modal();
};

var seg_user = new seg_user();

