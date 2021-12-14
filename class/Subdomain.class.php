<?php

include($_SERVER["DOCUMENT_ROOT"]."/aost/bd/server-connect.php");


class Subdomain
{

   /*PROPRIETES*/
   private $_id;
   private $_id_domain;
   private $_name;
   private $_color;
   private $_image;
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


public function setId_domain($id_domain){
    if(is_int($id_domain)){
     $this->_id_domain=$id_domain;
 }
}

public function getId_domain(){
    return $this->_id_domain;
}


public function setName($name){
    if(is_string($name)){
     $this->_name=$name;
 }
}

public function getName(){
    return $this->_name;
}



public function setColor($color){
    if(is_string($color)){
     $this->_color=$color;
 }
}

public function getColor(){
    return $this->_color;
}



public function setImage($image){
    if(is_string($image)){
     $this->_image=$image;
 }
}

public function getImage(){
    return $this->_image;
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

public function addSubdomain(Subdomain $subdomain){
    include(_APP_PATH."bd/server-connect.php");
    
    $query=$db->prepare("INSERT INTO subdomains VALUES (?,?,?,?,?,?)");

    $id=0;
    $id_domain=$subdomain->getId_domain();
    $name=$subdomain->getName();
    $color=$subdomain->getColor();
    $image=$subdomain->getImage();
    $added_at=$subdomain->getAdded_at();

    $query->bindParam(1,$id);
    $query->bindParam(2,$id_domain);
    $query->bindParam(3,$name);
    $query->bindParam(4,$color);
    $query->bindParam(5,$image);
    $query->bindParam(6,$added_at);


    if($query->execute()){
      return true;
  }else{
      return false;
  }
}







public function removeSubdomain($id_subdomain){
    include(_APP_PATH."bd/server-connect.php");
    
    if(is_int($id_subdomain)){
        $req=$db->prepare("DELETE FROM subdomains WHERE id=?");

        $req->bindParam(1,$id_subdomain);

        if($req->execute()){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }

}




public function getLastSubdomain(){
    include(_APP_PATH."bd/server-connect.php");
    
    $query=$db->prepare("SELECT * FROM subdomains WHERE id=(SELECT MAX(id) FROM subdomain)");
    if($query->execute() && $query->rowCount()==1){
       $data=$query->fetch();
       return (new subdomain($data)); 
   }else{
       return false;
   }
}




public function getSubdomain($id){
    include(_APP_PATH."bd/server-connect.php");
    
    if(is_int($id)){
     $query=$db->prepare("SELECT * FROM subdomains WHERE id=?");
     $query->bindParam(1,$id);
     if($query->execute() && $query->rowCount()==1){
      $data=$query->fetch();
      return (new Subdomain($data));   
  }else{
      return false;
  }
}else{
   return false;
}

}




public function getSubdomains() {
    include(_APP_PATH."bd/server-connect.php");
    

    $query=$db->prepare("SELECT * FROM subdomains ORDER BY id ASC");

    $subdomain=[];

    if($query->execute()){
       while($data=$query->fetch()){
          $subdomain[]=new Subdomain($data);
      }
      return $subdomain;
  }else{
   return false;
}
}







public function editSubdomain(Subdomain $subdomain) {
    include(_APP_PATH."bd/server-connect.php");
    
    $query=$db->prepare("UPDATE subdomains
       SET name=?,
       color=?,
       image=?
       WHERE id=?

       ");

    $id=$subdomain->getId();
    $name=$subdomain->getName();
    $color=$subdomain->getColor();
    $image=$subdomain->getImage();

    $query->bindParam(1,$name);
    $query->bindParam(2,$color);
    $query->bindParam(3,$image);
    $query->bindParam(4,$id);

    if($query->execute()){

       return true;

   }else{
       return false;
   }
}




}

?>