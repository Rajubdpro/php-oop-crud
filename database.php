<?php

/**
 * START DATABASE CLASS
 */
class database{
    private $servername = "localhost";
    private $dbusername = "root";
    private $dbpassword = "";
    private $dbname = "php_oop";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->dbusername, $this->dbpassword, $this->dbname);
        
        if($this->conn->connect_error){
            echo"Connection faild";
        }else{
         $this->conn;
        }
    }
/**
 * Insert Database record
 * @param array $post
 */
    public function insertRecord($post){
    $name = $post['name'];
    $email = $post['email'];
    $sql = "INSERT INTO crud (name, email) VALUES('$name', '$email')";
    $result = $this->conn->query($sql); 
    
    if($result){
        header('location:index.php?msg=ins');
    }else{
        echo "Error".$sql."<br>".$this->conn->error;
    }
    }//insert reccord close
/**
 * Update Record
 * @param array $post
**/
    public function updateRecord($post){
        $name = $post['name'];
        $email = $post['email'];
        $editid = $post['hid'];
        $sql = "UPDATE crud SET name = '$name', email = '$email' WHERE id = '$editid'";
        $result = $this->conn->query($sql); 
        if($result){
            header('location:index.php?msg=ups');
        }else{
            echo "Error".$sql."<br>".$this->conn->error;
        }
        }//update reccord close

/**
 * Display record Start
 */
    public function displayRecord(){
        $sql = "SELECT * FROM crud";
        $result = $this->conn->query($sql); 
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
            $data[] = $row;
            }//while close
            return $data;
        }//if close
    }//display record close

    /**
 * Delete record data start
 */
public function deleteRecord($delid){
    $sql = "DELETE FROM crud WHERE id='$delid'";
    $result = $this->conn->query($sql);
    if($result){
        header('location:index.php?msg=del');
    }else{
        echo "Error".$sql."<br>".$this->conn->error;
    }
        }//delate record
/**
 * Edit Record Start
 */
    public function displayRecordById($editid){
    $sql = "SELECT * FROM crud WHERE id = '$editid'";
    $result = $this->conn->query($sql);
    if($result->num_rows==1){
        $row = $result->fetch_assoc();
        return $row;
    }//if close
    }//function displayRecordbyid close

}//class close
