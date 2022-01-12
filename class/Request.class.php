<?php


class Request
{

    /*PROPRIETES*/
    private $_id;
    private $_compagny;
    private $_email;
    private $_city;
    private $_compagny_type;
    private $_person;
    private $_phone;
    private $_fax_phone;
    private $_need;
    private $_deleted;
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


    public function setCompagny($compagny){
        $this->_compagny=htmlentities(strval($compagny));
    }

    public function getCompagny(){
        return $this->_compagny;
    }


    public function setEmail($email){
        $this->_email=strval($email);
    }

    public function getEmail(){
        return $this->_email;
    }

    public function setCity($city){
        $this->_city=htmlentities(strval($city));
    }

    public function getCity(){
        return $this->_city;
    }


    public function setCompagny_type($compagny_type){
        $this->_compagny_type=htmlentities(strval($compagny_type));
    }

    public function getCompagny_type(){
        return $this->_compagny_type;
    }


    public function setPerson($person){
        $this->_person=htmlentities(strval($person));
    }

    public function getPerson(){
        return $this->_person;
    }


    public function setPhone($phone){
        $this->_phone=htmlentities(strval($phone));
    }

    public function getPhone(){
        return $this->_phone;
    }


    public function setFax_phone($fax_phone){
        $this->_fax_phone=htmlentities(strval($fax_phone));
    }

    public function getFax_phone(){
        return $this->_fax_phone;
    }

    public function setNeed($need){
        $this->_need=htmlentities(strval($need));
    }

    public function getNeed(){
        return $this->_need;
    }

    public function setDeleted($deleted){
        $this->_deleted=intval($deleted);
    }

    public function getDeleted(){
        return $this->_deleted;
    }


    public function setAdded_at($added_at){
        $this->_added_at=htmlentities(strval($added_at));
    }

    public function getAdded_at(){
        return $this->_added_at;
    }













    /*METHODES FONCTIONNELLES*/

    public function addRequest(Request $request){
        include(_APP_PATH."bd/server-connect.php");

        $query=$db->prepare("INSERT INTO requests VALUES (?,?,?,?,?,?,?,?,?,?,?)");

        $id=0;
        $compagny=$request->getCompagny();
        $email=$request->getEmail();
        $city=$request->getCity();
        $compagny_type=$request->getCompagny_type();
        $person=$request->getPerson();
        $phone=$request->getPhone();
        $fax_phone=$request->getFax_phone();
        $need=$request->getNeed();
        $deleted=$request->getDeleted();
        $added_at=$request->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$compagny);
        $query->bindParam(3,$email);
        $query->bindParam(4,$city);
        $query->bindParam(5,$compagny_type);
        $query->bindParam(6,$person);
        $query->bindParam(7,$phone);
        $query->bindParam(8,$fax_phone);
        $query->bindParam(9,$need);
        $query->bindParam(10,$deleted);;
        $query->bindParam(11,$added_at);

        if($query->execute()){
          return true;
      }else{
          return false;
      }
  }





  public function removeRequest($id_request){
    include(_APP_PATH."bd/server-connect.php");

    $id_request=intval($id_request);
    $req=$db->prepare("DELETE FROM requests WHERE id=?");

    $req->bindParam(1,$id_request);

    if($req->execute()){
        return true;
    }else{
        return false;
    }

}



public function getLastRequest(){
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("SELECT * FROM requests WHERE id=(SELECT MAX(id) FROM requests)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Request($data));
    }else{
        return false;
    }
}




public function getRequest($id){
    include(_APP_PATH."bd/server-connect.php");

    $id=intval($id);
    $query=$db->prepare("SELECT * FROM requests WHERE id=?");
    $query->bindParam(1,$id);
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Request($data));
    }else{
        return false;
    }

}




public function getRequests() {
    include(_APP_PATH."bd/server-connect.php");


    $query=$db->prepare("SELECT * FROM requests ORDER BY id DESC");

    $requests=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $requests[]=new Request($data);
        }
        return $requests;
    }else{
        return false;
    }
}




public function getRequestsLimit($start) {
    include(_APP_PATH."bd/server-connect.php");

    $start=intval($start);
    $end=$start+10;
    $query=$db->prepare("SELECT * FROM requests ORDER BY id DESC LIMIT $start,$end");

    $requests=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $requests[]=new Request($data);
        }
        return $requests;
    }else{
        return false;
    }


}







public function editRequest(Request $request) {
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("UPDATE requests
        SET compagny=?,
        email=?,
        city=?,
        compagny_type=?,
        person=?,
        phone=?,
        fax_phone=?,
        need=?,
        deleted=?
        WHERE id=?

        ");

    $id=getId();
    $compagny=$request->getCompagny();
    $email=$request->getEmail();
    $city=$request->getCity();
    $compagny_type=$request->getCompagny_type();
    $person=$request->getPerson();
    $phone=$request->getPhone();
    $fax_phone=$request->getFax_phone();
    $need=$request->getNeed();
    $deleted=$request->getDeleted();

    $query->bindParam(1,$id);
    $query->bindParam(2,$compagny);
    $query->bindParam(3,$email);
    $query->bindParam(4,$city);
    $query->bindParam(5,$compagny_type);
    $query->bindParam(6,$person);
    $query->bindParam(7,$phone);
    $query->bindParam(8,$fax_phone);
    $query->bindParam(9,$need);
    $query->bindParam(10,$deleted);

    if($query->execute()){

        return true;

    }else{
        return false;
    }
}




}

?>
