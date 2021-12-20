<?php

include($_SERVER["DOCUMENT_ROOT"]."/aost/bd/server-connect.php");


class Offer
{

    /*PROPRIETES*/
    private $_id;
    private $_id_admin;
    private $_id_domain;
    private $_compagny;
    private $_profession;
    private $_city;
    private $_image;
    private $_description;
    private $_missions;
    private $_skill;
    private $_candidate_profile;
    private $_cv;
    private $_motivation;
    private $_validated;
    private $_deleted;
    private $_expired;
    private $_deadline;
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

    
    public function setId_admin($id_admin){
        $this->_id_admin=intval($id_admin);
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

    
    public function setProfession($profession){
        $this->_profession=htmlentities(strval($profession));
    }
    
    public function getProfession(){
        return $this->_profession;
    }

    
    public function setCity($city){
        $this->_city=htmlentities(strval($city));
    }
    
    public function getCity(){
        return $this->_city;
    }

    
    public function setImage($image){
        $this->_image=htmlentities(strval($image));
    }
    
    public function getImage(){
        return $this->_image;
    }

    
    public function setDescription($description){
        $this->_description=htmlentities(strval($description));
    }
    
    public function getDescription(){
        return $this->_description;
    }

    
    public function setMissions($missions){
        $this->_missions=htmlentities(strval($missions));
    }
    
    public function getMissions(){
        return $this->_missions;
    }

    
    public function setSkill($skill){
        $this->_skill=htmlentities(strval($skill));
    }
    
    public function getSkill(){
        return $this->_skill;
    }

    
    public function setCandidate_profile($candidate_profile){
        $this->_candidate_profile=htmlentities(strval($candidate_profile));
    }
    
    public function getCandidate_profile(){
        return $this->_candidate_profile;
    }

    
    public function setCv($cv){
        $this->_cv=intval($cv);
    }
    
    public function getCv(){
        return $this->_cv;
    }

    
    public function setMotivation($motivation){
        $this->_motivation=intval($motivation);
    }
    
    public function getMotivation(){
        return $this->_motivation;
    }

    
    public function setValidated($validated){
        $this->_validated=intval($validated);
    }
    
    public function getValidated(){
        return $this->_validated;
    }

    
    public function setDeleted($deleted){
        $this->_deleted=intval($deleted);
    }
    
    public function getDeleted(){
        return $this->_deleted;
    }

    
    public function setExpired($expired){
        $this->_expired=intval($expired);
    }
    
    public function getExpired(){
        return $this->_expired;
    }

    
    public function setDeadline($deadline){
        $this->_deadline=htmlentities(strval($deadline));
    }
    
    public function getDeadline(){
        return $this->_deadline;
    }

    
    public function setAdded_at($added_at){
        $this->_added_at=htmlentities(strval($added_at));
    }
    
    public function getAdded_at(){
        return $this->_added_at;
    }













    /*METHODES FONCTIONNELLES*/

    public function addOffer(Offer $offer){
        include(_APP_PATH."bd/server-connect.php");
        
        $query=$db->prepare("INSERT INTO offers VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $id=0;
        $id_admin=$offer->getId_admin();
        $id_domain=$offer->getId_domain();
        $compagny=$offer->getCompagny();
        $profession=$offer->getProfession();
        $city=$offer->getCity();
        $image=$offer->getImage();
        $description=$offer->getDescription();
        $missions=$offer->getMissions();
        $skill=$offer->getSkill();
        $candidate_profile=$offer->getCandidate_profile();
        $cv=$offer->getCv();
        $motivation=$offer->getMotivation();
        $validated=$offer->getValidated();
        $deleted=$offer->getDeleted();
        $expired=$offer->getExpired();
        $deadline=$offer->getDeadline();
        $added_at=$offer->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$id_admin);
        $query->bindParam(3,$id_domain);
        $query->bindParam(4,$compagny);
        $query->bindParam(5,$profession);
        $query->bindParam(6,$city);
        $query->bindParam(7,$image);
        $query->bindParam(8,$description);
        $query->bindParam(9,$missions);
        $query->bindParam(10,$skill);
        $query->bindParam(11,$candidate_profile);
        $query->bindParam(12,$cv);
        $query->bindParam(13,$motivation);
        $query->bindParam(14,$validated);
        $query->bindParam(15,$deleted);
        $query->bindParam(16,$expired);
        $query->bindParam(17,$deadline);
        $query->bindParam(18,$added_at);

        if($query->execute()){
          return true;
      }else{
          return false;
      }
  }





  public function removeOffer($id_offer){
    include(_APP_PATH."bd/server-connect.php");
    
    $id_offer=intval($id_offer);
    $req=$db->prepare("DELETE FROM offers WHERE id=?");

    $req->bindParam(1,$id_offer);

    if($req->execute()){
        return true;
    }else{
        return false;
    }
    
}



public function getLastOffer(){
    include(_APP_PATH."bd/server-connect.php");
    
    $query=$db->prepare("SELECT * FROM offers WHERE id=(SELECT MAX(id) FROM offers)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Offer($data)); 
    }else{
        return false;
    }
}




public function getOffer($id){
    include(_APP_PATH."bd/server-connect.php");
    
    $id=intval($id);
    $query=$db->prepare("SELECT * FROM offers WHERE id=?");
    $query->bindParam(1,$id);
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Offer($data));   
    }else{
        return false;
    }

}




public function getOffers() {
    include(_APP_PATH."bd/server-connect.php");
    

    $query=$db->prepare("SELECT * FROM offers ORDER BY id ASC");

    $offers=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $offers[]=new Offer($data);
        }
        return $offers;
    }else{
        return false;
    }
}




public function getOffersLimit($start) {
    include(_APP_PATH."bd/server-connect.php");
    
    $start=intval($start);
    $end=$start+10;
    $query=$db->prepare("SELECT * FROM offers ORDER BY id DESC LIMIT $start,$end");

    $offers=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $offers[]=new Offer($data);
        }
        return $offers;
    }else{
        return false;
    }


}







public function editOffer(Offer $offer) {
    include(_APP_PATH."bd/server-connect.php");
    
    $query=$db->prepare("UPDATE offers
        SET id_domain=?,
        profession=?,
        city=?,
        image=?,
        description=?,
        missions=?,
        skill=?,
        candidate_profile=?,
        cv=?,
        motivation=?,
        validated=?,
        deleted=?,
        expired=?,
        compagny=?,
        deadline=?
        WHERE id=?

        ");

    $id=$offer->getId();
    $id_domain=$offer->getId_domain();
    $profession=$offer->getProfession();
    $city=$offer->getCity();
    $image=$offer->getImage();
    $description=$offer->getDescription();
    $missions=$offer->getMissions();
    $skill=$offer->getSkill();
    $candidate_profile=$offer->getCandidate_profile();
    $cv=$offer->getCv();
    $motivation=$offer->getMotivation();
    $validated=$offer->getValidated();
    $deleted=$offer->getDeleted();
    $expired=$offer->getExpired();
    $deadline=$offer->getDeadline();

    $query->bindParam(1,$id_domain);
    $query->bindParam(2,$profession);
    $query->bindParam(3,$city);
    $query->bindParam(4,$image);
    $query->bindParam(5,$description);
    $query->bindParam(6,$missions);
    $query->bindParam(7,$skill);
    $query->bindParam(8,$candidate_profile);
    $query->bindParam(9,$cv);
    $query->bindParam(10,$motivation);
    $query->bindParam(11,$validated);
    $query->bindParam(12,$deleted);
    $query->bindParam(13,$expired);
    $query->bindParam(14,$compagny);
    $query->bindParam(15,$deadline);
    $query->bindParam(16,$id);

    if($query->execute()){

        return true;

    }else{
        return false;
    }
}




}

?>