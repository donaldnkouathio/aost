 <?php

 class Offer
 {

    /*PROPRIETES*/
    private $_id;
    private $_id_compagny;
    private $_id_user;
    private $_category;
    private $_profession;
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

        $this->_db=new pdo('mysql:host=localhost;dbid_user=bd_aost','root','');

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
            $this->_id=$id_compagny;
        }
    }
    
    public function getId_compagny(){
        return $this->_id_compagny;
    }

    
    public function setId_user($id_user){
        if(is_int($id_user)){
            $this->_id=$id_user;
        }
    }
    
    public function getId_user(){
        return $this->_id_user;
    }

    
    public function setCategory($category){
        if(is_string($category)){
            $this->_id=$category;
        }
    }
    
    public function getCategory(){
        return $this->_category;
    }

    
    public function setProfession($profession){
        if(is_string($profession)){
            $this->_id=$profession;
        }
    }
    
    public function getProfession(){
        return $this->_profession;
    }

    
    public function setImage($image){
        if(is_string($image)){
            $this->_id=$image;
        }
    }
    
    public function getImage(){
        return $this->_image;
    }

    
    public function setDescription($description){
        if(is_string($description)){
            $this->_id=$description;
        }
    }
    
    public function getDescription(){
        return $this->_description;
    }

    
    public function setMissions($missions){
        if(is_string($missions)){
            $this->_id=$missions;
        }
    }
    
    public function getMissions(){
        return $this->_missions;
    }

    
    public function setSkill($skill){
        if(is_string($skill)){
            $this->_id=$skill;
        }
    }
    
    public function getSkill(){
        return $this->_skill;
    }

    
    public function setCandidate_profile($candidate_profile){
        if(is_string($candidate_profile)){
            $this->_id=$candidate_profile;
        }
    }
    
    public function getCandidate_profile(){
        return $this->_candidate_profile;
    }

    
    public function setCv($cv){
        if(is_int($cv)){
            $this->_id=$cv;
        }
    }
    
    public function getCv(){
        return $this->_cv;
    }

    
    public function setMotivation($motivation){
        if(is_int($motivation)){
            $this->_id=$motivation;
        }
    }
    
    public function getMotivation(){
        return $this->_motivation;
    }

    
    public function setValidated($validated){
        if(is_int($validated)){
            $this->_id=$validated;
        }
    }
    
    public function getValidated(){
        return $this->_validated;
    }

    
    public function setDeleted($deleted){
        if(is_int($deleted)){
            $this->_id=$deleted;
        }
    }
    
    public function getDeleted(){
        return $this->_deleted;
    }

    
    public function setExpired($expired){
        if(is_int($expired)){
            $this->_id=$expired;
        }
    }
    
    public function getExpired(){
        return $this->_expired;
    }

    
    public function setDeadline($deadline){
        if(is_string($deadline)){
            $this->_id=$deadline;
        }
    }
    
    public function getDeadline(){
        return $this->_deadline;
    }

    
    public function setAdded_at($added_at){
        if(is_string($added_at)){
            $this->_id=$added_at;
        }
    }
    
    public function getAdded_at(){
        return $this->_added_at;
    }













    /*METHODES FONCTIONNELLES*/

    public function getLastOffer(){
        $query=$this->_db->prepare("SELECT * FROM offers WHERE id=(SELECT MAX(id) FROM offers)");
        if($query->execute() && $query->rowCount()==1){
            $data=$query->fetch();
            return (new Offer($data)); 
        }else{
            return false;
        }
    }




    public function getOffer($id){
        if(is_int($id)){
            $query=$this->_db->prepare("SELECT * FROM offers WHERE id=?");
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

        $query=$this->_db->prepare("SELECT * FROM offers ORDER BY id ASC");

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
        $query=$offer->_db->prepare("UPDATE offers
            SET category=?,
            profession=?,
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
        $category=$offer->getCategory();
        $profession=$offer->getProfession();
        $image=$offer->getImage();
        $description=$offer->getdescription();
        $missions=$offer->getMissions();
        $skill=$offer->getSkill();
        $candidate_profile=$offer->getCandidate_profile();
        $cv=$offer->getCv();
        $motivation=$offer->getMotivation();
        $validated=$offer->getValidated();
        $deleted=$offer->getDeleted();
        $expired=$offer->getExpired();
        $deadline=$offer->getDeadline();
        
        $query->bindParam(1,$category);
        $query->bindParam(2,$profession);
        $query->bindParam(3,$image);
        $query->bindParam(4,$description);
        $query->bindParam(5,$missions);
        $query->bindParam(6,$skill);
        $query->bindParam(7,$candidate_profile);
        $query->bindParam(8,$cv);
        $query->bindParam(9,$motivation);
        $query->bindParam(10,$validated);
        $query->bindParam(11,$deleted);
        $query->bindParam(12,$expired);
        $query->bindParam(13,$deadline);
        $query->bindParam(14,$id);

        if($query->execute()){

            return true;

        }else{
            return false;
        }
    }




}

?>