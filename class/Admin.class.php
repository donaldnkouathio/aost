 <?php

 include("../bd/server-connect.php");

 class Admin
 {

    /*PROPRIETES*/
    private $_id;
    private $_email;
    private $_password;
    private $_role;
    private $_name;
    private $_added_at;

    /*CONSTRUCTEUR*/
    private function __construct(array $data){

        foreach ($data as $key => $value) {
            $method='set'.ucfirst($key);

            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }


    /*SETTERS & GETTERS*/

    public function setId($id){
        if(is_int($id)){
            $this->_id=$id;
        }
    }

    public function getId(){
        return $this->_id;
    }


    public function setEmail($email){
        if(is_string($email)){
            $this->_id=$email;
        }
    }
    
    public function getEmail(){
        return $this->_email;
    }

    
    public function setPassword($password){
        if(is_string($password)){
            $this->_id=$password;
        }
    }
    
    public function getPassword(){
        return $this->_password;
    }

    
    public function setRole($role){
        if(is_string($role)){
            $this->_id=$role;
        }
    }
    
    public function getRole(){
        return $this->_role;
    }

    
    public function setName($name){
        if(is_string($name)){
            $this->_id=$name;
        }
    }
    
    public function getName(){
        return $this->_name;
    }

    
    public function setAdded_at($added_at){
        if(is_string($added_at)){
            $this->_id=$added_at;
        }
    }
    
    public function getAdded_at(){
        return $this->_added_at;
    }













    /*METHODES FONCTIONNELLES*/

    public function addAdmin(Admin $admin){
        $query=$db->prepare("INSERT INTO admins VALUES (?,?,?,?,?,?)");

        $id=0;
        $email=$admin->getEmail();
        $password=$admin->getPassword();
        $role=$admin->getRole();
        $name=$admin->getName();
        $added_at=$admin->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$email);
        $query->bindParam(3,$password);
        $query->bindParam(4,$role);
        $query->bindParam(5,$name);
        $query->bindParam(6,$added_at);


        if($query->execute()){
          return true;
      }else{
          return false;
      }
  }







  public function removeAdmin($id_admin){
    if(is_int($id_admin)){
        $req=$db->prepare("DELETE FROM admins WHERE id=?");

        $req->bindParam(1,$id_admin);

        if($req->execute()){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
    
}


public function getLastAdmin(){
    $query=$db->prepare("SELECT * FROM admins WHERE id=(SELECT MAX(id) FROM admins)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Admin($data)); 
    }else{
        return false;
    }
}




public function getAdmin($id){
    if(is_int($id)){
        $query=$db->prepare("SELECT * FROM admins WHERE id=?");
        $query->bindParam(1,$id);
        if($query->execute() && $query->rowCount()==1){
            $data=$query->fetch();
            return (new Admin($data));   
        }else{
            return false;
        }
    }else{
        return false;
    }

}




public function getAdmins() {

    $query=$db->prepare("SELECT * FROM admins ORDER BY id ASC");

    $admins=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $admins[]=new Admin($data);
        }
        return $admins;
    }else{
        return false;
    }
}







public function editAdmin(Admin $admin) {
    $query=$db->prepare("UPDATE admins
        SET email=?,
        password=?,
        role=?,
        name=?
        WHERE id=?

        ");

    $id=$admin->getId();
    $email=$admin->getEmail();
    $password=$admin->getPassword();
    $role=$admin->getRole();
    $name=$admin->getName();

    $query->bindParam(1,$email);
    $query->bindParam(2,$password);
    $query->bindParam(3,$role);
    $query->bindParam(4,$name);
    $query->bindParam(5,$id);

    if($query->execute()){

        return true;

    }else{
        return false;
    }
}





public function logIn(Admin $admin) {
    $blocked=0;

    /* Recherche de l'administrateur */
    $query=$db->prepare("SELECT * FROM admins WHERE email=? AND password=UNHEX(SHA1(?))");

    $email=$admin->getEmail();
    $password=$admin->getPassword();

    $query->bindParam(1,$email);
    $query->bindParam(2,$password);

    if($query->execute()){
        /* Si son compte a été trouvé */
        if($query->rowCount()==1){

            $data=$query->fetch();

            $admin_found=new Admin($data);
            $_SESSION['type']="admin";
            $_SESSION['id']=$admin_found->getId();
            $_SESSION['email']=$admin_found->getEmail();
            $_SESSION['role']=$admin_found->getRole();

            return true;

        }else{
            /* Si son compte n'a pas été trouvé */
            return "not found";
        }
    }else{
        return false;
    }
}






public function logOut() {
    $_SESSION=array();
    header("location:../home/index.php");
}



}

?>