<?php 
class user{
    //private database object
    private $db;

    //constructor to initialize private variable to the database
    function __construct($conn){
        $this->db = $conn;
    }

    public function insertUser($username, $password){
        //function to insert a new record into the attendance database
            try {
                $result = $this->getUserByUsername($username);
                if($result['num'] > 0){
                    return false;
                }
                else{
                    $new_password = md5($password.$username);
                //define sql statement to be executed
                $sql = "INSERT INTO users (username, password)
                VALUES (:username, :password)";

                //prepare the sql statement for execution
               $stmt = $this->db->prepare($sql);
               
               //bind all placeholders to the actual value
               $stmt->bindparam(':username', $username);
               $stmt->bindparam(':password', $new_password);
               

               // execute statement
               $stmt->execute();
               return true;
                }
                
                

            } catch (PDOException $e) {
                //throw $th;
                echo $e->getMessage();
                return false;
            }

        }
    

    public function getUser($username, $password){
        try{
            $sql = "select * from users where username = :username AND password = :password" ;
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(':username', $username);
        $stmt->bindparam(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        }catch (PDOException $e) {
            //throw $th;
            echo $e->getMessage();
            return false;
        
    }
    }

    public function getUserByUsername($username){
        try{
            $sql = "select Count(*) as num from users where username = :username" ;
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(':username', $username);
        
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        }catch (PDOException $e) {
            //throw $th;
            echo $e->getMessage();
            return false;
        
    } 
    }
}


?>