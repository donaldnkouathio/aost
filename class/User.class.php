 <?php


 include("../bd/server-connect.php");

 
 class User
 {
 	
 	/*PROPRIETES*/
 	private $_id;
 	private $_email;
 	private $_password;
 	private $_profil;
 	private $_blocked;
 	private $_token_checked;
 	private $_verified_at;
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


 	public function setEmail($email){
 		if(is_string($email)){
 			$this->_id=$email;
 		}
 	}
 	
 	public function getEmail(){
 		return $this->_email;
 	}

 	
 	public function setPassword($password){
 		if(is_string($password)){
 			$this->_id=$password;
 		}
 	}
 	
 	public function getPassword(){
 		return $this->_password;
 	}

 	
 	public function setProfile($profile){
 		if(is_string($profile)){
 			$this->_id=$profile;
 		}
 	}
 	
 	public function getProfile(){
 		return $this->_profile;
 	}

 	
 	public function setBlocked($blocked){
 		if(is_int($blocked)){
 			$this->_id=$blocked;
 		}
 	}
 	
 	public function getBlocked(){
 		return $this->_blocked;
 	}

 	
 	public function setToken_checked($token_checked){
 		if(is_string($token_checked)){
 			$this->_id=$token_checked;
 		}
 	}
 	
 	public function getToken_checked(){
 		return $this->_token_checked;
 	}

 	
 	public function setVerified_at($verified_at){
 		if(is_string($verified_at)){
 			$this->_id=$verified_at;
 		}
 	}
 	
 	public function getVerified_at(){
 		return $this->_verified_at;
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

 	public function getLastUser(){
 		$query=$db->prepare("SELECT * FROM users WHERE id=(SELECT MAX(id) FROM users)");
 		if($query->execute() && $query->rowCount()==1){
 			$data=$query->fetch();
 			return (new User($data)); 
 		}else{
 			return false;
 		}
 	}




 	public function getUser($id){
 		if(is_int($id)){
 			$query=$db->prepare("SELECT * FROM users WHERE id=?");
 			$query->bindParam(1,$id);
 			if($query->execute() && $query->rowCount()==1){
 				$data=$query->fetch();
 				return (new User($data));	
 			}else{
 				return false;
 			}
 		}else{
 			return false;
 		}

 	}




 	public function getUsers() {

 		$query=$db->prepare("SELECT * FROM users ORDER BY id ASC");

 		$users=[];

 		if($query->execute()){
 			while($data=$query->fetch()){
 				$users[]=new User($data);
 			}
 			return $users;
 		}else{
 			return false;
 		}
 	}





 	public function blockUser($id){
 		if(is_int($id)){
 			$query=$db->prepare("DELETE FROM users WHERE id=?");
 			$query->bindParam(1,$id);
 			if($query->execute()){
 				return true;	
 			}else{
 				return false;
 			}
 		}else{
 			return false;
 		}

 	}





 	public function editUser(User $user) {
 		$query=$db->prepare("UPDATE users
 			SET email=?,
 			password=?,
 			profile=?,
 			blocked=?,
 			token_checked=?,
 			verified_at=?
 			WHERE id=?

 			");

 		$id=$user->getId();
 		$email=$user->getEmail();
 		$password=$user->getPassword();
 		$profile=$user->getProfile();
 		$blocked=$user->getBlocked();
 		$token_checked=$user->getToken_checked();
 		$verified_at=$user->getVerified_at();

 		$query->bindParam(1,$email);
 		$query->bindParam(2,$password);
 		$query->bindParam(3,$profile);
 		$query->bindParam(4,$blocked);
 		$query->bindParam(5,$token_checked);
 		$query->bindParam(6,$verified_at);
 		$query->bindParam(7,$id);

 		if($query->execute()){

 			return true;

 		}else{
 			return false;
 		}
 	}



 	public function logIn(User $user) {
 		$blocked=0;

 		/* Recherche de l'utilisateur */
 		$query=$db->prepare("SELECT * FROM users WHERE email=? AND password=UNHEX(SHA1(?))");

 		$email=$user->getEmail();
 		$password=$user->getPassword();

 		$query->bindParam(1,$email);
 		$query->bindParam(2,$password);

 		if($query->execute()){
 			/* Si son compte a été trouvé */
 			if($query->rowCount()==1){

 				$data=$query->fetch();

 				$user_found=new User($data);

 				/* Si il n'a pas été bloqué par un administrateur */
 				if($user_found->getBlocked()==0){
 					$_SESSION['id']=$user_found->getId();
 					$_SESSION['email']=$user_found->getEmail();

 					$query_is_customer=$db->prepare("SELECT id FROM customers WHERE id_user=?");
 					$query_is_customer->bindParam(1,$user_found->getId());
 					$query_is_customer->execute();

 					$query_is_compagny=$db->prepare("SELECT id FROM compagny WHERE id_user=?");
 					$query_is_compagny->bindParam(1,$user_found->getId());
 					$query_is_compagny->execute();

 					/* Si c'est un client */
 					if($query_is_customer->rowCount()>0){
 						$_SESSION['type']="customer";
 					}


 					/* Si c'est une entreprise */
 					if($query_is_compagny->rowCount()>0){
 						$_SESSION['type']="compagny";
 					}

 					return true;


 				}else{
 					/* Si son compte a été bloqué par un administrateur */
 					return "blocked";
 				}

 			}else{
 				/* Si son compte n'a pas été trouvé */
 				return "not found";
 			}
 		}else{
 			return false;
 		}
 	}





 	public function logOut() {
 		$_SESSION=array();
 		header("location:../home/index.php");
 	}



 }



?>