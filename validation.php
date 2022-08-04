<?php
session_start();

// LOGIN AND SIGNUP VALIDATION;
class SignUp {
    private $data;
    private $errors;
    private static $fields = ['fullname', 'email','phone','password'];

    public function __construct($post_data){
        $this->data = $post_data;
    }

    public function validateform(){
        foreach (self::$fields as $field) {
        if (!array_key_exists($field, $this->data)) {
            trigger_error("$field is not present in data");
            return;
        } 
        
        }
    $this->validatefullname();
    $this->validateEmail();
    $this->validatephone();
    $this->validatepassword();
    return $this->errors;
    }
    
    
    private function validatefullname(){
     $val = trim($this->data['fullname']);
     if (empty($val)) {
        $this->addError('fullname', 'Fullname can not be empty');
     } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $val)) {
            $this->addError('fullname', 'Fullname must be alphanumeric');
        }
        
     }
    }
    
    private function validateEmail(){
        $val = trim($this->data['email']);
        if (empty($val)) {
            $this->addError('email', 'Email can not be empty');
         } else {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'Enter a valid email');
            }
         }
    }
    

    
    private function validatephone(){
        $val = trim($this->data['phone']);
        if (empty($val)) {
            $this->addError('phone', 'Phone can not be empty');
         }
    }


    private function validatepassword(){
        $val = trim($this->data['password']);
        if (empty($val)) {
            $this->addError('password', 'Password can not be empty');
         }
    }
    private function addError($key, $val){
        $this->errors[$key] = $val;
    }
    
    }

    // LOGIN VALIDATION;
    class login {
        private $data;
        private $errors;
        private static $fields = ['email','password'];
    
        public function __construct($post_data){
            $this->data = $post_data;
        }
    
        public function validateform(){
            foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("$field is not present in data");
                return;
            }
            }
        $this->validateEmail();
        $this->validatepassword();
        return $this->errors;
        }

            
    private function validateEmail(){
        $val = trim($this->data['email']);
        if (empty($val)) {
            $this->addError('email', 'Email can not be empty');
         } else {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'Enter a valid email');
            }
         }
    }
    
    private function validatepassword(){
        $val = trim($this->data['password']);
        if (empty($val)) {
            $this->addError('password', 'Password can not be empty');
         }
    }
    private function addError($key, $val){
        $this->errors[$key] = $val;
    }

    }  
      // END OF BOTH VALIDATION;
    

  //  DATASE CONNECTION AND INSERTING START!;
  class Database extends SignUp
  {
      protected $host = "localhost";
      protected $root = "root";
      protected $password = "";
      protected $dbase = "Food_App";
  
      public $conn_to = null;

      public function __construct() {
          // initialize connection property;
          $this->conn_to = mysqli_connect( $this->host, $this->root, $this->password, $this->dbase);
          if($this->conn_to->connect_error){
           echo "FAIL".$this->conn_to->connect_error;
          }
          //  echo "Connection Successful...!";
   }
  
   public function insert($fname, $email, $phone, $password) {
    if(!empty($fname) || !empty($email) || !empty($phone) || !empty($password)){
                $InConn = mysqli_query($this->conn_to, "INSERT INTO regisration_info (fullname, email, phone, password) 
                VALUES('$fname','$email', '$phone', '$password')");
                return $InConn;
    } else {
        echo " ";
    }
 
      } 
  }
  // DATABASE CONNECTION AND INSERTING END!;



    // GETTING USER INFOMATION FROM THE DATABASE;
    
class LoginInfo extends login
{
    protected $host = "localhost";
    protected $root = "root";
    protected $password = "";
    protected $dbase = "Food_App";
    


    public $conn_to = null;
    public function __construct()
    {
            // initialize connection property;
            $this->conn_to = mysqli_connect( $this->host, $this->root, $this->password, $this->dbase);
            if($this->conn_to->connect_error){
             echo "FAIL".$this->conn_to->connect_error;
            }
            // echo "...!";
    }

    // // SELECTING USER INFOMATION FROM THE DATABASE;
    // public function select()
    // {
    //     if(empty($val)){
    //         echo " ";
    //     } else {
    //                 $UserQuery = "SELECT * FROM regisration_info";
    //     $result = $this->conn_to->query($UserQuery);
    //     if($result->num_rows > 0){
    //         return $result; 
    //     }else{
    //         return false;
    //     }
    //     }

    // }
}