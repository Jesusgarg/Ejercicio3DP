<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> 
</head>
<body>

   <div class="container">
        <div class="row">
            <div class="col-6">
                <input type="text"  id="txt_buscar" class="form-control  my-3" name="">                
            </div>
            <div class="col-3">
                <button id="btn_buscar" class="btn btn-primary my-3">Buscar producto</button>         
            </div>
            <div class="col-3">
                <button id="btn_alta" class="btn btn-success my-3">Agregar producto</button> 
            </div>
            
            
        </div>
        
      <table class="table">

        <thead>
            <tr>
                <th scope="col">Producto</th>
                <th scope="col">Precio</th>
                <th scope="col">IVA</th>
                <th scope="col">Costo Total</th>
                <th scope="col">Operaciones</th>
            </tr>
  
        </thead>
        <tbody id="tbl_datos">
            
        </tbody>
    </table>

    
   </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        //INICIA EVENTO DE BUSCAR
            $("#btn_buscar").click(function()
            {
                $.ajax(
                {
                    type: 'POST',  // Envío con método POST
                    url: '../controllers/controlador.php',  // Fichero destino (el PHP que trata los datos)
                    data: 
                    { 
                        'accion':'select',
                        'filtro':$("#txt_buscar").val()
                    } 
                }).done(function( msg ) 
                {  
                    var datos=JSON.parse(msg);
                    var renglones="";
                    for(var x=0;x<datos.length;x++)
                    {
                        var temp=datos[x];
                        renglones+=`<tr data-id="${datos[x]["id"]}">                                                         
                                        <td>${datos[x]["producto"]}</td>; 
                                        <td>${datos[x]["precio"]}</td>
                                        <td>${datos[x]["iva"]}</td>
                                        <td>${datos[x]["total"]}</td>
                                        <td><button class='btn_editar   btn btn-primary'>Actualizar</button></td>
                                        <td><button class='btn_eliminar btn btn-danger'>Eliminar</button></td>
                                    </tr>`;   
                    }
                    $("#tbl_datos").empty();
                    $("#tbl_datos").append(renglones);                                                          
                });
            })
            $("#btn_buscar").click();

            // EVENTO PARA ELIMINAR 
            // EVENTO SE ASIGNA 
            $("#tbl_datos").on('click','.btn_eliminar',function()
            {
                var id=$(this).parent().parent().data("id");
                 $.ajax(
                {
                    type: 'POST',  // Envío con método POST
                    url: '../controllers/controlador.php',  // Fichero destino (el PHP que trata los datos)
                    data: 
                    { 
                        'accion':'delete',
                        'txt_id':id
                    } 
                }).done(function( msg ) 
                {  
                   alert(msg);
                   $("#btn_buscar").click();
                });
            });
            $("#tbl_datos").on('click','.btn_editar',function()
            {            
                var id=$(this).parent().parent().data("id");
                window.location='alta.php?id='+id;
            });
            $("#btn_alta").click(function()
            {
                window.location='alta.php';
            });
    </script>
</body>

</html>


