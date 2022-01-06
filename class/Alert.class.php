<?php

include($_SERVER["DOCUMENT_ROOT"]."/aost/bd/server-connect.php");


class Alert
{

 /*PROPRIETES*/
 private $_id;
 private $_id_city;
 private $_email;
 private $_domain;
 private $_name;
 private $_first_name;
 private $_phone;
 private $_about;
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


public function setEmail($email){
 $this->_email=htmlentities(strval($email));
}

public function getEmail(){
  return $this->_email;
}


public function setDomain($domain){
 $this->_domain=htmlentities(strval($domain));
}

public function getDomain(){
  return $this->_domain;
}


public function setName($name){
 $this->_name=htmlentities(strval($name));
}

public function getName(){
  return $this->_name;
}


public function setFirst_name($first_name){
 $this->_first_name=htmlentities(strval($first_name));
}

public function getFirst_name(){
  return $this->_first_name;
}


public function setPhone($phone){
 $this->_phone=htmlentities(strval($phone));
}

public function getPhone(){
  return $this->_phone;
}


public function setId_city($id_city){
 $this->_id_city=intval($id_city);
}

public function getId_city(){
  return $this->_id_city;
}


public function setAbout($about){
 $this->_about=htmlentities(strval($about));
}

public function getAbout(){
  return $this->_about;
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

  $query=$db->prepare("INSERT INTO alerts VALUES (?,?,?,?,?,?,?,?,?,?)");

  $id=0;
  $email=$alert->getEmail();
  $id_city=$alert->getId_city();
  $domain=$alert->getDomain();
  $name=$alert->getName();
  $first_name=$alert->getFirst_name();
  $phone=$alert->getPhone();
  $about=$alert->getAbout();
  $cv_file=$alert->getCv_file();
  $added_at=$alert->getAdded_at();

  $query->bindParam(1,$id);
  $query->bindParam(2,$id_city);
  $query->bindParam(3,$email);
  $query->bindParam(4,$domain);
  $query->bindParam(5,$name);
  $query->bindParam(6,$first_name);
  $query->bindParam(7,$phone);
  $query->bindParam(8,$about);
  $query->bindParam(9,$cv_file);
  $query->bindParam(10,$added_at);


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




public function getAlertsDomain($domain) {
  include(_APP_PATH."bd/server-connect.php");


  $query=$db->prepare("SELECT * FROM alerts WHERE domain LIKE '%$domain%' GROUP BY email ORDER BY id ASC");

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








}



?>