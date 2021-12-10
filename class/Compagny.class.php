 <?php

 class Compagny
 {

    /*PROPRIETES*/
    private $_id;
    private $_id_user;
    private $_name;
    private $_country;
    private $_city;
    private $_address;
    private $_main_domain;
    private $_other_domain;
    private $_added_at;

    /*CONSTRUCTEUR*/
    private function __construct(array $data){

        $this->_db=new pdo('mysql:host=localhost;dbname=bd_aost','root','');

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


    public function setId_user($id_user){
        if(is_int($id_user)){
            $this->_id=$id_user;
        }
    }
    
    public function getId_user(){
        return $this->_id_user;
    }

    
    public function setName($name){
        if(is_string($name)){
            $this->_id=$name;
        }
    }
    
    public function getName(){
        return $this->_name;
    }

    
    public function setCountry($country){
        if(is_string($country)){
            $this->_id=$country;
        }
    }
    
    public function getCountry(){
        return $this->_country;
    }

    
    public function setCity($city){
        if(is_int($city)){
            $this->_id=$city;
        }
    }
    
    public function getCity(){
        return $this->_city;
    }

    
    public function setAddress($address){
        if(is_string($address)){
            $this->_id=$address;
        }
    }
    
    public function getAddress(){
        return $this->_address;
    }

    
    public function setMain_domain($main_domain){
        if(is_string($main_domain)){
            $this->_id=$main_domain;
        }
    }
    
    public function getMain_domain(){
        return $this->_main_domain;
    }

    
    public function setOther_domain($other_domain){
        if(is_string($other_domain)){
            $this->_id=$other_domain;
        }
    }
    
    public function getOther_domain(){
        return $this->_other_domain;
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

    public function getLastCompagny(){
        $query=$this->_db->prepare("SELECT * FROM compagny WHERE id=(SELECT MAX(id) FROM compagny)");
        if($query->execute() && $query->rowCount()==1){
            $data=$query->fetch();
            return (new Compagny($data)); 
        }else{
            return false;
        }
    }




    public function getCompagny($id){
        if(is_int($id)){
            $query=$this->_db->prepare("SELECT * FROM compagny WHERE id=?");
            $query->bindParam(1,$id);
            if($query->execute() && $query->rowCount()==1){
                $data=$query->fetch();
                return (new Compagny($data));   
            }else{
                return false;
            }
        }else{
            return false;
        }

    }




    public function getCompagny() {

        $query=$this->_db->prepare("SELECT * FROM compagny ORDER BY id ASC");

        $compagny=[];

        if($query->execute()){
            while($data=$query->fetch()){
                $compagny[]=new Compagny($data);
            }
            return $compagny;
        }else{
            return false;
        }
    }







    public function editCompagny(Compagny $compagny) {
        $query=$compagny->_db->prepare("UPDATE compagny
            SET name=?,
            country=?,
            city=?,
            address=?,
            main_domain=?,
            other_domain=?
            WHERE id=?

            ");

        $id=$compagny->getId();
        $name=$compagny->getName();
        $country=$compagny->getCountry();
        $city=$compagny->getCity();
        $address=$compagny->getAddress();
        $main_domain=$compagny->getMain_domain();
        $other_domain=$compagny->getOther_domain();
        
        $query->bindParam(1,$name);
        $query->bindParam(2,$country);
        $query->bindParam(3,$city);
        $query->bindParam(4,$address);
        $query->bindParam(5,$main_domain);
        $query->bindParam(6,$other_domain);
        $query->bindParam(7,$id);

        if($query->execute()){

            return true;

        }else{
            return false;
        }
    }




}

?>