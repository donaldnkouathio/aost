<?php

include($_SERVER["DOCUMENT_ROOT"]."/aost/bd/server-connect.php");


class Customer
{

    /*PROPRIETES*/
    private $_id;
    private $_id_user;
    private $_name;
    private $_phone_1;
    private $_phone_2;
    private $_first_name;
    private $_date_birth;
    private $_country;
    private $_city;
    private $_address;
    private $_sex;
    private $_about;
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


    public function setId_user($id_user){
        $this->_id_user=intval($id_user);
    }
    
    public function getId_user(){
        return $this->_id_user;
    }

    
    public function setName($name){
        if(is_string($name)){
            $this->_name=$name;
        }
    }
    
    public function getName(){
        return $this->_name;
    }

    
    public function setPhone_1($phone_1){
        $this->_phone_1=htmlentities(strval($phone_1));
    }
    
    public function getPhone_1(){
        return $this->_phone_1;
    }

    
    public function setPhone_2($phone_2){
        $this->_phone_2=htmlentities(strval($phone_2));
    }
    
    public function getPhone_2(){
        return $this->_phone_2;
    }

    
    public function setFirst_name($first_name){
        $this->_first_name=htmlentities(strval($first_name));
    }
    
    public function getFirst_name(){
        return $this->_first_name;
    }

    
    public function setDate_birth($date_birth){
        $this->_date_birth=htmlentities(strval($date_birth));
    }
    
    public function getDate_birth(){
        return $this->_date_birth;
    }

    
    public function setCountry($country){
        $this->_country=htmlentities(strval($country));
    }
    
    public function getCountry(){
        return $this->_country;
    }

    
    public function setCity($city){
        $this->_city=htmlentities(strval($city));
    }
    
    public function getCity(){
        return $this->_city;
    }

    
    public function setAddress($address){
        $this->_address=htmlentities(strval($address));
    }
    
    public function getAddress(){
        return $this->_address;
    }

    
    public function setSex($sex){
        $this->_sex=htmlentities(strval($sex));
    }
    
    public function getSex(){
        return $this->_sex;
    }

    
    public function setAbout($about){
        $this->_about=htmlentities(strval($about));
    }
    
    public function getAbout(){
        return $this->_about;
    }

    
    public function setAdded_at($added_at){
        $this->_added_at=htmlentities(strval($added_at));
    }
    
    public function getAdded_at(){
        return $this->_added_at;
    }













    /*METHODES FONCTIONNELLES*/



    public function addCustomer(Customer $customer){
        include(_APP_PATH."bd/server-connect.php");
        
        $query=$db->prepare("INSERT INTO customers VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $id=0;
        $id_user=$customer->getId_user();
        $name=$customer->getName();
        $phone_1=$customer->getPhone_1();
        $phone_2=$customer->getPhone_2();
        $first_name=$customer->getFirst_name();
        $date_birth=$customer->getDate_birth();
        $country=$customer->getCountry();
        $city=$customer->getCity();
        $address=$customer->getAddress();
        $sex=$customer->getSex();
        $about=$customer->getAbout();
        $added_at=$customer->getAdded_at();

        $query->bindParam(1,$id);
        $query->bindParam(2,$id_user);
        $query->bindParam(3,$name);
        $query->bindParam(4,$phone_1);
        $query->bindParam(5,$phone_2);
        $query->bindParam(6,$first_name);
        $query->bindParam(7,$date_birth);
        $query->bindParam(8,$country);
        $query->bindParam(9,$city);
        $query->bindParam(10,$address);
        $query->bindParam(11,$sex);
        $query->bindParam(12,$about);
        $query->bindParam(13,$added_at);


        if($query->execute()){
          return true;
      }else{
          return false;
      }
  }







  public function removeCustomer($id_user){
    include(_APP_PATH."bd/server-connect.php");
    
    $id_user=intval($id_user);
    $req=$db->prepare("DELETE FROM customers WHERE id=?");

    $req->bindParam(1,$id_user);

    if($req->execute()){
        return true;
    }else{
        return false;
    }
    
}



public function getLastCustomer(){
    include(_APP_PATH."bd/server-connect.php");
    
    $query=$db->prepare("SELECT * FROM customers WHERE id=(SELECT MAX(id) FROM customers)");
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Customer($data)); 
    }else{
        return false;
    }
}




public function getCustomer($id){
    include(_APP_PATH."bd/server-connect.php");
    
    $id=intval($id);
    $query=$db->prepare("SELECT * FROM customers WHERE id=?");
    $query->bindParam(1,$id);
    if($query->execute() && $query->rowCount()==1){
        $data=$query->fetch();
        return (new Customer($data));   
    }else{
        return false;
    }

}




public function getCustomers() {
    include(_APP_PATH."bd/server-connect.php");
    

    $query=$db->prepare("SELECT * FROM customers ORDER BY id ASC");

    $customers=[];

    if($query->execute()){
        while($data=$query->fetch()){
            $customers[]=new Customer($data);
        }
        return $customers;
    }else{
        return false;
    }
}







public function editcustomer(Customer $customer) {
    include(_APP_PATH."bd/server-connect.php");
    
    $query=$db->prepare("UPDATE customers
        SET name=?,
        phone_1=?,
        phone_2=?,
        first_name=?,
        date_birth=?,
        country=?,
        city=?,
        address=?,
        sex=?,
        about=?
        WHERE id=?

        ");

    $id=$customer->getId();
    $name=$customer->getName();
    $phone_1=$customer->getPhone_1();
    $phone_2=$customer->getPhone_2();
    $first_name=$customer->getFirst_name();
    $date_birth=$customer->getDate_birth();
    $country=$customer->getCountry();
    $city=$customer->getCity();
    $address=$customer->getAddress();
    $sex=$customer->getSex();
    $about=$customer->getAbout();

    $query->bindParam(1,$id_user);
    $query->bindParam(2,$name);
    $query->bindParam(3,$phone_1);
    $query->bindParam(4,$phone_2);
    $query->bindParam(5,$first_name);
    $query->bindParam(6,$date_birth);
    $query->bindParam(7,$country);
    $query->bindParam(8,$city);
    $query->bindParam(9,$address);
    $query->bindParam(10,$sex);
    $query->bindParam(11,$about);
    $query->bindParam(12,$id);

    if($query->execute()){

        return true;

    }else{
        return false;
    }
}




}

?>