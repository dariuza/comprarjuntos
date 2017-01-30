function seg_user() {
	
	this.btn_editar = 1 ;
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

var seg_user = new seg_user();

