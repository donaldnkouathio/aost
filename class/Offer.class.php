<?php


class Offer
{

    /*PROPRIETES*/
    private $_id;
    private $_id_admin;
    private $_id_subdomain;
    private $_id_city;
    private $_compagny;
    private $_description;
    private $_missions;
    private $_skill;
    private $_candidate_profile;
    private $_cv;
    private $_motivation;
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
        $this->_compagny=strval($compagny);
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


    public function setId_subdomain($id_subdomain){
        $this->_id_subdomain=intval($id_subdomain);
    }

    public function getId_subdomain(){
        return $this->_id_subdomain;
    }


    public function setId_city($id_city){
        $this->_id_city=intval($id_city);
    }

    public function getId_city(){
        return $this->_id_city;
    }

    public function setDescription($description){
        $this->_description=strval($description);
    }

    public function getDescription(){
        return $this->_description;
    }


    public function setMissions($missions){
        $this->_missions=strval($missions);
    }

    public function getMissions(){
        return $this->_missions;
    }


    public function setSkill($skill){
        $this->_skill=strval($skill);
    }

    public function getSkill(){
        return $this->_skill;
    }


    public function setCandidate_profile($candidate_profile){
        $this->_candidate_profile=strval($candidate_profile);
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
        $this->_deadline=strval($deadline);
    }

    public function getDeadline(){
        return $this->_deadline;
    }


    public function setAdded_at($added_at){
        $this->_added_at=strval($added_at);
    }

    public function getAdded_at(){
        return $this->_added_at;
    }













    /*METHODES FONCTIONNELLES*/

    public function addOffer(Offer $offer){
        include(_APP_PATH."bd/server-connect.php");

        $query=$db->prepare("INSERT INTO offers VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $id=0;
        $id_admin=$offer->getId_admin();
        $id_subdomain=$offer->getId_subdomain();
        $id_city=$offer->getId_city();
        $compagny=$offer->getCompagny();
        $description=$offer->getDescription();
        $missions=$offer->getMissions();
        $skill=$offer->getSkill();
        $candidate_profile=$offer->getCandidate_profile();
        $cv=$offer->getCv();
        $motivation=$offer->getMotivation();
        $deleted=$offer->getDeleted();
        $expired=$offer->getExpired();
        $deadline=$offer->getDeadline();
        $added_at=$offer->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$id_admin);
        $query->bindParam(3,$id_subdomain);
        $query->bindParam(4,$id_city);
        $query->bindParam(5,$compagny);
        $query->bindParam(6,$description);
        $query->bindParam(7,$missions);
        $query->bindParam(8,$skill);
        $query->bindParam(9,$candidate_profile);
        $query->bindParam(10,$cv);
        $query->bindParam(11,$motivation);
        $query->bindParam(12,$deleted);
        $query->bindParam(13,$expired);
        $query->bindParam(14,$deadline);
        $query->bindParam(15,$added_at);

        if($query->execute()){
          return true;
      }else{
          return "false";
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


    $query=$db->prepare("SELECT * FROM offers WHERE expired=0 ORDER BY id ASC");

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




public function getOffersFromLast($limit) {
    include(_APP_PATH."bd/server-connect.php");


    $query=$db->prepare("SELECT * FROM offers WHERE expired=0 ORDER BY id DESC LIMIT $limit");

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
    $query=$db->prepare("SELECT * FROM offers WHERE expired=0 ORDER BY id DESC LIMIT $start,$end");

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



//Pour les différents filtres
public function getOffersFilterLimit($keyword, $id_domain, $date, $start){
  include(_APP_PATH."bd/server-connect.php");

  $id_domain = intval($id_domain);

  $start=intval($start);
  $end=$start+10;

  $regex = $keyword == "" ? "" : " subdomains.name REGEXP '^(.*)$keyword(.*)$' ";
  $domainTxt = $id_domain == -1 ? "" : " subdomains.id_domain=$id_domain ";
  $dateDirection = " ORDER BY offers.added_at $date ";
  $limit = " LIMIT $start,$end ";

  if($domainTxt == "" && $regex == ""){
    $where_1 = " 1 ";
}else {
    $where_1 = "";
}

$query= $db->prepare("SELECT * FROM subdomains INNER JOIN offers ON offers.id_subdomain = subdomains.id WHERE $regex $domainTxt $where_1 $dateDirection $limit");

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
/* *** */


public function setOffersExpired() {
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("UPDATE offers SET expired=? WHERE deadline<NOW()");

    $expired=1;

    $query->bindParam(1,$expired);

    if($query->execute()){

        return true;

    }else{
        return false;
    }
}


public function editOffer(Offer $offer) {
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("UPDATE offers
        SET id_subdomain=?,
        id_city=?,
        description=?,
        missions=?,
        skill=?,
        candidate_profile=?,
        cv=?,
        motivation=?,
        deleted=?,
        expired=?,
        compagny=?,
        deadline=?
        WHERE id=?

        ");

    $id=$offer->getId();
    $id_subdomain=$offer->getId_subdomain();
    $id_city=$offer->getId_city();
    $compagny=$offer->getCompagny();
    $description=$offer->getDescription();
    $missions=$offer->getMissions();
    $skill=$offer->getSkill();
    $candidate_profile=$offer->getCandidate_profile();
    $cv=$offer->getCv();
    $motivation=$offer->getMotivation();
    $deleted=$offer->getDeleted();
    $expired=$offer->getExpired();
    $deadline=$offer->getDeadline();

    $query->bindParam(1,$id_subdomain);
    $query->bindParam(2,$id_city);
    $query->bindParam(3,$description);
    $query->bindParam(4,$missions);
    $query->bindParam(5,$skill);
    $query->bindParam(6,$candidate_profile);
    $query->bindParam(7,$cv);
    $query->bindParam(8,$motivation);
    $query->bindParam(9,$deleted);
    $query->bindParam(10,$expired);
    $query->bindParam(11,$compagny);
    $query->bindParam(12,$deadline);
    $query->bindParam(13,$id);

    if($query->execute()){

        return true;

    }else{
        return false;
    }
}




}

?>
