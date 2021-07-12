<?php
  class BD 
  {
       private $usuario="";
        private $password="";
        private $servidor="";
        private $bd ="materiales";
        private $conexionDB;

        public function __construct() 
		{            
            $this->usuario="root";
            $this->password  ="";   
            $this->servidor="localhost";
        }
             

        public function ConectarDB()
        {            
            $dsn = "mysql:host=" . $this->servidor . ";dbname=" . $this->bd . ";charset=utf8;";
			$opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);            
            try
            {

                $this->conexionDB = new PDO($dsn, $this->usuario, $this->password, $opciones);    
                return "La  conexion se realiza con exiyo";
             }catch(PDOException $e)
             {
                 return "No se pudo conectar a base de datos";
             }
            			
        }

        public function get_datatable($query)
		    {			
			$conexion = $this->conexionDB->prepare($query);			
			$conexion->execute();
			$resultado = $conexion->fetchAll(PDO::FETCH_ASSOC);
			$conexion->closeCursor();
			return $resultado;
        }
        
        public function insertQuery($query)
        {
            
			$conexion = $this->conexionDB->prepare($query);
			$resultado = $conexion->execute();
			$conexion->closeCursor();
		  
        }
        public function deleteQuery($query)
        {
            
      $conexion = $this->conexionDB->prepare($query);
      $resultado = $conexion->execute();
      $conexion->closeCursor();
      
        }
  }
  ?>