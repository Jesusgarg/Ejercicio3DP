
<?php
    require("../models/modelo.php");             
    
    if(isset($_POST["accion"]))
    {
        $modelo = new Producto();
        if($_POST["accion"]=="insert")
        {
            if(isset($_POST["txt_producto"])&&isset($_POST["txt_precio"])&&isset($_POST["txt_id"]))
            {
                $respuesta= $modelo->insert($_POST["txt_producto"],$_POST["txt_precio"],$_POST["txt_id"]);      
                if($respuesta=='0')
                {
                    //echo 'El registro se guardo con exito';
                    header('location:../views/Index.php');
                }else
                {
                    echo 'Ocurrio un error al guardar los datos';
                }        
            }else
            {
                echo 'No se encontraron los datos necesarios';
            }
        }else if($_POST["accion"]=="select")
        {
            $filtro=$_POST["filtro"];
            $respuesta= $modelo->select($filtro);      
            echo json_encode($respuesta);
        }else if($_POST["accion"]=="delete")
        {
            if(isset($_POST["txt_id"]))
            {
                $respuesta= $modelo->delete($_POST["txt_id"]);      
                if($respuesta=='0')
                {
                    echo 'El registro se elimino con exito';
                }else
                {
                    echo 'Ocurrio un error al eliminar los datos';
                }        
            }else
            {
                echo 'No se encontraron los datos necesarios';
            }

        }else if($_POST["accion"]=="selectbyid")
        {
            if(isset($_POST["txt_id"]))
            {
                $respuesta= $modelo->consultarbyid($_POST["txt_id"]);      
                echo json_encode($respuesta);
            }else
            {
                echo 'No se encontraron los datos necesarios';
            }

        }else
        {
            echo 'La accion no coincide con nuestros datos';
        }
        }else
        {
        echo 'No se encontraron los datos necesarios';
        }

    
?>

