<?php

include($_SERVER["DOCUMENT_ROOT"]."/aost/bd/server-connect.php");


class Compagny
{

    /*PROPRIETES*/
    private $_id;
    private $_id_user;
    private $_id_compagny;
    private $_other_compagny;
    private $_name;
    private $_country;
    private $_city;
    private $_address;
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


    public function setId_user($id_user){
        if(is_int($id_user)){
            $this->_id_user=$id_user;
        }
    }
    
    public function getId_user(){
        return $this->_id_user;
    }


    
    public function setId_compagny($id_compagny){
        if(is_int($id_compagny)){
            $this->_id_compagny=$id_compagny;
        }
    }
    
    public function getId_compagny(){
        return $this->_id_compagny;
    }

    
    public function setOther_compagny($other_compagny){
        if(is_string($other_compagny)){
            $this->_other_compagny=$other_compagny;
        }
    }
    
    public function getOther_compagny(){
        return $this->_other_compagny;
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
        $query=$db->prepare("INSERT INTO compagny VALUES (?,?,?,?,?,?,?,?,?)");

        $id=0;
        $id_user=$compagny->getId_user();
        $id_compagny=$compagny->getId_compagny();
        $other_compagny=$compagny->getOther_compagny();
        $name=$compagny->getName();
        $country=$compagny->getCountry();
        $city=$compagny->getCity();
        $address=$compagny->getAddress();
        $added_at=$compagny->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$id_user);
        $query->bindParam(3,$id_compagny);
        $query->bindParam(4,$other_compagny);
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







  public function removeCompagny($id_compagny){
    if(is_int($id_compagny)){
        $req=$db->prepare("DELETE FROM compagny WHERE id=?");

        $req->bindParam(1,$id_compagny);

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
    $query=$db->prepare("SELECT * FROM compagny WHERE id=(SELECT MAX(id) FROM compagny)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Compagny($data)); 
    }else{
        return false;
    }
}




public function getCompagny($id){
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




public function getCompagny() {

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
    $query=$db->prepare("UPDATE compagny
        SET name=?,
        country=?,
        city=?,
        address=?,
        id_compagny=?,
        other_compagny=?
        WHERE id=?

        ");

    $id=$compagny->getId();
    $name=$compagny->getName();
    $country=$compagny->getCountry();
    $city=$compagny->getCity();
    $address=$compagny->getAddress();
    $id_compagny=$compagny->getid_compagny();
    $other_compagny=$compagny->getOther_compagny();

    $query->bindParam(1,$name);
    $query->bindParam(2,$country);
    $query->bindParam(3,$city);
    $query->bindParam(4,$address);
    $query->bindParam(5,$id_compagny);
    $query->bindParam(6,$other_compagny);
    $query->bindParam(7,$id);

    if($query->execute()){

        return true;

    }else{
        return false;
    }
}




}

?>