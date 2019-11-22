<?php
    class DBConnection{
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;

        private $dbh;
        private $error = ''; //para posible error de conexion

        public function __construct(){
            //Set DSN
            $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;

            //Set options
            $options = array(
                PDO::ATTR_PERSISTENT => true, //propiedad estatica de la pdo
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //permite que en el bloque try catch coja pdo exceptions
            );

            try{
                //Create PDO
                $this->dbh = new PDO($dsn,$this->user,$this->pass,$options);

            }catch(PDOException $e){
                $this->error = $e->getMessage();
            }
            return $this->error; //resolver con un metodo magico
        }

        public function __toString(){
            return $this->error;
        }

        public function __destruct(){ //no pasa nada si no se hace

        }

        public function runQuery($sql){ //insertar datos y devuelve el numero de tuplas afectadas menos en select que devuelve el resultset
            try{
                $count = $this->dbh->exec($sql);
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                //echo $e->getMessage();
            }
            return $count;
        }

        public function getQuery($sql){
            $stmt = $this->dbh->query($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt;
        }

        public function getDBH(){ //devuelva la instacia de la conexion
            return $this->dbh;
        }
        
    }
?>