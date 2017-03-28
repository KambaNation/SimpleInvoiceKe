
$(document).ready(function(){
    load(1);
});

function load(page){
    var q= $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'./ajax/search_products.php?action=ajax&page='+page+'&q='+q,
        beforeSend: function(objeto){
            $('#loader').html('<img src="./img/ajax-loader.gif"> Loading...');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}

function agregar (id)
{
    var price_sale=document.getElementById('price_sale_'+id).value;
    var quantity=document.getElementById('quantity_'+id).value;
    //Inicia validacion
    if (isNaN(cantidad))
    {
        alert('Enter a Number');
        document.getElementById('quantity_'+id).focus();
        return false;
    }
    if (isNaN(price_sale))
    {
        alert('Enter a Number');
        document.getElementById('price_sale_'+id).focus();
        return false;
    }
    //Fin validacion

    $.ajax({
        type: "POST",
        url: "./ajax/add_billing.php",
        data: "id="+id+"&price_sale="+price_sale+"&quantity="+quantity,
        beforeSend: function(objeto){
            $("#resultados").html("Mensaje: Loading...");
        },
        success: function(datos){
            $("#resultados").html(datos);
        }
    });
}

function eliminar (id)
{

    $.ajax({
        type: "GET",
        url: "./ajax/add_billing.php",
        data: "id="+id,
        beforeSend: function(objeto){
            $("#resultados").html("Message: Loading...");
        },
        success: function(datos){
            $("#resultados").html(datos);
        }
    });

}

$("#datos_factura").submit(function(){
    var id_cliente = $("#id_cliente").val();
    var id_vendedor = $("#id_vendedor").val();
    var condiciones = $("#condiciones").val();

    if (id_cliente==""){
        alert("Debes seleccionar un cliente");
        $("#nombre_cliente").focus();
        return false;
    }
    VentanaCentrada('./pdf/documentos/factura_pdf.php?id_cliente='+id_cliente+'&id_vendedor='+id_vendedor+'&condiciones='+condiciones,'Factura','','1024','768','true');
});

$( "#guardar_cliente" ).submit(function( event ) {
    $('#guardar_datos').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/new_client.php",
        data: parametros,
        beforeSend: function(objeto){
            $("#resultados_ajax").html("Mensaje: Cargando...");
        },
        success: function(datos){
            $("#resultados_ajax").html(datos);
            $('#guardar_datos').attr("disabled", false);
            load(1);
        }
    });
    event.preventDefault();
})

$( "#guardar_producto" ).submit(function( event ) {
    $('#guardar_datos').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/new_product.php",
        data: parametros,
        beforeSend: function(objeto){
            $("#resultados_ajax_productos").html("Mensaje: Cargando...");
        },
        success: function(datos){
            $("#resultados_ajax_productos").html(datos);
            $('#guardar_datos').attr("disabled", false);
            load(1);
        }
    });
    event.preventDefault();
})
