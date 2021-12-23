<?php

include($_SERVER["DOCUMENT_ROOT"]."/aost/bd/server-connect.php");


class Alert
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
  $this->_id=intval($id);
}

public function getId(){
  return $this->_id;
}


public function setId_domain($id_domain){
  $this->_id_domain=intval($id_domain);
}

public function getId_domain(){
  return $this->_id_domain;
}


public function setId_subdomain($id_subdomain){
  $this->_id_subdomain=intval($id_subdomain);
}

public function getId_subdomain(){
  return $this->_id_subdomain;
}


public function setEmail($email){
 $this->_email=htmlentities(strval($email));
}

public function getEmail(){
  return $this->_email;
}


public function setCv_file($cv_file){
 $this->_cv_file=htmlentities(strval($cv_file));
}

public function getCv_file(){
  return $this->_cv_file;
}


public function setAdded_at($added_at){
 $this->_added_at=htmlentities(strval($added_at));
}

public function getAdded_at(){
  return $this->_added_at;
}













/*METHODES FONCTIONNELLES*/


public function addAlert(Alert $alert){
  include(_APP_PATH."bd/server-connect.php");

  $query=$db->prepare("INSERT INTO alerts VALUES (?,?,?,?,?,?)");

  $id=0;
  $id_domain=$alert->getId_domain();
  $id_subdomain=$alert->getId_subdomain();
  $email=$alert->getEmail();
  $cv_file=$alert->getCv_file();
  $added_at=$alert->getAdded_at();

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




public function removeAlert($id_alert){
  include(_APP_PATH."bd/server-connect.php");

  $id_alert=intval($id_alert);
  $req=$db->prepare("DELETE FROM alerts WHERE id=?");

  $req->bindParam(1,$id_alert);

  if($req->execute()){
   return true;
 }else{
   return false;
 }

}




public function getLastAlert(){
  include(_APP_PATH."bd/server-connect.php");

  $query=$db->prepare("SELECT * FROM alerts WHERE id=(SELECT MAX(id) FROM alerts)");
  if($query->execute() && $query->rowCount()==1){
   $data=$query->fetch();
   return (new Alert($data)); 
 }else{
   return false;
 }
}




public function getAlert($id){
  include(_APP_PATH."bd/server-connect.php");

  $id=intval($id);
  $query=$db->prepare("SELECT * FROM alerts WHERE id=?");
  $query->bindParam(1,$id);
  if($query->execute() && $query->rowCount()==1){
   $data=$query->fetch();
   return (new Alert($data));	
 }else{
   return false;
 }

}




public function getAlerts() {
  include(_APP_PATH."bd/server-connect.php");


  $query=$db->prepare("SELECT * FROM alerts ORDER BY id ASC");

  $alerts=[];

  if($query->execute()){
   while($data=$query->fetch()){
    $alerts[]=new Alert($data);
  }
  return $alerts;
}else{
  return false;
}
}





public function editAlert(Alert $alert) {
  include(_APP_PATH."bd/server-connect.php");

  $query=$db->prepare("UPDATE alerts
   SET id_domain=?,
   id_subdomain=?,
   email=?,
   cv_file=?
   WHERE id=?

   ");

  $id=$alert->getId();
  $id_domain=$alert->getId_domain();
  $id_subdomain=$alert->getId_subdomain();
  $email=$alert->getEmail();
  $cv_file=$alert->getCv_file();

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