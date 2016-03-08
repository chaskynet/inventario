/**
*
* Desc: Funciones
*
*
/*******/
function number_format(number, decimals, dec_point, thousands_sep) {
  //  discuss at: http://phpjs.org/functions/number_format/
  // original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: davook
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Theriault
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Michael White (http://getsprink.com)
  // bugfixed by: Benjamin Lupton
  // bugfixed by: Allan Jensen (http://www.winternet.no)
  // bugfixed by: Howard Yeend
  // bugfixed by: Diogo Resende
  // bugfixed by: Rival
  // bugfixed by: Brett Zamir (http://brett-zamir.me)
  //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  //  revised by: Luke Smith (http://lucassmith.name)
  //    input by: Kheang Hok Chin (http://www.distantia.ca/)
  //    input by: Jay Klehr
  //    input by: Amir Habibi (http://www.residence-mixte.com/)
  //    input by: Amirouche
  //   example 1: number_format(1234.56);
  //   returns 1: '1,235'
  //   example 2: number_format(1234.56, 2, ',', ' ');
  //   returns 2: '1 234,56'
  //   example 3: number_format(1234.5678, 2, '.', '');
  //   returns 3: '1234.57'
  //   example 4: number_format(67, 2, ',', '.');
  //   returns 4: '67,00'
  //   example 5: number_format(1000);
  //   returns 5: '1,000'
  //   example 6: number_format(67.311, 2);
  //   returns 6: '67.31'
  //   example 7: number_format(1000.55, 1);
  //   returns 7: '1,000.6'
  //   example 8: number_format(67000, 5, ',', '.');
  //   returns 8: '67.000,00000'
  //   example 9: number_format(0.9, 0);
  //   returns 9: '1'
  //  example 10: number_format('1.20', 2);
  //  returns 10: '1.20'
  //  example 11: number_format('1.20', 4);
  //  returns 11: '1.2000'
  //  example 12: number_format('1.2000', 3);
  //  returns 12: '1.200'
  //  example 13: number_format('1 000,50', 2, '.', ' ');
  //  returns 13: '100 050.00'
  //  example 14: number_format(1e-8, 8, '.', '');
  //  returns 14: '0.00000001'

  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}


/***********************/
/**
*
*/
$('#home').on('click', function(){
	//$('#contenido').html('<h1>hola</>');
	$('#contenido').load('cuerpo');
});

/**
*
*/
$(document).on('click', '#inventario-inicial', function(){
	//$('#contenido').html('<h1>hola</>');
	$('#contenido').load('carga_inventario');
});

/**
*
*/
$('#salida-productos').on('click', function(){
	$('#contenido').load('carga_salida');
});

$(document).on('click', '#salida-articulos', function(){
	$('#contenido').load('carga_salida');
});

/**
*
*/
$('#ingreso-productos').on('click', function(){
	$('#contenido').load('carga_entrada');
});

$(document).on('click', '#ingreso-articulos', function(){
	$('#contenido').load('carga_entrada');
});

/**
*
*/
$(document).on('click', '#sacarProducto', function(){
	var objFila=$(this).parents().get(1);
	$('#modal_content_movimiento').load('sacar_articulo/'+$(objFila).attr('id'));
});

/**
*
*/
$(document).on('click', '#nueva-salida', function(e){
  e.preventDefault();
  $('#contenido').load('carga_salida');
	$.ajax({
            url: 'numero_nota',
            data: {data:'S'},
            type: "GET",
            dataType: "html",
            error: function()
            {
                $("#tabla_articulos").find("tbody").empty();
                $("#tabla_articulos").html('no hay resultados');
            },
            success: function(response)
            {
            	$('#tabla_salidas tbody').empty();
            	var objeto = JSON.parse(response);
             	$.each(objeto, function(i, item) {

                // var x = document.getElementById("num_nota_salida option[value='']");
                // var option = document.createElement("option");
                // option.text = item.numero_nota;
                // x.add(option, x[0]);
                
                var elm = $('#combo_nota_salida option[value=""]');
                elm.text(item.numero_nota);

    				 	  $('#h_nota_salida').val(item.numero_nota);
				      });
              $('#agregar-articulos-salida').removeClass('ocultar');
              $('#cabecera_salida').removeClass('ocultar');
              $('#cabecera_salida2').removeClass('ocultar');
            }
        });
});

/**
*
*/
$(document).on('click', '#nueva-entrada', function(e){
  e.preventDefault();
  //data-toggle="modal" data-target="#modal_añadir_articulos"
  $('#contenido').load('carga_entrada');
  
	$.ajax({
            url: 'numero_nota',
            data: {data:'E'},
            type: "GET",
            dataType: "html",
            error: function()
            {
                $("#tabla_articulos").find("tbody").empty();
                $("#tabla_articulos").html('no hay resultados');
            },
            success: function(response)
            {
            	$('#tabla_salidas tbody').empty();
            	var objeto = JSON.parse(response);
             	$.each(objeto, function(i, item) {
      				 	//$('#num_nota_entrada').text(item.numero_nota);
      				 	
                 var elm = $('#combo_nota_entrada option[value=""]');
                 elm.text(item.numero_nota);

                $('#h_nota_entrada').val(item.numero_nota);
      				 });
              $('#agregar-articulos-entrada').removeClass('ocultar');
              $('#cabecera_salida').removeClass('ocultar');
              $('#cabecera_salida2').removeClass('ocultar');
            }
        });
  // $('#cabecera_salida').removeClass('ocultar');
	
});

function addslashes(string) {
    return string.replace(/\\/g, '\\\\').
        // replace(/\u0008/g, '\\b').
        // replace(/\t/g, '\\t').
        // replace(/\n/g, '\\n').
        // replace(/\f/g, '\\f').
        // replace(/\r/g, '\\r').
        replace(/'/g, '``').
        replace(/"/g, '``');
}

/**
* Desc: Hace movible la ventana modal
*
**/
$(function() {
 $("#modal_añadir_articulos").draggable({
      handle: ".modal-header"
  });
});

/**
* Author: Jorge Anibal Zapata Agreda
* Desc: Realiza la busqueda de articulos a traves de llamda AJAX
*/
//$(document).on('keyup', '#articulo_buscar', function(e){
$(document).on('keyup', '#articulo_buscar', function(e){
	
		var consulta = $("#articulo_buscar").val();
		var url = 'busca_articulo';
		$.ajax({
            url: url,
            data: {data:consulta},
            type: "POST",
            dataType: "html",
            error: function()
            {
                $("#tabla_articulos").find("tbody").empty();
                $("#tabla_articulos").html('no hay resultados');
            },
            success: function(response)
            {
              $("#tabla_articulos").find("tbody").empty();
              var objeto = JSON.parse(response);
              var cadena = '';
              $.each(objeto, function(i, item) {
				cadena += '<tr>'
						+'<td>'
						+'<input type="checkbox" class="chkbox" name="articulo[]" data-cod-articulo="'+item.cod_articulo+'" data-almacen ="'+item.cod_almacen+'" data-descripcion="'+addslashes(item.descripcion)+'" data-unidad="'+item.unidad+'" data-empaque="'+item.empaque+'" data-procedencia="'+item.procedencia+'">'
						+item.cod_articulo
						+'</td>'
						+'<td>'
						+item.descripcion
						+'</td>'
						+'<td class="cantidad_texto">'
						+item.procedencia
						+'</td>'
            +'<td class="cantidad">'
            +number_format(item.saldo, 0)
            +'</td>'
						+'</tr>';
				})
              $('#tabla_articulos tbody').append(cadena);
            }
        });
	
});

/**
* Author: Jorge Anibal Zapata Agreda
* Desc: Carga los articulos encontrados en la busqueda a la tabla principal
*/
$(document).on('click', '#cargar', function(e){
	var tamcheck = $( "input:checkbox:checked" ).length;
          $( "input[name='articulo[]']:checked").each(function()
            {
              var codigo = $(this).data('cod-articulo');
              var cadena = '<tr id='+codigo+'>'
                              +'<td style="width:70px;">'
                              +'<img src="../assets/images/trash.png" alt="" id="elimina_prod">'
                              +'</td>'
                              +'<td id="codigo" style="width:90px;">'
                                +$(this).data('cod-articulo')
                              +'</td>'
                              +'<td id="almacen" style="width:90px;">'
                                +$(this).data('almacen')
                              +'</td>'
                              +'<td id="descripcion" style="width:450px;text-align: left;">'
                               // +'<a href="" id="kardex_articulo" data-toggle="modal" data-target="#modal_kardex_articulos">'
                                +$(this).data('descripcion')
                                //+'</a>'
                              +'</td>'
                              +'<td id="procedencia" style="width:120px;">'
                                +$(this).data('procedencia')
                              +'</td>'
                              +'<td id="unidad" class="centrar_texto" style="width:120px;">'
                                +$(this).data('unidad')
                              +'</td>'
                              +'<td style="width:180px;">'
                                +'<input type="text" id="cantidad" class="cantidad" placeholder="0">'
                              +'</td>'
                            +'</tr>';
              $("#tabla_salidas").find('tbody').append(cadena);
            });
          if (tamcheck>0){
              //$( this ).dialog( "close" );

              //$("#tabla_articulos tbody").empty();
              $("input[name='articulo[]']:checked").attr('checked',false);
              $("#articulo_buscar").val('');
          }
          else{

              alert('Debe seleccionar un articulo');
          }
});

/**
* Author: Jorge Anibal Zapata Agreda
* Desc: Elimina articulos de la tabla
*/
$(document).on('click','#elimina_prod',function(){
  $(this).parents().get(1).remove();
});

/**
*
* Elimina productos de las notas de Entrada
*
**/
$(document).on('click','#elimina_prod_ed_entrada',function(){
  var objArt = new Object()
  var obj = $(this).parents().get(1);
  objArt.cantidad = $(obj).find('#cantidad').val();
  objArt.codigo = $(obj).find('#codigo').text();
  objArt.tabla = 'entrada';
  objArt = JSON.stringify(objArt);
  $.ajax({
      url: 'eliminina_art_editada',
      data: {data: objArt},
      type: "POST",
      dataType: "html",
      error: function()
      {
          alert('Error al Guardar!');
      },
      success: function(response)
      {
        console.log(response);
      }
  });
  $(this).parents().get(1).remove();
});

/**
*
* Elimina productos de las notas de Salidas
*
**/
$(document).on('click','#elimina_prod_ed_salida',function(){
  var objArt = new Object()
  var obj = $(this).parents().get(1);
  objArt.cantidad = $(obj).find('#cantidad').val();
  objArt.codigo = $(obj).find('#codigo').text();
  objArt.tabla = 'salida';
  objArt = JSON.stringify(objArt);
  $.ajax({
      url: 'eliminina_art_editada',
      data: {data: objArt},
      type: "POST",
      dataType: "html",
      error: function()
      {
          alert('Error al Guardar!');
      },
      success: function(response)
      {
        console.log(response);
      }
  });
  $(this).parents().get(1).remove();
});

/**
* Author: Jorge Anibal Zapata Agreda
* Desc: Guarda los articulos de SALIDA del Almacen
*/
$(document).on('click', '#guardar-salida', function(e){
    e.preventDefault();
	  var lista_articulos_salida = new Array();	  
	  var vendedor = $('#vendedor').text();
	  //var numero_nota = $('#num_nota_salida').val();
    var numero_nota = $('#h_nota_salida').val();
    
    if (numero_nota.length < 1) {
        alert("Debe generar un numero de nota");
    }else{
        var filas = $("#tabla_salidas tbody tr");
    	  
        if (filas.length > 0) {
          var valida_ceros = false;
    		  filas.each(function(){

            if ($(this).find('#cantidad').val().length == 0 ) {
              valida_ceros = true;
            }
    		    var articulo_salida = new Object();

    		    articulo_salida.numero_nota = numero_nota;
    		    articulo_salida.vendedor = vendedor;

    		    articulo_salida.codigo = $(this).find('#codigo').text();
            articulo_salida.almacen = $(this).find('#almacen').text();
    		    articulo_salida.descripcion = $(this).find('#descripcion').text();
    		    articulo_salida.procedencia = $(this).find('#procedencia').text(); 
    		    articulo_salida.unidad = $(this).find('#unidad').text();
    		    articulo_salida.empaque = $(this).find('#empaque').text();
    		    articulo_salida.cantidad = $(this).find('#cantidad').val();
    		    
    		    lista_articulos_salida.push(articulo_salida);
    		  });
    		  
    		  var newObj2 = JSON.stringify(lista_articulos_salida);
          var modo_edicion = $('#modo_edicion').val();
          if (!valida_ceros) {
      		  $.ajax({
      	        url: 'guarda_nota_salida',
      	        data: {data: newObj2, modo_edicion: modo_edicion},
      	        type: "POST",
      	        dataType: "html",
      	        error: function()
      	        {
      	            alert('Error al Guardar!');
      	        },
      	        success: function(response)
      	        {
      	          alert('La nota fué creada correctamente!');
      	        }
      	      });
          }else{
            alert('Existen articulos sin cantidad');
          }
    	  }else{
    	  	alert ('Debe ingresar al menos 1 articulo');
    	  }
    }
});

/**
* Desc: Exporta a PDF una Nota de Salida
*/
$(document).on('click', '#imprimir-salida', function(e){
  e.preventDefault();
	var filas = $("#tabla_salidas tbody tr");
	  if (filas.length > 0) {
	  	$('#frm_pdf_salidas').submit();
	  }else{
	  	alert ('Debe ingresar al menos 1 articulo');
	  }
});

/**
* Desc: Trae una nota de Salida de Articulos
*/
$(document).on('change', '#num_nota_salida', function(){

	var nota = $(this).val();
  $('#modo_edicion').val('true');
	$.ajax({
        url: 'trae_nota_salida',
        data: {data: nota},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
            console.log(response);
            $("#tabla_salidas").find("tbody").empty();
            $('#tabla_salidas tbody').empty();

      		  $('#h_nota_salida').val(nota);

      		  // $('#cabecera_salida').removeClass('ocultar');
            // $('#cabecera_salida2').removeClass('ocultar');
                var objeto = JSON.parse(response);
                
                $('#fecha_creacion').text(objeto[0].fecha);
                var cadena = '';
                $.each(objeto, function(i, item) {
      			     cadena += '<tr>'
      					      +'<td>'
                      +'<img src="../assets/images/trash.png" alt="" id="elimina_prod_ed_salida" class="ocultar">'
                      +'</td>'
                      +'<td id="codigo">'
                        +item.cod_articulo
                      +'</td>'
                      +'<td id="almacen">'
                        +item.cod_almacen
                      +'</td>'
                      +'<td id="descripcion" class="texto">'
                        +item.descripcion
                      +'</td>'
                      +'<td id="procedencia">'
                        +item.procedencia
                      +'</td>'
                      +'<td id="unidad">'
                        +item.unidad
                      +'</td>'
                      // +'<td id="empaque">'
                      //   +item.empaque
                      // +'</td>'
                      +'<td>'
                        +'<input type="text" id="cantidad" class="cantidad" placeholder="0" disabled=true value="'+item.cantidad+'">'
                      +'</td>'
          					+'</tr>';
          			})
            $('#tabla_salidas tbody').append(cadena);
          
        }
      });
});

/********************************************************/
/**
* Author: Jorge Anibal Zapata Agreda
* Desc: Guarda los articulos de ENTRADA del Almacen
*/
$(document).on('click', '#guardar-entrada', function(e){
    e.preventDefault();
	  var lista_articulos_entrada = new Array();	  
	  var vendedor = $('#vendedor').text();
	  //var numero_nota = $('#num_nota_entrada').val();
	  var numero_nota = $('#h_nota_entrada').val();
    if (numero_nota.length < 1) {
        alert("Debe generar un numero de nota");
    }else{
        var filas = $("#tabla_salidas tbody tr");
    	  if (filas.length > 0) {
    		  filas.each(function(){
    		    var articulo_entrada = new Object();

    		    articulo_entrada.numero_nota = numero_nota;
    		    articulo_entrada.vendedor = vendedor;

    		    articulo_entrada.codigo = $(this).find('#codigo').text();
            articulo_entrada.almacen = $(this).find('#almacen').text();
    		    articulo_entrada.descripcion = $(this).find('#descripcion').text();
    		    articulo_entrada.procedencia = $(this).find('#procedencia').text(); 
    		    articulo_entrada.unidad = $(this).find('#unidad').text();
    		    articulo_entrada.empaque = $(this).find('#empaque').text();
    		    articulo_entrada.cantidad = $(this).find('#cantidad').val();
    		    
    		    lista_articulos_entrada.push(articulo_entrada);
    		  });
    		  
    		  var newObj2 = JSON.stringify(lista_articulos_entrada);
          var modo_edicion = $('#modo_edicion').val();
    		  $.ajax({
    	        url: 'guarda_nota_entrada',
    	        data: {data: newObj2, modo_edicion: modo_edicion},
    	        type: "POST",
    	        dataType: "html",
    	        error: function()
    	        {
    	            alert('Error al Guardar!');
    	        },
    	        success: function(response)
    	        {
    	          alert('La nota fué creada correctamente!'); 
    	        }
    	      });
    	  }else{
    	  	alert ('Debe ingresar al menos 1 articulo');
    	  }
    }
});

/**
* Desc: Exporta a PDF una Nota de Entrada
*/
$(document).on('click', '#imprimir-entrada', function(e){
  e.preventDefault();
	var filas = $("#tabla_salidas tbody tr");
	  if (filas.length > 0) {

	  	$('#frm_pdf_entradas').submit();
	  }else{
	  	alert ('Debe ingresar al menos 1 articulo');
	  }
	
});

/**
* Author: Jorge Anibal Zapata Agreda
* Desc: Gestion de articulos para inventario INICIAL
*/
$(document).on('click','#upload_file',function(e) {
	e.preventDefault();	
	$.ajaxFileUpload({
		url 			:'upload_file', 
		fileElementId	:'archivo',
		dataType		: 'json',
		data			: {
			'title'		: $('#title').val()
		},
		success	: function (data, status)
		{
			if(data.status != 'error')
			{
				//Si existen Articulos duplicados los muestra en ventana emergente
        if (data.msg) {
          $('#modal_articulos_repetidos').modal('show');
          var duples = JSON.parse(data.datos);
          var cadena = '';
          $.each(duples, function(i, item) {
            cadena += '<tr>'
                      +'<td id="codigo_repetido">'
                        +'<input type="checkbox" class="chkbox" name="articulo_duple" data-cod-articulo="'+item.cod_articulo+'">'
                        +item.cod_articulo
                      +'</td>'
                      +'<td id="descripcion" class="texto">'
                        +item.descripcion
                      +'</td>'
                      +'</tr>';
          });
          
          $('#tabla_repetidos tbody').append(cadena);
          
        }else{
          alert('Archivo importado correctamente');
        }
			}
			else{
				alert("error al subir el archivo");
			}
		}
	});
	return false;
});

$(document).on('click', '#btn_actualiza_repetidos', function(e){
  e.preventDefault();
  var tamcheck = $( "input:checkbox:checked" ).length;
  
  var lista_articulos_duples = new Array();   
  console.log(tamcheck);
  if (tamcheck > 0) {

      $( "input[type=checkbox]:checked").each(function(){
        
        lista_articulos_duples.push($(this).data('cod-articulo'));
      });
      
      var datos = JSON.stringify(lista_articulos_duples);
      
      $.ajax({
          url: 'actualiza_repetidos',
          data: {data: datos},
          type: "POST",
          dataType: "html",
          error: function()
          {
              alert('Error al Actualizar Repetidos!');
          },
          success: function(response)
          {
            console.log(response);
            alert('Actualizado');
          }
      });
  }
  else{
    $.ajax({
      url: 'borra_temporal',
      type: 'POST',
      error: function()
      {
        alert('Error al borrar la tabla Temporal');
      },
      success: function(response)
      {
        alert('Para actualizar debe seleccionar al menos un articulo');    
      }
    });
  }
});

$(document).on('hide.bs.modal','#modal_importa_articulos', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('carga_inventario');
});

/**
* Desc: Elimina Articulo
*/
$(document).on('click', '#elimina_articulo', function(e){
    e.preventDefault();
    var id_articulo = $('#id_articulo').val();
    $.ajax({
        url: 'elimina_articulo',
        data: {data: id_articulo},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Eliminar Articulo!');
        },
        success: function(response)
        {
            alert("Articulo Eliminado");
            $('#ed_cod_articulo').val('');
            $('#ed_descripcion').val('');
            $('#ed_unidad').val('');
            $('#ed_empaque').val('');
            $('#ed_procedencia').val('');
            $('#ed_inv_inicial').val('');
            $('#ed_saldo').val('');
            $('#ed_cant_critica').val('');
        }
    });
});

/**
*
* Desc: cuadra inventario
**/
$(document).on('click','#actualizar-articulos', function(e){
  e.preventDefault();
  $.ajax({
        url: 'cuadra_inventario',
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Traer los datos del Articulo!');
        },
        success: function(response)
        {
          alert('Resultado: '+response);
        }
  });
});
/**
* Desc: Carga venta modal con datos del articulo a modificar
*/
$(document).on('click', '#articulo', function (ev) {
	ev.preventDefault();
	var objFila=$(this).parents().get(1);
	var id_articulo = $(objFila).attr('id');
	$.ajax({
		    url: 'carga_datos_articulo',
        data: {data: id_articulo},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Traer los datos del Articulo!');
        },
        success: function(response)
        {
        	var objeto = JSON.parse(response);
              
            $.each(objeto, function(i, item) {
  	          $('#id_articulo').val(id_articulo);
  	          $('#ed_cod_articulo').val(item.cod_articulo);
              $('#ed_cod_almacen').val(item.cod_almacen);
      			  $('#ed_descripcion').val(item.descripcion);
      			  $('#ed_unidad').val(item.unidad);
      			  $('#ed_empaque').val(item.empaque);
      			  $('#ed_procedencia').val(item.procedencia);
      			  $('#ed_inv_inicial').val(item.inventario_inicial);
      			  $('#ed_saldo').val(item.saldo);
      			  $('#ed_cant_critica').val(item.cantidad_critica);
			  
		        });
        }
	});
 });

$(document).on('click', '#actualizar_articulo', function(){
	var articulo_actualizado = new Object();
	articulo_actualizado.id_articulo = $('#id_articulo').val();
	articulo_actualizado.cod_articulo = $('#ed_cod_articulo').val();
  articulo_actualizado.cod_almacen = $('#ed_cod_almacen').val();
	articulo_actualizado.descripcion = $('#ed_descripcion').val();
	articulo_actualizado.unidad = $('#ed_unidad').val();
	articulo_actualizado.empaque = $('#ed_empaque').val();
	articulo_actualizado.procedencia = $('#ed_procedencia').val();
	articulo_actualizado.inventario_inicial = $('#ed_inv_inicial').val();
	articulo_actualizado.saldo = $('#ed_saldo').val();
	articulo_actualizado.cantidad_critica = $('#ed_cant_critica').val();

	var update_articulo = JSON.stringify(articulo_actualizado);
	$.ajax({
        url: 'actualizar_articulo',
        data: {data: update_articulo},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          alert('Articulo Actualizado correctamente!');
          $('#ed_cod_articulo').val('');
          $('#ed_cod_almacen').val('');
    		  $('#ed_descripcion').val('');
    		  $('#ed_unidad').val('');
    		  $('#ed_empaque').val('');
    		  $('#ed_procedencia').val('');
    		  $('#ed_inv_inicial').val('');
    		  $('#ed_saldo').val('');
    		  $('#ed_cant_critica').val('');
        }
      });
});

$(document).on('click', '#crear_articulo', function(){
  //alert('En construccion...');
  var nuevo_articulo = new Object();
  //articulo_actualizado.id_articulo = $('#id_articulo').val();
  nuevo_articulo.cod_articulo = $('#cod_articulo').val();
  nuevo_articulo.descripcion = $('#descripcion').val();
  nuevo_articulo.unidad = $('#unidad').val();
  nuevo_articulo.empaque = $('#empaque').val();
  nuevo_articulo.procedencia = $('#procedencia').val();
  nuevo_articulo.inventario_inicial = $('#inv_inicial').val();
  //nuevo_articulo.saldo = $('#saldo').val();
  nuevo_articulo.cantidad_critica = $('#cant_critica').val();

  var new_articulo = JSON.stringify(nuevo_articulo);

  $.ajax({
        url: 'crear_articulo',
        data: {data: new_articulo},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          alert('Articulo Creado correctamente!');
          $('#cod_articulo').val('');
          $('#descripcion').val('');
          $('#unidad').val('');
          $('#empaque').val('');
          $('#procedencia').val('');
          $('#inv_inicial').val('');
          //$('#saldo').val('');
          $('#cant_critica').val('');
        }
      });
});

$(document).on('hide.bs.modal','#modal_resumen_movimientos', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('carga_inventario');
});

$(document).on('hide.bs.modal','#modal_nuevo_articulo', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('carga_inventario');
});

/**
* Desc: Trae una nota de Entrada de Articulos
*/
$(document).on('change', '#num_nota_entrada', function(){
	var nota = $(this).val();
  $('#modo_edicion').val('true');
	$.ajax({
        url: 'trae_nota_entrada',
        data: {data: nota},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          console.log(response);
          $("#tabla_salidas").find("tbody").empty();
          $('#tabla_salidas tbody').empty();

    		  //$('#num_nota_entrada').text(nota);
    		  $('#h_nota_entrada').val(nota);
    		  $('#cabecera_salida').removeClass('ocultar');
          $('#cabecera_salida2').removeClass('ocultar');
          var objeto = JSON.parse(response);
          $('#fecha_creacion').text(objeto[0].fecha);
          var cadena = '';
          $.each(objeto, function(i, item) {
				  cadena += '<tr>'
					     	 +'<td>'
                  +'<img src="../assets/images/trash.png" alt="" id="elimina_prod_ed_entrada" class="ocultar">'
                  +'</td>'
                  +'<td id="codigo">'
                    +item.cod_articulo
                  +'</td>'
                  +'<td id="almacen">'
                    +item.cod_almacen
                  +'</td>'
                  +'<td id="descripcion" class="texto">'
                    +item.descripcion
                  +'</td>'
                  +'<td id="procedencia">'
                    +item.procedencia
                  +'</td>'
                  +'<td id="unidad">'
                    +item.unidad
                  +'</td>'
                  // +'<td id="empaque">'
                  //   +item.empaque
                  // +'</td>'
                  +'<td>'
                    +'<input type="text" id="cantidad" class="cantidad" placeholder="0" disabled=true value="'+item.cantidad+'">'
                  +'</td>'
			            +'</tr>';
				})
          $('#tabla_salidas tbody').html(cadena);
        }
      });
});

/**
*
*  Desc: Habilita la edicion de cantidades en notas
**/
$(document).on('click', '#editar-cantidades', function(e){
	e.preventDefault();
	$('input:text').each( function() {
		$(this).removeAttr('disabled');
	});
  $('tbody img').each( function() {
    $(this).toggleClass('ocultar');
  });
  $('#agregar-articulos-salida').removeClass('ocultar');
  $('#agregar-articulos-entrada').removeClass('ocultar');
});


/**
* Desc: Exporta a PDF resultado de buequeda
*/
$(document).on('click', '#imprimir-busqueda', function(){

	var filas = $("#tabla_existencias tbody tr");
	  if (filas.length > 0) {
	  	$('#frm_pdf_main_search').submit();
	  }else{
	  	alert ('Debe ingresar al menos 1 articulo');
	  }
	
});

/**
* Desc: Exporta a PDF resultado de busqueda para conteo fisico
*/
$(document).on('click', '#imprimir-busqueda-conteo', function(){

	var filas = $("#tabla_conteo tbody tr");
	  if (filas.length > 0) {
	  	$('#frm_pdf_main_search_conteo').submit();
	  }else{
	  	alert ('Debe ingresar al menos 1 articulo');
	  }
	
});

/***********************************************************/
/**
* 
* Desc: Seccion de gestion de usuarios
*/

// ******* Creacion de Usuarios
$('#creacion-usuarios').on('click', function(){
	$('#contenido').load('creacion_usuarios');
});

$(document).on('hide.bs.modal','#modal_creacion_usuarios', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('creacion_usuarios');
    // if(!confirm('You want to close me?'))
    //  e.preventDefault();
});

$(document).on('hide.bs.modal','#modal_edita_usuario', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('creacion_usuarios');
    // if(!confirm('You want to close me?'))
    //  e.preventDefault();
});

$(document).on('click', '#crear_usuario', function(e){
	e.preventDefault();
  var usuario = new Array();
  var datos_usuario = new Array();
  var lista_permisos = new Array();

	var crear_usuario = new Object();
  var permisos_usuario = new Object()
	crear_usuario.uname = $('#usuario').val();
	crear_usuario.nombre = $('#nombre').val();
	crear_usuario.apaterno = $('#apaterno').val();
	crear_usuario.amaterno = $('#amaterno').val();
	crear_usuario.ci = $('#ci').val();
	crear_usuario.password = $('#password').val();
	//crear_usuario.rol = $("input[name=rol]:checked").val();

	$( "input[type=checkbox]:checked").each(function(){ 
    console.log($(this).attr('id'));
    permisos_usuario = $(this).attr('id');
    lista_permisos.push(permisos_usuario);
  });

  datos_usuario.push(crear_usuario);
  
  usuario.push(datos_usuario);
  usuario.push(lista_permisos);

  var new_usuario = JSON.stringify(usuario);
	console.log(new_usuario);

  $.ajax({
        url: 'nuevo_usuario',
        data: {data: new_usuario},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          alert('Usuario creado correctamente!');
          $('#usuario').val('');
    		  $('#nombre').val('');
    		  $('#apaterno').val('');
    		  $('#amaterno').val('');
    		  $('#ci').val('');
    		  $('#password').val('');
    		  // $("input[name=rol]:checked").val('');
        }
  });
});

$(document).on('hide.bs.modal','#modal_creacion_usuarios', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('creacion_usuarios');
});

$(document).on('click', '#nombre_usuario', function(e){
	e.preventDefault();
	var objFila=$(this).parents().get(1);
	var id_usuario = $(objFila).attr('id');
	$.ajax({
		url: 'carga_datos_usuario',
        data: {data: id_usuario},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
        	var objeto = JSON.parse(response);
           
          $.each(objeto.datos_usuario, function(i, item) {
            $('#id_usuario').val(id_usuario);
            $('#ed_usuario').val(item.uname);
    			  $('#ed_nombre').val(item.nombre);
    			  $('#ed_apaterno').val(item.apaterno);
    			  $('#ed_amaterno').val(item.amaterno);
    			  $('#ed_ci').val(item.ci);
    			  $('#ed_password').val(item.password);
    			  $("input[name=ed_rol]:checked").val(item.rol);
	        });
          $.each(objeto.permisos, function(i, item){
            // $.each(i.datos_usuario, function(j, item2){
            //   console.log(j+'--'+item2);
            // });
            if (item == 'chk_inv_ini') {
              //console.log(i+'--'+item);
              $('#chk_inv_ini').prop('checked', true);
            }else if (item == 'chk_exist'){
              $('#chk_exist').prop('checked', true);
            }else if (item == 'chk_nota_ingre'){
              $('#chk_nota_ingre').prop('checked', true);
            }else if (item == 'chk_nota_salida'){
              $('#chk_nota_salida').prop('checked', true);
            }else if (item == 'chk_edit_nota'){
              $('#chk_edit_nota').prop('checked', true);
            }else if (item == 'chk_lst_conteo'){
              $('#chk_lst_conteo').prop('checked', true);
            }else if (item == 'chk_mov_inventa'){
              $('#chk_mov_inventa').prop('checked', true);
            }else if (item == 'chk_modifica'){
              $('#chk_modifica').prop('checked', true);
            }else if (item == 'chk_config'){
              $('#chk_config').prop('checked', true);
            }else if (item == 'chk_crea_art'){
              $('#chk_crea_art').prop('checked', true);
            } else if (item == 'chk_importa_art'){
              $('#chk_importa_art').prop('checked', true);
            } else if (item == 'chk_borra_art'){
              $('#chk_borra_art').prop('checked', true);
            } 
            
          }); 
        }
	});
	$('#modal_content_usuario').html();
})

$(document).on('click', '#chk_password', function(){
  $('#ed_password').prop('disabled', false);
});

$(document).on('click', '#actualizar_usuario', function(){
  var usuario = new Array();
  var datos_usuario = new Array();
  var lista_permisos = new Array();

	var usuario_actualizado = new Object();
  var permisos_usuario = new Object();

	usuario_actualizado.id_usuario = $('#id_usuario').val();
	usuario_actualizado.uname = $('#ed_usuario').val();
	usuario_actualizado.nombre = $('#ed_nombre').val();
	usuario_actualizado.apaterno = $('#ed_apaterno').val();
	usuario_actualizado.amaterno = $('#ed_amaterno').val();
	usuario_actualizado.ci = $('#ed_ci').val();
  if ($('#chk_password').prop('checked')) {
    usuario_actualizado.password = $('#ed_password').val();
  }

  $( "input[type=checkbox]:checked").each(function(){ 
    //console.log($(this).attr('id'));
    permisos_usuario = $(this).attr('id');
    lista_permisos.push(permisos_usuario);
  });

  datos_usuario.push(usuario_actualizado);
  
  usuario.push(datos_usuario);
  usuario.push(lista_permisos);

	var update_usuario = JSON.stringify(usuario);

	$.ajax({
        url: 'actualizar_usuario',
        data: {data: update_usuario},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          alert('Usuario Actualizado correctamente!');
          $('#ed_usuario').val('');
      	  $('#ed_nombre').val('');
      	  $('#ed_apaterno').val('');
      	  $('#ed_amaterno').val('');
      	  $('#ed_ci').val('');
      	  $('#ed_password').val('');
        }
      });
});

$(document).on('click', '#elimina_usr', function(){
  var objFila=$(this).parents().get(1);
  var id_usuario = $(objFila).attr('id');
  $.ajax({
        url: 'elimina_usuario',
        data: {data: id_usuario},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Borrar!');
        },
        success: function(response)
        {
          alert('Usuario Borrado correctamente!');
          $('#contenido').load('creacion_usuarios');
        }
      });
});

/**
* 
* Desc: Seccion de gestion de Almacenes
*/

// ******* Creacion de Almacenes
$('#creacion-almacenes').on('click', function(){
	$('#contenido').load('creacion_almacenes');
});

$(document).on('hide.bs.modal','#modal_creacion_almacen', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('creacion_almacenes');
    // if(!confirm('You want to close me?'))
    //  e.preventDefault();
});

$(document).on('hide.bs.modal','#modal_edita_almacen', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('creacion_almacenes');
    // if(!confirm('You want to close me?'))
    //  e.preventDefault();
});

$(document).on('click', '#crear_almacen', function(e){
	e.preventDefault();
	var crear_almacen = new Object();
	crear_almacen.nombre_almacen = $('#nombre_almacen').val();
	crear_almacen.abreviacion = $('#abreviacion').val();
  crear_almacen.direccion = $('#direccion').val();
  crear_almacen.telefono = $('#telefono').val();
	
	var new_almacen = JSON.stringify(crear_almacen);
	$.ajax({
        url: 'nuevo_almacen',
        data: {data: new_almacen},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          alert('Almacen creado correctamente!');
          $('#nombre_almacen').val('');
		      $('#abreviacion').val('');
          $('#direccion').val('');
          $('#telefono').val('');
        }
      });
});

$(document).on('hide.bs.modal','#modal_creacion_almacen', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('creacion_almacenes');
});

$(document).on('click', '#nombre_almacen', function(e){
	e.preventDefault();
	var objFila=$(this).parents().get(1);
	var id_almacen = $(objFila).attr('id');
	$.ajax({
		    url: 'carga_datos_almacen',
        data: {data: id_almacen},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
        	var objeto = JSON.parse(response);
              
            $.each(objeto, function(i, item) {
	          $('#id_almacen').val(id_almacen);
	          $('#ed_nombre_almacen').val(item.nombre_almacen);
	          $('#ed_abreviacion').val(item.abreviacion);
            $('#ed_direccion').val(item.direccion);
            $('#ed_telefono').val(item.fono);
	          $('#ed_abreviacion_old').val(item.abreviacion);
		  	});
          //alert('Usuario Editado correctamente!');
          //console.log(response);
        }
	});
	
})

$(document).on('click', '#actualizar_almacen', function(){
	var almacen_actualizado = new Object();
	almacen_actualizado.id_almacen = $('#id_almacen').val();
	almacen_actualizado.nombre_almacen = $('#ed_nombre_almacen').val();
	almacen_actualizado.abreviacion = $('#ed_abreviacion').val();
  almacen_actualizado.direccion = $('#ed_direccion').val();
  almacen_actualizado.telefono = $('#ed_telefono').val();
	almacen_actualizado.abreviacion_old = $('#ed_abreviacion_old').val();

	var update_almacen = JSON.stringify(almacen_actualizado);
	$.ajax({
        url: 'actualizar_almacen',
        data: {data: update_almacen},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          alert('Almacen Actualizado correctamente!');
          $('#ed_nombre_almacen').val('');
		      $('#ed_abreviacion').val('');
          $('#ed_direccion').val('');
          $('#ed_telefono').val('');

        }
      });
});

/**
* 
* Desc: Seccion Buscador vista principal
*/

$(document).on('keyup', '#buscar', function(e){
	$.ajax({
        url: 'busca_articulo',
        data: {data: $(this).val()},
        type: "POST",
        dataType: "html",
        xhrFields: {
      		withCredentials: true
   		},
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          $("#tabla_existencias").find("tbody").empty();
          var objeto = JSON.parse(response);
          var cadena = '';
          var ii = 1;
          $.each(objeto, function(i, item) {
  			    cadena += '<tr>'
  					+'<td class="centrar">'
  					+ii
  					+'</td>'
  					+'<td class="centrar_texto">'
  					+item.cod_articulo
  					+'</td>'
            +'<td class="centrar_texto">'
            +item.cod_almacen
            +'</td>'
  					+'<td>'
  					+item.descripcion
  					+'</td>'
  					+'<td class="centrar_texto">'
  					+item.procedencia
  					+'</td>'
  					+'<td class="centrar_texto">'
  					+item.unidad
  					+'</td>'
  					+'<td class="centrar">'
  					+item.empaque
  					+'</td>'
  					+'<td class="cantidad_texto">'
  					+number_format(item.saldo,0)
  					+'</td>'
  					+'</tr>';
  					ii++;
			    })
          $('#tabla_existencias tbody').append(cadena);
        }
      });
});

$(document).on('keyup', '#buscar_invini', function(e){
  $.ajax({
        url: 'busca_articulo',
        data: {data: $(this).val()},
        type: "POST",
        
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          $("#tabla_invini").find("tbody").empty();
          var objeto = JSON.parse(response);
          var cadena = '';
          var ii = 1;
          var permisos =  $('#roles').val();
          

          $.each(objeto, function(i, item) {
          if ( permisos == 'tiene')  {
              var descripcion = '<a href="#" data-toggle="modal" data-target="#modal_resumen_movimientos" id="articulo">'+item.descripcion+'</a>';

          } else {
              var descripcion = item.descripcion; 
          }
          cadena += '<tr id="'+item.id_articulo+'">'
          +'<td class="centrar">'
          +ii
          +'</td>'
          +'<td class="centrar">'
          +item.cod_articulo
          +'</td>'
          +'<td class="centrar">'
          +item.cod_almacen
          +'</td>'
          +'<td>'
          +descripcion
          +'</td>'
          +'<td class="centrar">'
          +item.unidad
          +'</td>'
          +'<td class="centrar">'
          +item.empaque
          +'</td>'
          +'<td class="centrar">'
          +item.procedencia
          +'</td>'
          +'<td class="cantidad_texto">'
          +item.cantidad_critica
          +'</td>'
          +'<td class="cantidad_texto">'
          +number_format(item.inventario_inicial,0)
          +'</td>'
          +'</tr>';
          ii++;
      })
          $('#tabla_invini tbody').append(cadena);
        }
      });
});

/**
* Desc: Exporta a PDF resultado de busqueda de Movimiento
*/
$(document).on('click', '#imprimir-busqueda-invini', function(){

  var filas = $("#tabla_invini tbody tr");
    if (filas.length > 0) {
      $('#frm_pdf_main_search_invini').submit();
    }else{
      alert ('Debe ingresar al menos 1 articulo');
    }
});

$(document).on('keyup', '#buscar_para_conteo', function(e){
	$.ajax({
        url: 'busca_articulo_conteo',
        data: {data: $(this).val()},
        type: "POST",
        dataType: "html",
        xhrFields: {
      		withCredentials: true
   		},
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          $("#tabla_conteo").find("tbody").empty();
          var objeto = JSON.parse(response);
          var cadena = '';
          var ii = 1;
          $.each(objeto, function(i, item) {
			cadena += '<tr>'
					+'<td>'
					+ii
					+'</td>'
					+'<td class="centrar_texto">'
					+item.cod_articulo
					+'</td>'
          +'<td class="centrar_texto">'
          +item.cod_almacen
          +'</td>'
					+'<td>'
					+item.descripcion
					+'</td>'
					+'<td class="centrar_texto">'
					+item.unidad
					+'</td>'
					+'<td class="centrar_texto">'
					+item.empaque
					+'</td>'
					+'<td class="centrar_texto">'
					+item.procedencia
					+'</td>'
					+'<td class="cantidad_texto">'
					+number_format(item.saldo,0)
					+'</td>'
					+'<td class="centrar">'
					+'_______'
					+'</td>'
					+'</tr>';
			ii++;
			});
          $('#tabla_conteo tbody').append(cadena);
        }
      });
});

/**
* 
* Desc: Seccion Reporte para Conteo Fisico
*/
$(document).on('click', '#rep-para-conteo', function(e){
	e.preventDefault();
	$('#contenido').load('rep_conteo_fisico');
});

/**
* 
* Desc: Seccion Existencias
*/
$(document).on('click', '#existencias', function(e){
	e.preventDefault();
	$('#contenido').load('existencias');
});

/**
* 
* Desc: Seccion Movimiento de Inventarios
*/
$(document).on('click', '#rep-mov-inv', function(e){
	e.preventDefault();
	$('#contenido').load('rep_mov_inv');
});

/**
*
* Desc: Sección buscador para Movimiento de materiales
*
*/
$(document).on('keyup', '#buscar_movimiento', function(e){
	$.ajax({
        url: 'busca_articulo_movimiento',
        data: {data: $(this).val()},
        type: "POST",
        dataType: "html",
        xhrFields: {
      		withCredentials: true
   		},
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          $("#tabla_movimiento").find("tbody").empty();
          var objeto = JSON.parse(response);
          var cadena = '';
          var ii = 1;
          $.each(objeto, function(i, item) {
			cadena += '<tr  id="'+item.cod_articulo+'">'
					+'<td>'
					+ii
					+'</td>'
					+'<td class="centrar_texto">'
					+item.cod_articulo
					+'</td>'
          +'<td class="centrar_texto">'
          +item.almacen
          +'</td>'
					+'<td><a href="" id="kardex_articulo" data-toggle="modal" data-target="#modal_kardex_articulos">'
					+item.descripcion
					+'</a></td>'
					+'<td class="centrar_texto">'
					+item.unidad
					+'</td>'
					// +'<td class="centrar_texto">'
					// +item.empaque
					// +'</td>'
					+'<td class="centrar_texto">'
					+item.procedencia
					+'</td>'
					+'<td class="cantidad_texto">'
					+number_format(item.inv_inicial, 0)
					+'</td>'
					+'</td>'
					+'<td class="cantidad_texto">'
					+number_format(item.entradas, 0)
					+'</td>'
					+'</td>'
					+'<td class="cantidad_texto">'
					+number_format(item.salidas, 0)
					+'</td>'
					+'</td>'
					+'<td class="cantidad_texto">'
					+number_format(item.saldo, 0)
					+'</td>'
					+'</tr>';
			ii++;
			});
          $('#tabla_movimiento tbody').append(cadena);
        }
      });
});

/**
* Desc: Exporta a PDF resultado de busqueda de Movimiento
*/
$(document).on('click', '#imprimir-busqueda-movimiento', function(){

	var filas = $("#tabla_movimiento tbody tr");
	  if (filas.length > 0) {
	  	$('#frm_pdf_main_search_movimiento').submit();
	  }else{
	  	alert ('Debe ingresar al menos 1 articulo');
	  }
});


/**
* Desc: Carga Kardex de Articulo
*/
$(document).on('click', '#kardex_articulo', function (ev) {
	ev.preventDefault();
	var objFila=$(this).parents().get(1);
	var id_articulo = $(objFila).attr('id');
	$('#buscar_para_kardex').val(id_articulo);
	$.ajax({
		    url: 'kardex_articulo',
        data: {data: id_articulo},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Traer los datos del Articulo!');
        },
        success: function(response)
        {
		 	    $("#kardex_articulos").find("tbody").empty();
          var objeto = JSON.parse(response);
          var cadena = '';
          $('#descripcion').text(objeto[0].descripcion);
          $('#invini').text(number_format(objeto[0].invini,0));
          $.each(objeto, function(i, item) {
			    cadena += '<tr>'
					+'<td>'
					+item.fecha
					+'</td>'
					+'<td class="centrar_texto">'
					+item.tipo_movimiento
					+'</td>'
					+'<td class="centrar_texto">'
					+item.numero_nota
					+'</td>'
					+'<td class="centrar_texto">'
					+number_format(item.entradas, 0)
					+'</td>'
					+'<td class="centrar_texto">'
					+number_format(item.salidas, 0)
					+'</td>'
					+'<td class="cantidad_texto">'
					+number_format(item.saldo, 0)
					+'</td>'
					+'</tr>';
			
			});
          $('#kardex_articulos tbody').append(cadena);
    	}
	});
 });

$(document).on('hide.bs.modal','#modal_kardex_articulos', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    //$('#contenido').load('rep_mov_inv');
});

/**
* Desc: Exporta a PDF resultado de busqueda de Movimiento
*/
$(document).on('click', '#imprimir-kardex', function(){

	var filas = $("#kardex_articulos tbody tr");
	  if (filas.length > 0) {
      console.log(filas.length);
	  	$('#frm_pdf_kardex').submit();
	  }else{
	  	alert ('Debe ingresar al menos 1 articulo');
	  }
});

/*
* Desc: Valida las cantidades ingresadas no sobrepasen las existencias
*/
$(document).on('change', '#tabla_salidas tbody input', function(){
  var tipo = $(".etiqueta").text();
  if (tipo == 'SALIDA') {
    input = $(this);
    var data = new Object();
    
    var objFila=$(this).parents().get(1);
    var cod_articulo = $(objFila).find('#codigo').text();

    data.cod_articulo = cod_articulo;
    data.tipo = tipo;
    data.cantidad = $(this).val();
    data = JSON.stringify(data);

    $.ajax({
          url: 'valida_cantidad',
          data: {data: data},
          type: "POST",
          dataType: "html",
          error: function()
          {
              alert('Error al Traer los datos del Articulo!');
          },
          success: function(response)
          {
              var objeto = JSON.parse(response);
              var valida = objeto[0].valida;
              if (valida < 0){
                alert('La cantidad ingresada es mayor a la existencia');
                input.val('');
              }
              else{
                console.log('ok');
              }
          }
    });
  }
})
