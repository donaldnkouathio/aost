<?php


class City
{

    /*PROPRIETES*/
    private $_id;
    private $_name;
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


    public function setName($name){
        $this->_name=htmlentities(strval($name));
    }

    public function getName(){
        return $this->_name;
    }



    public function setAdded_at($added_at){
        $this->_added_at=strval($added_at);
    }

    public function getAdded_at(){
        return $this->_added_at;
    }













    /*METHODES FONCTIONNELLES*/




    public function addCity(City $city){
        include(_APP_PATH."bd/server-connect.php");

        $query=$db->prepare("INSERT INTO city VALUES (?,?,?)");

        $id=0;
        $name=$city->getName();
        $added_at=$city->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$name);
        $query->bindParam(3,$added_at);


        if($query->execute()){
          return true;
      }else{
          return false;
      }
  }






  public function removeCity($id_city){
    include(_APP_PATH."bd/server-connect.php");

    $id_city=intval($id_city);
    $req=$db->prepare("DELETE FROM city WHERE id=?");

    $req->bindParam(1,$id_city);

    if($req->execute()){
        return true;
    }else{
        return false;
    }

}



public function getLastCity(){
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("SELECT * FROM city WHERE id=(SELECT MAX(id) FROM city)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new City($data));
    }else{
        return false;
    }
}




public function getCity($id){
    include(_APP_PATH."bd/server-connect.php");

    $id=intval($id);
    $query=$db->prepare("SELECT * FROM city WHERE id=?");
    $query->bindParam(1,$id);
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new City($data));
    }else{
        return false;
    }

}




public function getCitys() {
    include(_APP_PATH."bd/server-connect.php");


    $query=$db->prepare("SELECT * FROM city ORDER BY name ASC");

    $city=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $city[]=new City($data);
        }
        return $city;
    }else{
        return false;
    }
}







public function editCity(City $city) {
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("UPDATE city SET name=? WHERE id=?");

    $id=$city->getId();
    $name=$city->getName();

    $query->bindParam(1,$name);
    $query->bindParam(2,$id);

    if($query->execute()){

        return true;

    }else{
        return false;
    }
}




}

?>
