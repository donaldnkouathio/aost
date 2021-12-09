 <?php

 class Customer
 {

    /*PROPRIETES*/
    private $_id;
    private $_id_customer;
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


    public function setId_customer($id_customer){
        if(is_int($id_customer)){
            $this->_id=$id_customer;
        }
    }
    
    public function getId_customer(){
        return $this->_id_customer;
    }

    
    public function setName($name){
        if(is_string($name)){
            $this->_id=$name;
        }
    }
    
    public function getName(){
        return $this->_name;
    }

    
    public function setPhone_1($phone_1){
        if(is_string($phone_1)){
            $this->_id=$phone_1;
        }
    }
    
    public function getPhone_1(){
        return $this->_phone_1;
    }

    
    public function setPhone_2($phone_2){
        if(is_string($phone_2)){
            $this->_id=$phone_2;
        }
    }
    
    public function getPhone_2(){
        return $this->_phone_2;
    }

    
    public function setFirst_name($first_name){
        if(is_string($first_name)){
            $this->_id=$first_name;
        }
    }
    
    public function getFirst_name(){
        return $this->_first_name;
    }

    
    public function setDate_birth($date_birth){
        if(is_string($date_birth)){
            $this->_id=$date_birth;
        }
    }
    
    public function getDate_birth(){
        return $this->_date_birth;
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
        if(is_string($city)){
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

    
    public function setSex($sex){
        if(is_string($sex)){
            $this->_id=$sex;
        }
    }
    
    public function getSex(){
        return $this->_sex;
    }

    
    public function setAbout($about){
        if(is_string($about)){
            $this->_id=$about;
        }
    }
    
    public function getAbout(){
        return $this->_about;
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

    public function getLastCustomer(){
        $query=$this->_db->prepare("SELECT * FROM customers WHERE id=(SELECT MAX(id) FROM customers)");
        if($query->execute() && $query->rowCount()==1){
            $data=$query->fetch();
            return (new Customer($data)); 
        }else{
            return false;
        }
    }




    public function getCustomer($id){
        if(is_int($id)){
            $query=$this->_db->prepare("SELECT * FROM customers WHERE id=?");
            $query->bindParam(1,$id);
            if($query->execute() && $query->rowCount()==1){
                $data=$query->fetch();
                return (new Customer($data));   
            }else{
                return false;
            }
        }else{
            return false;
        }

    }




    public function getCustomers() {

        $query=$this->_db->prepare("SELECT * FROM customers ORDER BY id ASC");

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
        $query=$customer->_db->prepare("UPDATE customers
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
        
        $query->bindParam(1,$id_customer);
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