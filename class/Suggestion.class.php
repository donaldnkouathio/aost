<?php

include($_SERVER["DOCUMENT_ROOT"]."/aost/bd/server-connect.php");


class Suggestion
{

  /*PROPRIETES*/
  private $_id;
  private $_id_domain;
  private $_id_subdomain;
  private $_email;
  private $_cv_file;
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


 public function setId_domain($id_domain){
    if(is_int($id_domain)){
       $this->_id_domain=$id_domain;
    }
 }

 public function getId_domain(){
    return $this->_id_domain;
 }


 public function setId_subdomain($id_subdomain){
    if(is_int($id_subdomain)){
       $this->_id_subdomain=$id_subdomain;
    }
 }

 public function getId_subdomain(){
    return $this->_id_subdomain;
 }


 public function setEmail($email){
    if(is_string($email)){
       $this->_email=$email;
    }
 }

 public function getEmail(){
    return $this->_email;
 }


 public function setCv_file($cv_file){
    if(is_string($cv_file)){
       $this->_cv_file=$cv_file;
    }
 }

 public function getCv_file(){
    return $this->_cv_file;
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


 public function addSuggestion(Suggestion $suggestion){
    include(_APP_PATH."bd/server-connect.php");
    
    $query=$db->prepare("INSERT INTO suggestions VALUES (?,?,?,?,?,?)");

    $id=0;
    $id_domain=$suggestion->getId_domain();
    $id_subdomain=$suggestion->getId_subdomain();
    $email=$suggestion->getEmail();
    $cv_file=$suggestion->getCv_file();
    $added_at=$suggestion->getAdded_at();

    $query->bindParam(1,$id);
    $query->bindParam(2,$id_domain);
    $query->bindParam(3,$id_subdomain);
    $query->bindParam(4,$email);
    $query->bindParam(5,$cv_file);
    $query->bindParam(6,$added_at);


    if($query->execute()){
     return true;
  }else{
     return false;
  }
}




public function removeSuggestion($id_suggestion){
 include(_APP_PATH."bd/server-connect.php");
 
  if(is_int($id_suggestion)){
    $req=$db->prepare("DELETE FROM suggestions WHERE id=?");

    $req->bindParam(1,$id_suggestion);

    if($req->execute()){
      return true;
   }else{
      return false;
   }
}else{
 return false;
}

}




public function getLastSuggestion(){
 include(_APP_PATH."bd/server-connect.php");
 
 $query=$db->prepare("SELECT * FROM suggestions WHERE id=(SELECT MAX(id) FROM suggestions)");
 if($query->execute() && $query->rowCount()==1){
    $data=$query->fetch();
    return (new Suggestion($data)); 
 }else{
    return false;
 }
}




public function getSuggestion($id){
 include(_APP_PATH."bd/server-connect.php");
 
 if(is_int($id)){
    $query=$db->prepare("SELECT * FROM suggestions WHERE id=?");
    $query->bindParam(1,$id);
    if($query->execute() && $query->rowCount()==1){
       $data=$query->fetch();
       return (new Suggestion($data));	
    }else{
       return false;
    }
 }else{
    return false;
 }

}




public function getSuggestions() {
 include(_APP_PATH."bd/server-connect.php");
 

 $query=$db->prepare("SELECT * FROM suggestions ORDER BY id ASC");

 $suggestions=[];

 if($query->execute()){
    while($data=$query->fetch()){
      $suggestions[]=new Suggestion($data);
   }
   return $suggestions;
}else{
 return false;
}
}





public function editSuggestion(Suggestion $suggestion) {
 include(_APP_PATH."bd/server-connect.php");
 
 $query=$db->prepare("UPDATE suggestions
    SET id_domain=?,
    id_subdomain=?,
    email=?,
    cv_file=?
    WHERE id=?

    ");

 $id=$suggestion->getId();
 $id_domain=$suggestion->getId_domain();
 $id_subdomain=$suggestion->getId_subdomain();
 $email=$suggestion->getEmail();
 $cv_file=$suggestion->getCv_file();

 $query->bindParam(1,$id_domain);
 $query->bindParam(2,$id_subdomain);
 $query->bindParam(3,$email);
 $query->bindParam(4,$cv_file);
 $query->bindParam(5,$id);

 if($query->execute()){

    return true;

 }else{
    return false;
 }
}




}



?>