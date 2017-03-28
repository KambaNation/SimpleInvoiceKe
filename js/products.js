/**
 * Created by SparkWorld on 3/19/2017.
 */

$(document).ready(function(){
    load(1);
});

function load(page){
    var q= $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'./ajax/search_products.php?action=ajax&page='+page+'&q='+q,
        beforeSend: function(objeto){
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}



function eliminar (id)
{
    var q= $("#q").val();
    if (confirm("Realmente deseas eliminar el producto")){
        $.ajax({
            type: "GET",
            url: "./ajax/search_products.php",
            data: "id="+id,"q":q,
            beforeSend: function(objeto){
                $("#resultados").html("Mensaje: Cargando...");
            },
            success: function(datos){
                $("#resultados").html(datos);
                load(1);
            }
        });
    }
}






