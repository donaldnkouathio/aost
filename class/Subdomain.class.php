<?php


class Subdomain
{

   /*PROPRIETES*/
   private $_id;
   private $_id_admin;
   private $_id_domain;
   private $_name;
   private $_color;
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


public function setId_admin($id_admin){
    $this->_id_admin=$id_admin;
}

public function getId_admin(){
    return $this->_id_admin;
}


public function setId_domain($id_domain){
 $this->_id_domain=intval($id_domain);
}

public function getId_domain(){
    return $this->_id_domain;
}


public function setName($name){
   $this->_name=htmlentities(strval($name));
}

public function getName(){
    return $this->_name;
}



public function setColor($color){
   $this->_color=htmlentities(strval($color));
}

public function getColor(){
    return $this->_color;
}



public function setAdded_at($added_at){
   $this->_added_at=htmlentities(strval($added_at));
}

public function getAdded_at(){
    return $this->_added_at;
}













/*METHODES FONCTIONNELLES*/

public function addSubdomain(Subdomain $subdomain){
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("INSERT INTO subdomains VALUES (?,?,?,?,?,?)");

    $id=0;
    $id_admin=$subdomain->getId_admin();
    $id_domain=$subdomain->getId_domain();
    $name=$subdomain->getName();
    $color=$subdomain->getColor();
    $added_at=$subdomain->getAdded_at();

    $query->bindParam(1,$id);
    $query->bindParam(2,$id_admin);
    $query->bindParam(3,$id_domain);
    $query->bindParam(4,$name);
    $query->bindParam(5,$color);
    $query->bindParam(6,$added_at);


    if($query->execute()){
      return true;
  }else{
      return false;
  }
}







public function removeSubdomain($id_subdomain){
    include(_APP_PATH."bd/server-connect.php");

    $id_subdomain=intval($id_subdomain);
    $req=$db->prepare("DELETE FROM subdomains WHERE id=?");

    $req->bindParam(1,$id_subdomain);

    if($req->execute()){
        return true;
    }else{
        return false;
    }

}




public function getLastSubdomain(){
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("SELECT * FROM subdomains WHERE id=(SELECT MAX(id) FROM subdomains)");
    if($query->execute() && $query->rowCount()==1){
       $data=$query->fetch();
       return (new subdomain($data));
   }else{
       return false;
   }
}




public function getSubdomain($id){
    include(_APP_PATH."bd/server-connect.php");

    $id=intval($id);
    $query=$db->prepare("SELECT * FROM subdomains WHERE id=?");
    $query->bindParam(1,$id);
    if($query->execute() && $query->rowCount()==1){
      $data=$query->fetch();
      return (new Subdomain($data));
  }else{
      return false;
  }

}




public function getSubdomains() {
    include(_APP_PATH."bd/server-connect.php");


    $query=$db->prepare("SELECT * FROM subdomains ORDER BY name ASC");

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




public function getListSubdomains($id_domain) {
    include(_APP_PATH."bd/server-connect.php");


    $id_domain=intval($id_domain);
    $query=$db->prepare("SELECT * FROM subdomains WHERE id_domain=? ORDER BY name ASC");
    $query->bindParam(1,$id_domain);
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
       id_admin=?,
       id_domain=?,
       color=?
       WHERE id=?

       ");

    $id=$subdomain->getId();
    $id_admin=$subdomain->getId_admin();
    $id_domain=$subdomain->getId_domain();
    $name=$subdomain->getName();
    $color=$subdomain->getColor();

    $query->bindParam(1,$name);
    $query->bindParam(2,$id_admin);
    $query->bindParam(3,$id_domain);
    $query->bindParam(4,$color);
    $query->bindParam(5,$id);

    if($query->execute()){

       return true;

   }else{
       return false;
   }
}




}

?>
