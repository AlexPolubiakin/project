<?php 

//config db
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PSW','');
define('DB_NAME','quiz');


 class Database {
     private $host = DB_HOST;
     private $user = DB_USER;
     private $password = DB_PSW;
     private $dbname = DB_NAME;

     private $dbh;
     private $error;
     private $stmt;

     public function __construct(){
         //установка dsn
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
        );
        // создание PDO
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        } 
        catch ( PDOException $e) {
            $this->error = $e->getMessage();
        }
     }

 	// подготовленный запрос
     public function query($query) {
    $this->stmt = $this->dbh->prepare($query);
    }
    
     // привязка значений 
     public function bind($param, $value, $type = null) {
		if (is_null ($type)) {
			switch (true) {
				case is_int ($value) :
					$type = PDO::PARAM_INT;
					break;
				case is_bool ($value) :
					$type = PDO::PARAM_BOOL;
					break;
				case is_null ($value) :
					$type = PDO::PARAM_NULL;
					break;
				default :
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}
     // Execute the prepared statement
     public function execute(){
		return $this->stmt->execute();
	}
     // Get result set as array of objects  
     public function resultset(){
         $this->execute();
         return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
     }
     // Get single record as object
     public function single(){
         $this->execute();
         return $this->stmt->fetch(PDO::FETCH_OBJ);
     }
     // Get record row count
     public function rowCount(){
         return $this->stmt->rowCount();
     }
     // Return the last ins ID
    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }
 }