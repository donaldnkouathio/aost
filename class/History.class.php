<?php


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


    public function setId_admin($id_admin){
        $this->_id_admin=intval($id_admin);
    }

    public function getId_admin(){
        return $this->_id_admin;
    }


    public function setId_target($id_target){
        $this->_id_target=intval($id_target);
    }

    public function getId_target(){
        return $this->_id_target;
    }


    public function setAction($action){
        $this->_action=htmlentities(strval($action));
    }

    public function getAction(){
        return $this->_action;
    }


    public function setDescription($description){
        $this->_description=htmlentities(strval($description));
    }

    public function getDescription(){
        return $this->_description;
    }


    public function setAdded_at($added_at){
        $this->_added_at=htmlentities(strval($added_at));
    }

    public function getAdded_at(){
        return $this->_added_at;
    }













    /*METHODES FONCTIONNELLES*/


    public function addHistory(History $history){
        include(_APP_PATH."bd/server-connect.php");

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
        $query->bindParam(5,$description);
        $query->bindParam(6,$added_at);


        if($query->execute()){
          return true;
      }else{
          return false;
      }
  }




  public function removeHistory($id_history){
    include(_APP_PATH."bd/server-connect.php");

    $id_history=intval($id_history);
    $req=$db->prepare("DELETE FROM history WHERE id=?");

    $req->bindParam(1,$id_history);

    if($req->execute()){
        return true;
    }else{
        return false;
    }

}




public function clearHistory(){
    include(_APP_PATH."bd/server-connect.php");

    $req=$db->prepare("DELETE FROM history");

    if($req->execute()){
        return true;
    }else{
        return false;
    }

}



public function getLastHistory(){
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("SELECT * FROM history WHERE id=(SELECT MAX(id) FROM history)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new History($data));
    }else{
        return false;
    }
}


public function getHistorysPerMonth(){
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("SELECT * FROM history GROUP BY DATE_FORMAT(added_at, '%M-%Y') ORDER BY added_at DESC");

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


public function getHistorysByMonth($month){
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("SELECT * FROM history WHERE added_at LIKE '%$month%'");

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


public function getHistorysByMonthLimit($month, $start){
    include(_APP_PATH."bd/server-connect.php");

    $start=intval($start);
    $end=10;

    $query=$db->prepare("SELECT * FROM history WHERE added_at LIKE '%$month%' ORDER BY added_at DESC LIMIT $start,$end");

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




public function getHistory($id){
    include(_APP_PATH."bd/server-connect.php");

    $id=intval($id);

    $query=$db->prepare("SELECT * FROM history WHERE id=?");
    $query->bindParam(1,$id);
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new History($data));
    }else{
        return false;
    }


}




public function getHistorys() {
    include(_APP_PATH."bd/server-connect.php");


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
