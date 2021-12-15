<?php

include($_SERVER["DOCUMENT_ROOT"]."/aost/bd/server-connect.php");


class Compagny
{

    /*PROPRIETES*/
    private $_id;
    private $_id_user;
    private $_id_domain;
    private $_other_domain;
    private $_name;
    private $_country;
    private $_city;
    private $_address;
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
        if(is_int($id)){
            $this->_id=$id;
        }
    }

    public function getId(){
        return $this->_id;
    }


    public function setId_user($id_user){
        if(is_int($id_user)){
            $this->_id_user=$id_user;
        }
    }
    
    public function getId_user(){
        return $this->_id_user;
    }


    
    public function setId_domain($id_domain){
        if(is_int($id_domain)){
            $this->_id_domain=$id_domain;
        }
    }
    
    public function getId_domain(){
        return $this->_id_domain;
    }

    
    public function setOther_domain($other_domain){
        if(is_string($other_domain)){
            $this->_other_domain=$other_domain;
        }
    }
    
    public function getOther_domain(){
        return $this->_other_domain;
    }

    
    public function setName($name){
        if(is_string($name)){
            $this->_name=$name;
        }
    }
    
    public function getName(){
        return $this->_name;
    }

    
    public function setCountry($country){
        if(is_string($country)){
            $this->_country=$country;
        }
    }
    
    public function getCountry(){
        return $this->_country;
    }

    
    public function setCity($city){
        if(is_int($city)){
            $this->_city=$city;
        }
    }
    
    public function getCity(){
        return $this->_city;
    }

    
    public function setAddress($address){
        if(is_string($address)){
            $this->_address=$address;
        }
    }
    
    public function getAddress(){
        return $this->_address;
    }
    

    public function setAdded_at($added_at){
        if(is_string($added_at)){
            $this->_added_at=$added_at;
        }
    }
    
    public function getAdded_at(){
        return $this->_added_at;
    }













    /*METHODES FONCTIONNELLES*/


    public function addCompagny(Compagny $compagny){
        include(_APP_PATH."bd/server-connect.php");
        
        $query=$db->prepare("INSERT INTO compagny VALUES (?,?,?,?,?,?,?,?,?)");

        $id=0;
        $id_user=$compagny->getId_user();
        $id_domain=$compagny->getId_domain();
        $other_domain=$compagny->getOther_domain();
        $name=$compagny->getName();
        $country=$compagny->getCountry();
        $city=$compagny->getCity();
        $address=$compagny->getAddress();
        $added_at=$compagny->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$id_user);
        $query->bindParam(3,$id_domain);
        $query->bindParam(4,$other_domain);
        $query->bindParam(5,$name);
        $query->bindParam(6,$country);
        $query->bindParam(7,$city);
        $query->bindParam(8,$address);
        $query->bindParam(9,$added_at);


        if($query->execute()){
          return true;
      }else{
          return false;
      }
  }







  public function removeCompagny($id_domain){
    include(_APP_PATH."bd/server-connect.php");
    
    if(is_int($id_domain)){
        $req=$db->prepare("DELETE FROM compagny WHERE id=?");

        $req->bindParam(1,$id_domain);

        if($req->execute()){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
    
}




public function getLastCompagny(){
    include(_APP_PATH."bd/server-connect.php");
    
    $query=$db->prepare("SELECT * FROM compagny WHERE id=(SELECT MAX(id) FROM compagny)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Compagny($data)); 
    }else{
        return false;
    }
}




public function getCompagny($id){
    include(_APP_PATH."bd/server-connect.php");
    
    if(is_int($id)){
        $query=$db->prepare("SELECT * FROM compagny WHERE id=?");
        $query->bindParam(1,$id);
        if($query->execute() && $query->rowCount()==1){
            $data=$query->fetch();
            return (new Compagny($data));   
        }else{
            return false;
        }
    }else{
        return false;
    }

}




public function getCompagnys() {
    include(_APP_PATH."bd/server-connect.php");
    

    $query=$db->prepare("SELECT * FROM compagny ORDER BY id ASC");

    $compagny=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $compagny[]=new Compagny($data);
        }
        return $compagny;
    }else{
        return false;
    }
}







public function editCompagny(Compagny $compagny) {
    include(_APP_PATH."bd/server-connect.php");
    
    $query=$db->prepare("UPDATE compagny
        SET name=?,
        country=?,
        city=?,
        address=?,
        id_domain=?,
        other_domain=?
        WHERE id=?

        ");

    $id=$compagny->getId();
    $name=$compagny->getName();
    $country=$compagny->getCountry();
    $city=$compagny->getCity();
    $address=$compagny->getAddress();
    $id_domain=$compagny->getId_domain();
    $other_domain=$compagny->getOther_domain();

    $query->bindParam(1,$name);
    $query->bindParam(2,$country);
    $query->bindParam(3,$city);
    $query->bindParam(4,$address);
    $query->bindParam(5,$id_domain);
    $query->bindParam(6,$other_domain);
    $query->bindParam(7,$id);

    if($query->execute()){

        return true;

    }else{
        return false;
    }
}




}

?>