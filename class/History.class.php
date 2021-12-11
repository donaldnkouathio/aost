 <?php


 include("../bd/server-connect.php");

 
 class History
 {

    /*PROPRIETES*/
    private $_id;
    private $_id_admin;
    private $_id_target;
    private $_action;
    private $_description;
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


    public function setId_admin($id_admin){
        if(is_int($id_admin)){
            $this->_id=$id_admin;
        }
    }
    
    public function getId_admin(){
        return $this->_id_admin;
    }

    
    public function setId_target($id_target){
        if(is_int($id_target)){
            $this->_id=$id_target;
        }
    }
    
    public function getId_target(){
        return $this->_id_target;
    }

    
    public function setAction($action){
        if(is_string($action)){
            $this->_id=$action;
        }
    }
    
    public function getAction(){
        return $this->_action;
    }

    
    public function setDescription($description){
        if(is_string($description)){
            $this->_id=$description;
        }
    }
    
    public function getDescription(){
        return $this->_description;
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


    public function addHistory(History $history){
        $query=$db->prepare("INSERT INTO history VALUES (?,?,?,?,?,?)");

        $id=0;
        $id_admin=$history->getId_admin();
        $id_target=$history->getId_target();
        $action=$history->getAction();
        $description=$history->getDescription();
        $added_at=$history->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$id_admin);
        $query->bindParam(3,$id_target);
        $query->bindParam(4,$action);
        $query->bindParam(5,$action);
        $query->bindParam(6,$added_at);


        if($query->execute()){
          return true;
      }else{
          return false;
      }
  }




  public function removeHistory($id_history){
    if(is_int($id_history)){
        $req=$db->prepare("DELETE FROM history WHERE id=?");

        $req->bindParam(1,$id_history);

        if($req->execute()){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
    
}



public function getLastHistory(){
    $query=$db->prepare("SELECT * FROM history WHERE id=(SELECT MAX(id) FROM history)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new History($data)); 
    }else{
        return false;
    }
}




public function getHistory($id){
    if(is_int($id)){
        $query=$db->prepare("SELECT * FROM history WHERE id=?");
        $query->bindParam(1,$id);
        if($query->execute() && $query->rowCount()==1){
            $data=$query->fetch();
            return (new History($data));   
        }else{
            return false;
        }
    }else{
        return false;
    }

}




public function getHistory() {

    $query=$db->prepare("SELECT * FROM history ORDER BY id ASC");

    $history=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $history[]=new History($data);
        }
        return $history;
    }else{
        return false;
    }
}




}

?>