  <?php

  class Subdomain
  {

  	/*PROPRIETES*/
  	private $_id;
  	private $_id_domain;
  	private $_name;
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


  	public function setId_domain($id_domain){
  		if(is_int($id_domain)){
  			$this->_id=$id_domain;
  		}
  	}
  	
  	public function getId_domain(){
  		return $this->_id_domain;
  	}

  	
  	public function setName($name){
  		if(is_string($name)){
  			$this->_id=$name;
  		}
  	}
  	
  	public function getName(){
  		return $this->_name;
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

    public function addSubdomain(Subdomain $subdomain){
        $query=$subdomain->_db->prepare("INSERT INTO subdomains VALUES (?,?,?,?)");

        $id=0;
        $id_domain=$subdomain->getId_domain();
        $name=$subdomain->getName();
        $added_at=$subdomain->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$id_domain);
        $query->bindParam(3,$name);
        $query->bindParam(4,$added_at);


        if($query->execute()){
          return true;
      }else{
          return false;
      }
  }







  public function removeSubdomain($id_subdomain){
    if(is_int($id_subdomain)){
        $req=$this->_db->prepare("DELETE FROM subdomains WHERE id=?");

        $req->bindParam(1,$id_subdomain);

        if($req->execute()){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
    
}




public function getLastSubdomain(){
    $query=$this->_db->prepare("SELECT * FROM subdomains WHERE id=(SELECT MAX(id) FROM subdomain)");
    if($query->execute() && $query->rowCount()==1){
       $data=$query->fetch();
       return (new subdomain($data)); 
   }else{
       return false;
   }
}




public function getSubdomain($id){
    if(is_int($id)){
     $query=$this->_db->prepare("SELECT * FROM subdomains WHERE id=?");
     $query->bindParam(1,$id);
     if($query->execute() && $query->rowCount()==1){
      $data=$query->fetch();
      return (new Subdomain($data));   
  }else{
      return false;
  }
}else{
   return false;
}

}




public function getSubdomain() {

    $query=$this->_db->prepare("SELECT * FROM subdomains ORDER BY id ASC");

    $subdomain=[];

    if($query->execute()){
       while($data=$query->fetch()){
          $subdomain[]=new Subdomain($data);
      }
      return $subdomain;
  }else{
   return false;
}
}







public function editSubdomain(Subdomain $subdomain) {
    $query=$subdomain->_db->prepare("UPDATE subdomains
       SET name=?
       WHERE id=?

       ");

    $id=$subdomain->getId();
    $name=$subdomain->getName();

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