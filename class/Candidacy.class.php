<?php


class Candidacy
{

    /*PROPRIETES*/
    private $_id;
    private $_id_offer;
    private $_id_subdomain;
    private $_city;
    private $_name;
    private $_first_name;
    private $_phone;
    private $_email;
    private $_domains;
    private $_about;
    private $_cv_file;
    private $_motivation_file;
    private $_alert;
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


    public function setId_offer($id_offer){
        $this->_id_offer=$id_offer;
    }

    public function getId_offer(){
        return $this->_id_offer;
    }


    public function setId_subdomain($id_subdomain){
        $this->_id_subdomain=$id_subdomain;
    }

    public function getId_subdomain(){
        return $this->_id_subdomain;
    }


    public function setCity($city){
        $this->_city=htmlentities(strval($city));
    }

    public function getCity(){
        return $this->_city;
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


    public function setEmail($email){
        $this->_email=htmlentities(strval($email));
    }

    public function getEmail(){
        return $this->_email;
    }


    public function setDomains($domains){
        $this->_domains=htmlentities(strval($domains));
    }

    public function getDomains(){
        return $this->_domains;
    }


    public function setAbout($about){
        $this->_about=htmlentities(strval($about));
    }

    public function getAbout(){
        return $this->_about;
    }


    public function setCv_file($cv_file){
        $this->_cv_file=strval($cv_file);
    }

    public function getCv_file(){
        return $this->_cv_file;
    }


    public function setMotivation_file($motivation_file){
        $this->_motivation_file=strval($motivation_file);
    }

    public function getMotivation_file(){
        return $this->_motivation_file;
    }


    public function setDeleted($deleted){
        $this->_deleted=intval($deleted);
    }

    public function getDeleted(){
        return $this->_deleted;
    }


    public function setAlert($alert){
        $this->_alert=intval($alert);
    }

    public function getAlert(){
        return $this->_alert;
    }



    public function setAdded_at($added_at){
        $this->_added_at=htmlentities(strval($added_at));
    }

    public function getAdded_at(){
        return $this->_added_at;
    }













    /*METHODES FONCTIONNELLES*/



    public function addCandidacy(Candidacy $candidacy){
        include(_APP_PATH."bd/server-connect.php");

        $query=$db->prepare("INSERT INTO candidacy VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $id=0;
        $id_offer=$candidacy->getId_offer();
        $id_subdomain=$candidacy->getId_subdomain();
        $city=$candidacy->getCity();
        $name=$candidacy->getName();
        $first_name=$candidacy->getFirst_name();
        $phone=$candidacy->getPhone();
        $email=$candidacy->getEmail();
        $domains=$candidacy->getDomains();
        $about=$candidacy->getAbout();
        $cv_file=$candidacy->getCv_file();
        $motivation_file=$candidacy->getMotivation_file();
        $alert=$candidacy->getAlert();
        $deleted=$candidacy->getDeleted();
        $added_at=$candidacy->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$id_offer);
        $query->bindParam(3,$id_subdomain);
        $query->bindParam(4,$city);
        $query->bindParam(5,$name);
        $query->bindParam(6,$first_name);
        $query->bindParam(7,$phone);
        $query->bindParam(8,$email);
        $query->bindParam(9,$domains);
        $query->bindParam(10,$about);
        $query->bindParam(11,$cv_file);
        $query->bindParam(12,$motivation_file);
        $query->bindParam(13,$alert);
        $query->bindParam(14,$deleted);
        $query->bindParam(15,$added_at);


        if($query->execute()){
          return true;
      }else{
          return false;
      }
  }







  public function removeCandidacy($id_offer){
    include(_APP_PATH."bd/server-connect.php");

    $id_offer=intval($id_offer);
    $req=$db->prepare("DELETE FROM candidacy WHERE id=?");

    $req->bindParam(1,$id_offer);

    if($req->execute()){
        return true;
    }else{
        return false;
    }


}





public function deleteCandidacyAlert($email,$subdomain){
    include(_APP_PATH."bd/server-connect.php");

    $alert=1;

    $subdomains=$db->prepare("SELECT domains FROM candidacy WHERE email=? AND alert=?");
    $subdomains->bindParam(1,$email);
    $subdomains->bindParam(2,$alert);
    $subdomains->execute();

    $subdomains=$subdomains->fetch();
    $subdomains=trim($subdomains['domains'], $subdomain);


    $req=$db->prepare("UPDATE candidacy SET domains=? WHERE email=? AND alert=?");
    $req->bindParam(1,$subdomains);
    $req->bindParam(2,$email);
    $req->bindParam(3,$alert);

    if($req->execute()){
        return true;
    }else{
        return false;
    }


}

public function deleteCandidacyAlerts($email){
    include(_APP_PATH."bd/server-connect.php");

    $alert=1;

    $req=$db->prepare("DELETE FROM candidacy WHERE email=? AND alert=?");

    $req->bindParam(1,$alert);

    if($req->execute()){
        return true;
    }else{
        return false;
    }


}




public function getLastCandidacy(){
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("SELECT * FROM candidacy WHERE id=(SELECT MAX(id) FROM candidacy)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Candidacy($data));
    }else{
        return false;
    }
}




public function getCandidacy($id){
    include(_APP_PATH."bd/server-connect.php");

    $id=intval($id);
    $query=$db->prepare("SELECT * FROM candidacy WHERE id=?");
    $query->bindParam(1,$id);
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Candidacy($data));
    }else{
        return false;
    }

}




public function getCandidacys() {
    include(_APP_PATH."bd/server-connect.php");


    $query=$db->prepare("SELECT * FROM candidacy WHERE ISNULL(id_offer) = false ORDER BY id DESC");

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




public function getPromptCandidacys() {
    include(_APP_PATH."bd/server-connect.php");


    $query=$db->prepare("SELECT * FROM candidacy WHERE ISNULL(id_offer) = true ORDER BY id DESC");

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



public function getAlertsCandidacy($domain) {
    include(_APP_PATH."bd/server-connect.php");


    $query=$db->prepare("SELECT * FROM candidacy WHERE alert=1 AND domains LIKE '%$domain%' GROUP BY email");

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
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("UPDATE candidacy
        SET id_offer=?,
        id_subdomain=?,
        city=?,
        name=?,
        first_name=?,
        phone=?,
        email=?,
        domains=?,
        about=?,
        cv_file=?,
        motivation_file=?,
        deleted=?
        WHERE id=?

        ");

    $id=$candidacy->getId();
    $id_offer=$candidacy->getId_offer();
    $id_subdomain=$candidacy->getId_subdomain();
    $city=$candidacy->getCity();
    $name=$candidacy->getName();
    $first_name=$candidacy->getFirst_name();
    $phone=$candidacy->getPhone();
    $email=$candidacy->getEmail();
    $domains=$candidacy->getDomains();
    $about=$candidacy->getAbout();
    $cv_file=$candidacy->getCv_file();
    $motivation_file=$candidacy->getMotivation_file();
    $deleted=$candidacy->getDeleted();

    $query->bindParam(1,$id_offer);
    $query->bindParam(2,$id_subdomain);
    $query->bindParam(3,$city);
    $query->bindParam(4,$name);
    $query->bindParam(5,$first_name);
    $query->bindParam(6,$phone);
    $query->bindParam(7,$email);
    $query->bindParam(8,$domains);
    $query->bindParam(9,$about);
    $query->bindParam(10,$cv_file);
    $query->bindParam(11,$motivation_file);
    $query->bindParam(12,$deleted);
    $query->bindParam(13,$id);

    if($query->execute()){

        return true;

    }else{
        return false;
    }
}




}

?>
