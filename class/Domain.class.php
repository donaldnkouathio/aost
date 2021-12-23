<?php


include($_SERVER["DOCUMENT_ROOT"]."/aost/bd/server-connect.php");


class domain
{

    /*PROPRIETES*/
    private $_id;
    private $_id_admin;
    private $_name;
    private $_color;
    private $_image;
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
        $this->_id=$id;
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


    public function setImage($image){
        $this->_image=htmlentities(strval($image));
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

    public function addDomain(Domain $domain){
        include(_APP_PATH."bd/server-connect.php");

        $query=$db->prepare("INSERT INTO domains VALUES (?,?,?,?,?,?)");

        $id=0;
        $id_admin=$domain->getId_admin();
        $name=$domain->getName();
        $color=$domain->getColor();
        $image=$domain->getImage();
        $added_at=$domain->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$id_admin);
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






  public function removeDomain($id_domain){
    include(_APP_PATH."bd/server-connect.php");

    $id_domain=intval($id_domain);
    $req=$db->prepare("DELETE FROM domains WHERE id=?");

    $req->bindParam(1,$id_domain);

    if($req->execute()){
        return true;
    }else{
        return false;
    }

}


public function getLastDomain(){
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("SELECT * FROM domains WHERE id=(SELECT MAX(id) FROM domain)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Domain($data));
    }else{
        return false;
    }
}




public function getDomain($id){
    include(_APP_PATH."bd/server-connect.php");

    $id=intval($id);
    $query=$db->prepare("SELECT * FROM domains WHERE id=?");
    $query->bindParam(1,$id);
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Domain($data));
    }else{
        return false;
    }

}




public function getDomains() {
    include(_APP_PATH."bd/server-connect.php");


    $query=$db->prepare("SELECT * FROM domains ORDER BY name ASC");

    $domain=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $domain[]=new Domain($data);
        }
        return $domain;
    }else{
        return false;
    }
}







public function editDomain(Domain $domain) {
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("UPDATE domains
        SET name=?,
        color=?,
        image=?
        WHERE id=?

        ");

    $id=$domain->getId();
    $name=$domain->getName();
    $color=$domain->getColor();
    $image=$domain->getImage();

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
