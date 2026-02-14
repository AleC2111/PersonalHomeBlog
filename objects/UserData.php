<?php 
class UserData{
    private string $name;
    private string $email;
    private string $password;
    private string $salt;

    public function __construct(){
        $this->name= "";
        $this->email= "";
        $this->password= "";
        $this->createRandomSalt();
    }

    private function utilIsValueNull($text){
        if(is_null($text) || $text=="") throw new Error("Error: No se permiten valores nulos");
    }
    private function utilSanitizeText($text, $dbConnection){
        return pg_escape_string($dbConnection, $text);
    }
    private function utilValidateEmail($email){
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Error("Error: Correo Invalido");
        }
        return $email;
    }
    private function createRandomSalt(){
        $this->salt = bin2hex(random_bytes(mt_rand(8, 16) / 2));
    }
    public function isUserUnique($dbConnection){
        $name = $this->name;
        try{
            $query = "SELECT EXISTS(SELECT '$name' FROM usuario WHERE name='$name');";
            $result = pg_query($dbConnection, $query);
            $checkExistsUser = pg_fetch_result($result, 0);
            if ($result && $checkExistsUser=="t") {
                throw new Error("Error: El usuario ya existe");
            }
        } catch(Exception $error){
            return $error."";
        }
    }
    public function hashPassword(){
        if(strlen($this->password)<8 || $this->password==""){
            throw new Error("Error: Contraseña muy corta o inexistente");
        }
        $this->password = base64_encode($this->password);
        $this->utilIsValueNull($this->salt);
        $this->password = base64_encode($this->password.$this->salt);
    }

    public function setName($name, $dbConnection){
        $this->utilIsValueNull($name);
        $this->name = $this->utilSanitizeText($name, $dbConnection);
    }
    public function getName(){
        return $this->name;
    }

    public function setEmail($email){
        $this->utilIsValueNull($email);
        $this->email = $this->utilValidateEmail($email);
    }
    public function getEmail(){
        return $this->email;
    }

    public function setPassword($password, $dbConnection){
        $this->utilIsValueNull($password);
        $this->password = $this->utilSanitizeText($password, $dbConnection);
    }
    public function getPassword(){
        return $this->password;
    }

    public function setSalt($salt){
        $this->utilIsValueNull($salt);
        $this->salt = $salt;
    }
    public function getSalt(){
        return $this->salt;
    }
}
?>