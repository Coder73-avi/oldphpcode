<?php
// database library to work with the data using the PDO api
// mysql


class Database{
    private $_connection;
    private static $_instance=NULL;
    private $_count = 0;

    private function __construct(){
        $this->open_connection();
    }

        private function open_connection(){
            $hostname = "localhost";
            $dbname = "samalgro_samal_real_estate";
            $username="samalgro_realestate";
            $password = "}Lf,FmiHn{n.";
            try{
            
                $this->_connection=new PDO('mysql:host='.$hostname.';dbname='.$dbname,$username,$password);
                // echo "Success";
                $this->_connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $ex){
                die($ex->getMessage());
            }   
        }
        public static function instantiate(){
            if (!isset(self::$_instance)){
                self::$_instance = new Database();
            }
            return self::$_instance;
        }

        public function db_insert($tablename,$column_set=array()){
        //    COUNT THE NUMBER OF VALUES IN THE COLUMN_SET ARRAY
            $fildcount = count(array_values($column_set));
           
            $sql = "INSERT INTO ".$tablename. " (";
            $sql .= implode(',', array_keys($column_set)). ") VALUES (?" ;
            for ($i=1;$i<$fildcount;$i++){
                $sql .= ",?";
            }
            $sql .= ")";
            // die($sql);

            $stmt = $this->_connection->prepare($sql);
            try{
                $stmt->execute(array_values($column_set));
            }catch(PDOException $ex){
                die('Error Insert: ' . $ex->getMessage());
            }
         
        }

        public function db_update($tablename,$column_set=array(),$criteria,$bind_values){
            $sql = "UPDATE ". $tablename . " SET ";
            $sql .= implode('=?,',array_keys($column_set));
            $sql .='=?';
            $sql .=" WHERE ". $criteria;
            $stmt = $this->_connection->prepare($sql);
            
            $colum_values = array_values($column_set);
            $executeArray = array_merge($colum_values, $bind_values);
            //   die($sql);
            try{
                $stmt->execute($executeArray);
            }catch(PDOExcetion $ex){
                die("Error Update:  ". $ex->getMessage());
            }

          
        }
        public function db_delete ($tablename="" ,$criteria=NULL, $bind_values=array()){
            $sql = "DELETE  FROM " . $tablename;
            if(isset($criteria)){
                $sql .= " WHERE " . $criteria;
                
            }
            // die($sql);
            $stmt = $this->_connection->prepare($sql);
            try{
                $stmt->execute($bind_values);
            }catch(PDOExcetion $ex){
                die("Error Delete: ". $ex->getMessage());
            }
        }
        public function db_select($tablename="",$column_name="*",$criteria=NULL,$bind_values=array(),$order=null,$limit=null){
            $sql = "SELECT ". $column_name ." FROM " . $tablename;
            
            if(isset($criteria)){
                $sql .= " WHERE " . $criteria;
                // die($sql); 
            }
            if(isset($order)){
                $sql .= " ORDER BY ". $order;
            }
            if(isset($limit)){
                $sql .= " LIMIT " . $limit;
            }
            if(isset($criteria)){
                $stmt = $this->_connection->prepare($sql);
                $stmt->execute($bind_values);
                $this->_count = $stmt->rowCount();
                return $stmt->fetchAll(PDO::FETCH_CLASS);
            }else{
                $result = $this->_connection->query($sql);
                return $result->fetchAll(PDO::FETCH_CLASS);
            }
            // print($sql);
        }
        public function db_count($tablename=""){
            if(!empty($tablename)){
                $sql = "SELECT count(*) as count FROM ".$tablename;
                $result = $this->_connection->query($sql);
                $stmt = $result->fetchAll(PDO::FETCH_COLUMN);
                return $stmt[0];
            }
            return $this->_count;
        }
    }

$db = Database::instantiate();

// $column_set = array('first_name'=>'Avishek','last_name'=>'Magar','email'=>'aavishek60@gmail.com');
// $db->db_insert('users',$column_set);
// $db->db_update('users',$column_set,'id=?',array(1))
// // $result = $db->db_select('users','*',"id=?",array(2));
// foreach($result as $user){
//     echo $user->first_name. " ";
//     echo $user->last_name. " <br>";
// }
// echo $db->db_count('users');

?>