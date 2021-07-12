<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>CRUD</title>
  </head>
  <body>
    <?php 
      $id=isset($_GET["id"])?$_GET["id"]:0;
      $producto="";
      $precio=0;
      if($id!=0)
      {
        require('../models/modelo.php');
        $modelo = new Producto();
        $respuesta=$modelo->consultarbyid($id);
        if(count($respuesta)>0)
        {
          $producto=$respuesta[0]["producto"];
          $precio=$respuesta[0]["precio"];
        }        
      }
      

    ?>
    <div class="container">
    <form action="../controllers/controlador.php" method="POST">
      <input type="hidden" value="<?=$id?>" class="form-control"  name="txt_id">
      <div class="form-group">
          <label>Nombre del producto</label>
          <input type="text" class="form-control" placeholder="Ingrese el nombre de su articulo" name="txt_producto" value="<?=$producto?>" required>
      </div>
      <div class="form-group">
          <label>Precio del producto</label>
            <input type="float" class="form-control" placeholder="Ingrese el precio de su articulo" name="txt_precio" value="<?=$precio?>"  min='1' required>
          <input type="hidden" name="accion" value='insert'>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Guardar</button>
    </form>
    </div>

  </body>
</html>