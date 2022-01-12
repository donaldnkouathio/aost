<?php


class Notification
{

    /*PROPRIETES*/
    private $_id;
    private $_id_target;
    private $_type;
    private $_viewed;
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


    public function setId_target($id_target){
        $this->_id_target=intval($id_target);
    }

      public function getId_target(){
        return $this->_id_target;
    }


    public function setType($type){
        $this->_type=htmlentities(strval($type));
    }

    public function getType(){
        return $this->_type;
    }


    public function setViewed($viewed){
        $this->_viewed=intval($viewed);
    }

    public function getViewed(){
        return $this->_viewed;
    }



    public function setAdded_at($added_at){
        $this->_added_at=strval($added_at);
    }

    public function getAdded_at(){
        return $this->_added_at;
    }













    /*METHODES FONCTIONNELLES*/




    public function addNotification(Notification $notification){
        include(_APP_PATH."bd/server-connect.php");

        $query=$db->prepare("INSERT INTO notifications VALUES (?,?,?,?,?)");

        $id=0;
        $id_target=$notification->getId_target();
        $type=$notification->getType();
        $viewed=$notification->getViewed();
        $added_at=$notification->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$id_target);
        $query->bindParam(3,$type);
        $query->bindParam(4,$viewed);
        $query->bindParam(5,$added_at);


        if($query->execute()){
          return true;
      }else{
          return false;
      }
  }






  public function removeNotification($id_notification){
    include(_APP_PATH."bd/server-connect.php");

    $id_notification=intval($id_notification);
    $query=$db->prepare("DELETE FROM notifications WHERE id=?");

    $query->bindParam(1,$id_notification);

    if($query->execute()){
        return true;
    }else{
        return false;
    }

}






public function clearNotifications(){
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("DELETE FROM notifications");

    if($query->execute()){
        return true;
    }else{
        return false;
    }
}




public function clearNotificationsByType($type){
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("DELETE FROM notifications WHERE type=?");
    $query->bindParam(1,$type);

    if($query->execute()){
        return true;
    }else{
        return false;
    }
}




public function setNotificationViewed($id){
    include(_APP_PATH."bd/server-connect.php");

    $viewed=1;

    $query=$db->prepare("UPDATE notifications SET viewed=? WHERE id=?");

    $query->bindParam(1,$viewed);
    $query->bindParam(2,$id);

    if($query->execute()){
        return true;
    }else{
        return false;
    }
}



public function setAllNotificationsViewed(){
    include(_APP_PATH."bd/server-connect.php");

    $viewed=1;

    $query=$db->prepare("UPDATE notifications SET viewed=?");
    $query->bindParam(1,$viewed);

    if($query->execute()){
        return true;
    }else{
        return false;
    }
}




public function getLastNotification(){
    include(_APP_PATH."bd/server-connect.php");

    $query=$db->prepare("SELECT * FROM notifications WHERE id=(SELECT MAX(id) FROM notifications)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Notification($data));
    }else{
        return false;
    }
}




public function getNotification($id){
    include(_APP_PATH."bd/server-connect.php");

    $id=intval($id);
    $query=$db->prepare("SELECT * FROM notifications WHERE id=?");
    $query->bindParam(1,$id);
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Notification($data));
    }else{
        return false;
    }

}



public function getNotificationByTarget($type, $id_target){
  include(_APP_PATH."bd/server-connect.php");

  $type= strval($type);
  $id_target= intval($id_target);

  $query=$db->prepare("SELECT * FROM notifications WHERE id_target=? AND type=?");
  $query->bindParam(1,$id_target);
  $query->bindParam(2,$type);

  if($query->execute() && $query->rowCount()==1){
      $data=$query->fetch();
      return true;
  }else{
      return false;
  }

}




public function getNotifications() {
    include(_APP_PATH."bd/server-connect.php");


    $query=$db->prepare("SELECT * FROM notifications ORDER BY id DESC");

    $notification=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $notification[]=new Notification($data);
        }
        return $notification;
    }else{
        return false;
    }
}



public function getNotificationsByType($type) {
    include(_APP_PATH."bd/server-connect.php");


    $query=$db->prepare("SELECT * FROM notifications WHERE type=? ORDER BY id DESC");
    $query->bindParam(1,$type);

    $notification=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $notification[]=new Notification($data);
        }
        return $notification;
    }else{
        return false;
    }
}


public function countNewNotifications($type) {
    include(_APP_PATH."bd/server-connect.php");


    $query=$db->prepare("SELECT * FROM notifications WHERE type=? ORDER BY id DESC");

    $query->bindParam(1,$type);

    $notification=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $notification[]=new Notification($data);
        }
        return $notification;
    }else{
        return false;
    }
}




}

?>
