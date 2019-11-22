<?php 
class users { 
    protected $user_username;
    protected $user_password;
    protected $user_status;
    protected $user_firstname;
    protected $user_lastname;
    protected $user_gender;
    protected $user_birthdate;
    protected $user_city;
    protected $user_state;
    protected $user_picture;

    function __construct($data) {
        foreach ($data as $clave => $valor){
            if (property_exists($this,$clave)) {
                $this->$clave = $valor;
            }
        }
    }

    function getScore() {
        return $this->score;
    }

    function getName() {
        return $this->name;
    }

    function getRecordDate() {
        return $this->recordDate;
    }

    function getMessage(){
        return "user_username".$this->user_username."\w".
                "user_firstname".$this->user_firstname."\w".
                "user_lastname".$this->user_lastname."\w".
                "user_password".$this->user_password."\w".
                "user_status".$this->user_status."\w".
                "user_gender".$this->user_gender."\w".
                "user_birthdate".$this->user_birthdate."\w".
                "user_state".$this->user_state."\w".
                "user_picture".$this->user_picture;

    }
    
    public function getValues() { 
        $fields = array();
        $fields[] = 'null';
        foreach ($this as $clave => $valor){
                $fields[] = "'".$valor."'";
        }
        return $fields;

    }

    public function getOn(){
        $this->bdh;
    }

} 
?> 