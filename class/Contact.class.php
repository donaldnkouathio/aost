<?php


class Contact
{

    /*PROPRIETES*/
    private $_id;
    private $_role;
    private $_email;
    private $_name;
    private $_phone;
    private $_added_at;

    /*CONSTRUCTEUR*/
    public function __construct(array $data){

        foreach ($data as $key => $value) {
            $method='set'.ucfirst($key);

            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }


    /*SETTERS & GETTERS*/

    public function setId($id){
        $this->_id=intval($id);
    }

    public function getId(){
        return $this->_id;
    }


    public function setRole($role){
        $this->_role=htmlentities(strval($role));
    }

    public function getRole(){
        return $this->_role;
    }


    public function setEmail($email){
        $this->_email=htmlentities(trim(strval($email)," "));
    }

    public function getEmail(){
        return $this->_email;
    }


    public function setName($name){
        $this->_name=htmlentities(trim(strval($name)," "));
    }

    public function getName(){
        return $this->_name;
    }


    public function setPhone($phone){
        $this->_phone=htmlentities(strval($phone));
    }

    public function getPhone(){
        return $this->_phone;
    }


    public function setAdded_at($added_at){
        $this->_added_at=strval($added_at);
    }

    public function getAdded_at(){
        return $this->_added_at;
    }













    /*METHODES FONCTIONNELLES*/




    public function addContact(Contact $contact){
        include(_APP_PATH."bd/server-connect.php");

        $query=$db->prepare("INSERT INTO contact VALUES (?,?,?,?,?,?)");

        $id=0;
        $role=$contact->getRole();
        $email=$contact->getEmail();
        $name=$contact->getName();
        $phone=$contact->getPhone();
        $added_at=$contact->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$role);
        $query->bindParam(3,$email);
        $query->bindParam(4,$name);
        $query->bindParam(5,$phone);
        $query->bindParam(6,$added_at);


        if($query->execute()){
          return true;
      }else{
          return false;
      }
  }






  public function removeContact($id_contact){
    include(_APP_PATH."bd/server-connect.php");

    $id_contact=intval($id_contact);
    $req=$db->prepare("DELETE FROM contact WHERE id=?");

    $req->bindParam(1,$id_contact);

    if($req->execute()){
        return true;
    }else{
        return false;
    }

}



public function getLastContact(){
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("SELECT * FROM contact WHERE id=(SELECT MAX(id) FROM contact)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Contact($data));
    }else{
        return false;
    }
}




public function getContact($id){
    include(_APP_PATH."bd/server-connect.php");

    $id=intval($id);
    $query=$db->prepare("SELECT * FROM contact WHERE id=?");
    $query->bindParam(1,$id);
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Contact($data));
    }else{
        return false;
    }

}




public function getContacts() {
    include(_APP_PATH."bd/server-connect.php");


    $query=$db->prepare("SELECT * FROM contact ORDER BY id ASC");

    $contact=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $contact[]=new Contact($data);
        }
        return $contact;
    }else{
        return false;
    }
}







public function editContact(Contact $contact) {
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("UPDATE contact
        SET role=?,
        email=?,
        name=?,
        phone=?
        WHERE id=?

        ");

    $id=$contact->getId();
    $role=$contact->getRole();
    $email=$contact->getEmail();
    $name=$contact->getName();
    $phone=$contact->getPhone();

    $query->bindParam(1,$role);
    $query->bindParam(2,$email);
    $query->bindParam(3,$name);
    $query->bindParam(4,$phone);
    $query->bindParam(5,$id);

    if($query->execute()){

        return true;

    }else{
        return false;
    }
}




}

?>
