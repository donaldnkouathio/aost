<?php

include($_SERVER["DOCUMENT_ROOT"]."/aost/bd/server-connect.php");


class Offer
{

    /*PROPRIETES*/
    private $_id;
    private $_id_compagny;
    private $_id_user;
    private $_id_domain;
    private $_id_offer;
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


    public function setId_compagny($id_compagny){
        if(is_int($id_compagny)){
            $this->_id_compagny=$id_compagny;
        }
    }
    
    public function getId_compagny(){
        return $this->_id_compagny;
    }

    
    public function setId_user($id_user){
        if(is_int($id_user)){
            $this->_id_user=$id_user;
        }
    }
    
    public function getId_user(){
        return $this->_id_user;
    }

    
    public function setId_domain($id_domain){
        if(is_int($id_domain)){
            $this->_id_domain=$id_domain;
        }
    }
    
    public function getId_domain(){
        return $this->_id_domain;
    }

    
    public function setId_offer($id_offer){
        if(is_int($id_offer)){
            $this->_id_offer=$id_offer;
        }
    }
    
    public function getId_offer(){
        return $this->_id_offer;
    }

    
    public function setProfession($profession){
        if(is_string($profession)){
            $this->_profession=$profession;
        }
    }
    
    public function getProfession(){
        return $this->_profession;
    }

    
    public function setCity($city){
        if(is_string($city)){
            $this->_city=$city;
        }
    }
    
    public function getCity(){
        return $this->_city;
    }

    
    public function setImage($image){
        if(is_string($image)){
            $this->_image=$image;
        }
    }
    
    public function getImage(){
        return $this->_image;
    }

    
    public function setDescription($description){
        if(is_string($description)){
            $this->_description=$description;
        }
    }
    
    public function getDescription(){
        return $this->_description;
    }

    
    public function setMissions($missions){
        if(is_string($missions)){
            $this->_missions=$missions;
        }
    }
    
    public function getMissions(){
        return $this->_missions;
    }

    
    public function setSkill($skill){
        if(is_string($skill)){
            $this->_skill=$skill;
        }
    }
    
    public function getSkill(){
        return $this->_skill;
    }

    
    public function setCandidate_profile($candidate_profile){
        if(is_string($candidate_profile)){
            $this->_candidate_profile=$candidate_profile;
        }
    }
    
    public function getCandidate_profile(){
        return $this->_candidate_profile;
    }

    
    public function setCv($cv){
        if(is_int($cv)){
            $this->_cv=$cv;
        }
    }
    
    public function getCv(){
        return $this->_cv;
    }

    
    public function setMotivation($motivation){
        if(is_int($motivation)){
            $this->_motivation=$motivation;
        }
    }
    
    public function getMotivation(){
        return $this->_motivation;
    }

    
    public function setValidated($validated){
        if(is_int($validated)){
            $this->_validated=$validated;
        }
    }
    
    public function getValidated(){
        return $this->_validated;
    }

    
    public function setDeleted($deleted){
        if(is_int($deleted)){
            $this->_deleted=$deleted;
        }
    }
    
    public function getDeleted(){
        return $this->_deleted;
    }

    
    public function setExpired($expired){
        if(is_int($expired)){
            $this->_expired=$expired;
        }
    }
    
    public function getExpired(){
        return $this->_expired;
    }

    
    public function setDeadline($deadline){
        if(is_string($deadline)){
            $this->_deadline=$deadline;
        }
    }
    
    public function getDeadline(){
        return $this->_deadline;
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

    public function addOffer(Offer $offer){
        include(_APP_PATH."bd/server-connect.php");
        
        $query=$db->prepare("INSERT INTO offers VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $id=0;
        $id_compagny=$offer->getId_compagny();
        $id_user=$offer->getId_user();
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
        $added_at=$offer->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$id_compagny);
        $query->bindParam(3,$id_user);
        $query->bindParam(4,$id_domain);
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
        
    if(is_int($id_offer)){
        $req=$db->prepare("DELETE FROM offers WHERE id=?");

        $req->bindParam(1,$id_offer);

        if($req->execute()){
            return true;
        }else{
            return false;
        }
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
        
    if(is_int($id)){
        $query=$db->prepare("SELECT * FROM offers WHERE id=?");
        $query->bindParam(1,$id);
        if($query->execute() && $query->rowCount()==1){
            $data=$query->fetch();
            return (new Offer($data));   
        }else{
            return false;
        }
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
        
    if(is_int($start)){
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
    $query->bindParam(14,$deadline);
    $query->bindParam(15,$id);

    if($query->execute()){

        return true;

    }else{
        return false;
    }
}




}

?>