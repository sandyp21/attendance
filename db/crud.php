<?php 
    class crud {

    
        //private database object
        private $db;

        //constructor to initialize private variable to the database
        function __construct($conn){
            $this->db = $conn;
        }
        //function to insert a new record into the attendance database
        public function insertAttendees($fname, $lname, $dob, $email, $contact, $specialty){
            try {
                //define sql statement to be executed
                $sql = "INSERT INTO attendee (firstname,lastname,dateofbirth,email,contactnum,specialty_id)
                 VALUES (:fname, :lname, :dob, :email, :contact, :specialty)";

                 //prepare the sql statement for execution
                $stmt = $this->db->prepare($sql);
                
                //bind all placeholders to the actual value
                $stmt->bindparam(':fname', $fname);
                $stmt->bindparam(':lname', $lname);
                $stmt->bindparam(':dob', $dob);
                $stmt->bindparam(':email', $email);
                $stmt->bindparam(':contact', $contact);
                $stmt->bindparam(':specialty', $specialty);

                // execute statement
                $stmt->execute();
                return true;
                

            } catch (PDOException $e) {
                //throw $th;
                echo $e->getMessage();
                return false;
            }

        }

        public function editAttendee($id, $fname, $lname, $dob, $email, $contact, $specialty){
        try{ 
                $sql = "UPDATE `attendee` SET `firstname`=:fname,`lastname`=:lname,`dateofbirth`=:dob,
            `email`=:email,`contactnum`=:contact,`specialty_id`=:specialty WHERE 
            attendee_id = :id ";

                $stmt = $this->db->prepare($sql);
                                
                //bind all placeholders to the actual value
                $stmt->bindparam(':id', $id);
                $stmt->bindparam(':fname', $fname);
                $stmt->bindparam(':lname', $lname);
                $stmt->bindparam(':dob', $dob);
                $stmt->bindparam(':email', $email);
                $stmt->bindparam(':contact', $contact);
                $stmt->bindparam(':specialty', $specialty);

                // execute statement
                $stmt->execute();
                return true;
            }
        catch (PDOException $e) {
                //throw $th;
                echo $e->getMessage();
                return false;
        }

            
        }

        public function getAttendees(){
            try{
                $sql = "SELECT * FROM `attendee` a inner join specialties s on a.specialty_id = s.specialty_id";
            $result = $this->db->query($sql);
            return $result;

            }catch (PDOException $e) {
                //throw $th;
                echo $e->getMessage();
                return false;
            
        }
    }

        public function getAttendeeDetails($id){
            try{
                $sql = "select * from attendee a inner join specialties s on a.specialty_id = s.specialty_id where attendee_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
            }catch (PDOException $e) {
                //throw $th;
                echo $e->getMessage();
                return false;
            
        }
            
        }

        public function deleteAttendee($id){
           try{
            $sql = "delete from attendee where attendee_id = :id ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id', $id);
            $stmt->execute();
            return true;
           }
           catch (PDOException $e) {
                //throw $th;
                echo $e->getMessage();
                return false;
           }
        }

        public function getSpecialties(){
            try{
                $sql = "SELECT * FROM `specialties`";
            $result = $this->db->query($sql);
            return $result;
            }
            
        
        catch (PDOException $e) {
            //throw $th;
            echo $e->getMessage();
            return false;
       }

    }

    public function getSpecialtyById($id){
        try{
            $sql = "SELECT * FROM `specialties` where specialty_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return true;
           }
           catch (PDOException $e) {
                //throw $th;
                echo $e->getMessage();
                return false;
           }
    }
}  
    




?>