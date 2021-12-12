<?php

include($_SERVER["DOCUMENT_ROOT"]."/aost/bd/server-connect.php");


class Candidacy
{

    /*PROPRIETES*/
    private $_id;
    private $_id_candidacy;
    private $_id_customer;
    private $_id_user;
    private $_id_candidacy;
    private $_cv_file;
    private $_motivation_file;
    private $_deleted;
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


    public function setId_candidacy($id_candidacy){
        if(is_int($id_candidacy)){
            $this->_id_candidacy=$id_candidacy;
        }
    }
    
    public function getId_candidacy(){
        return $this->_id_candidacy;
    }

    
    public function setId_customer($id_customer){
        if(is_int($id_customer)){
            $this->_id_customer=$id_customer;
        }
    }
    
    public function getId_customer(){
        return $this->_id_customer;
    }

    
    public function setId_user($id_user){
        if(is_int($id_user)){
            $this->_id_user=$id_user;
        }
    }
    
    public function getId_user(){
        return $this->_id_user;
    }

    
    public function setId_candidacy($id_candidacy){
        if(is_int($id_candidacy)){
            $this->_id_candidacy=$id_candidacy;
        }
    }
    
    public function getId_candidacy(){
        return $this->_id_candidacy;
    }

    
    public function setCv_file($cv_file){
        if(is_string($cv_file)){
            $this->_cv_file=$cv_file;
        }
    }
    
    public function getCv_file(){
        return $this->_cv_file;
    }

    
    public function setMotivation_file($motivation_file){
        if(is_string($motivation_file)){
            $this->_motivation_file=$motivation_file;
        }
    }
    
    public function getMotivation_file(){
        return $this->_motivation_file;
    }

    
    public function setDeleted($deleted){
        if(is_int($deleted)){
            $this->_deleted=$deleted;
        }
    }
    
    public function getDeleted(){
        return $this->_deleted;
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



    public function addCandidacy(Candidacy $candidacy){
        $query=$db->prepare("INSERT INTO candidacy VALUES (?,?,?,?,?,?,?,?,?)");

        $id=0;
        $id_offer=$candidacy->getId_offer();
        $id_customer=$candidacy->getId_customer();
        $id_user=$candidacy->getId_user();
        $id_candidacy=$candidacy->getId_candidacy();
        $cv_file=$candidacy->getCv_file();
        $motivation_file=$candidacy->getMotivation_file();
        $deleted=$candidacy->getDeleted();
        $added_at=$candidacy->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$id_offer);
        $query->bindParam(3,$id_customer);
        $query->bindParam(4,$id_user);
        $query->bindParam(5,$id_candidacy);
        $query->bindParam(6,$cv_file);
        $query->bindParam(7,$motivation_file);
        $query->bindParam(8,$deleted);
        $query->bindParam(9,$added_at);


        if($query->execute()){
          return true;
      }else{
          return false;
      }
  }







  public function removeCandidacy($id_candidacy){
    if(is_int($id_candidacy)){
        $req=$db->prepare("DELETE FROM candidacy WHERE id=?");

        $req->bindParam(1,$id_candidacy);

        if($req->execute()){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
    
}




public function getLastCandidacy(){
    $query=$db->prepare("SELECT * FROM candidacy WHERE id=(SELECT MAX(id) FROM candidacy)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Candidacy($data)); 
    }else{
        return false;
    }
}




public function getCandidacy($id){
    if(is_int($id)){
        $query=$db->prepare("SELECT * FROM candidacy WHERE id=?");
        $query->bindParam(1,$id);
        if($query->execute() && $query->rowCount()==1){
            $data=$query->fetch();
            return (new Candidacy($data));   
        }else{
            return false;
        }
    }else{
        return false;
    }

}




public function getCandidacy() {

    $query=$db->prepare("SELECT * FROM candidacy ORDER BY id ASC");

    $candidacy=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $candidacy[]=new Candidacy($data);
        }
        return $candidacy;
    }else{
        return false;
    }
}







public function editCandidacy(Candidacy $candidacy) {
    $query=$db->prepare("UPDATE candidacy
        SET id_candidacy=?,
        cv_file=?,
        motivation_file=?,
        deleted=?
        WHERE id=?

        ");

    $id=$candidacy->getId();
    $id_candidacy=$candidacy->getId_candidacy();
    $cv_file=$candidacy->getCv_file();
    $motivation_file=$candidacy->getMotivation_file();
    $deleted=$candidacy->getDeleted();

    $query->bindParam(1,$id_candidacy);
    $query->bindParam(2,$cv_file);
    $query->bindParam(3,$motivation_file);
    $query->bindParam(4,$deleted);
    $query->bindParam(5,$id);

    if($query->execute()){

        return true;

    }else{
        return false;
    }
}




}

?>