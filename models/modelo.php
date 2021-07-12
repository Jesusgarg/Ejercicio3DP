
<?php

    include 'BD.php';   
   class Producto  extends BD
    {
        public function __construct()
        {            
            parent::__construct();                      
            $this->ConectarDB();
            
        }
        
        
        public function insert($producto,$precio,$id)
        {
            try
            {                
                $iva=$precio*.16;
                $total=$precio+$iva;
                if($id==0)
                {
                    $this->insertQuery("Insert into materiales.articulos set producto='$producto', precio='$precio', estatus=1, iva='$iva',total='$total'");    
                }else
                {
                    $this->insertQuery("UPDATE materiales.articulos set producto='$producto', precio='$precio', estatus=1, iva='$iva',total='$total' where id=$id");    
                }
                
                return '0';
            
            }catch(Exception $i)
            {
                echo 'ocurrio la siguiente excepcion'.$i;
                return '-1';
            }            
        }
        public function select($filtro)
        {

            return $this->get_datatable("select * from materiales.articulos where estatus = '1' and producto like '%$filtro%'");
        }
    
        /*public function editar()
        {


        }*/
        public function consultarbyid($id)
        {
            return $this->get_datatable("select * from materiales.articulos where id=$id ");
        }
        public function delete($id)
        {
            try
            {                
                $this->insertQuery("update articulos set estatus=0 where id='$id'");
                return '0';
            
            }catch(Exception $i)
            {
                echo 'ocurrio la siguiente excepcion'.$i;
                return '-1';
            }            
        }   
    }
  ?>