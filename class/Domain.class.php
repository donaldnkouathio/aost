  <?php

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


    public function setId_admin($id_admin){
        if(is_int($id_admin)){
            $this->_id=$id_admin;
        }
    }
    
    public function getId_admin(){
        return $this->_id_admin;
    }

    
    public function setName($name){
        if(is_string($name)){
            $this->_id=$name;
        }
    }
    
    public function getName(){
        return $this->_name;
    }

    
    public function setColor($color){
        if(is_string($color)){
            $this->_id=$color;
        }
    }
    
    public function getColor(){
        return $this->_color;
    }

    
    public function setImage($image){
        if(is_string($image)){
            $this->_id=$image;
        }
    }
    
    public function getImage(){
        return $this->_image;
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

    public function addDomain(Domain $domain){
        $query=$domain->_db->prepare("INSERT INTO domains VALUES (?,?,?,?,?,?)");

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
    if(is_int($id_domain)){
        $req=$this->_db->prepare("DELETE FROM domains WHERE id=?");

        $req->bindParam(1,$id_domain);

        if($req->execute()){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
    
}


public function getLastDomain(){
    $query=$this->_db->prepare("SELECT * FROM domains WHERE id=(SELECT MAX(id) FROM domain)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Domain($data)); 
    }else{
        return false;
    }
}




public function getDomain($id){
    if(is_int($id)){
        $query=$this->_db->prepare("SELECT * FROM domains WHERE id=?");
        $query->bindParam(1,$id);
        if($query->execute() && $query->rowCount()==1){
            $data=$query->fetch();
            return (new Domain($data));   
        }else{
            return false;
        }
    }else{
        return false;
    }

}




public function getDomain() {

    $query=$this->_db->prepare("SELECT * FROM domains ORDER BY id ASC");

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
    $query=$domain->_db->prepare("UPDATE domains
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