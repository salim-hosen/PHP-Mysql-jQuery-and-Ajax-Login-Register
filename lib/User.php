<?php
    include_once 'Session.php';
	include 'Database.php';
    class User{
		private $db;
		public function __construct(){
			$this->db = new Database();
		}
		
		public function userRegistration($data){
			$name = $data['name'];
			$username = $data['username'];
			$email = $data['email'];
			$password = $data['password'];
			
            if(empty($name) || empty($username) || empty($email) || empty($password)){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be empty.</div>";
				return $msg;
			}
			
			if(strlen($username) < 3){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Username is too short.</div>";
				return $msg;
			}else if(preg_match('/[^a-z0-9_-]+/i',$username)){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Username can contain only alpha numeric,dash and underscore character.</div>";
				return $msg;
			}
			
			if(strlen($password)<8){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Password should be 8 characters long.</div>";
				return $msg;
			}
			
			if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Email address is not valid.</div>";
				return $msg;
			}
			
			$chkEmailExist = $this->alreadyExist($email,'email');
			$chkNameExist = $this->alreadyExist($username,'username');
			
			if($chkEmailExist == true){
			    $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Email address already exist.</div>";
				return $msg;	
			}
			
			if($chkNameExist == true){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Username already exist.</div>";
				return $msg;
			}
			
			$sql = "insert into tbl_user (fname,username,email,pass)values(:name,:username,:email,:pass)";
			$stmt = $this->db->pdo->prepare($sql);
			$stmt->bindValue(':name',$name);
			$stmt->bindValue(':username',$username);
			$stmt->bindValue(':email',$email);
			$stmt->bindValue(':pass',$password);
			$result = $stmt->execute();
			
			if($result){
				$msg = "<div class='alert alert-success'><strong>Success ! </strong>You are successfully Registered.</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Something Wen't Wrong. Please Try Again.</div>";
				return $msg;
			}
		}
		
		public function alreadyExist($data,$type){
			$sql = "select $type from tbl_user where $type = :$type";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(":$type",$data);
			$query->execute();
			if($query->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}
		
		public function userLogin($data){
			$email = $data['email'];
			$pass = $data['password'];
			
			if(empty($email) || empty($pass)){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be empty.</div>";
				return $msg;
			}
			
			if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Email address is not valid.</div>";
				return $msg;
			}
			
			$chkEmailExist = $this->alreadyExist($email,'email');
			
			
			if($chkEmailExist == false){
			    $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Email address Doesn't Exist.</div>";
				return $msg;	
			}
			
			$value = $this->getLoginUser($email,$pass);
			
			if($value){
				Session::init();
				Session::set('login',true);
				Session::set('id',$value->id);
				Session::set('name',$value->fname);
				Session::set('username',$value->username);
				Session::set('loginmsg',"<div class='alert alert-success'><strong>Success ! </strong>You are Logged In.</div>");
				header("Location: index.php");
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Data not found.</div>";
				return $msg;	
			}
		}
		
		public function getLoginUser($email,$pass){
			$sql = "select * from tbl_user where email = :email and pass = :pass";
			$stmt = $this->db->pdo->prepare($sql);
			$stmt->bindValue(":email",$email);
			$stmt->bindValue(":pass",$pass);
			$stmt->execute();
		    $result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		
		public function getUserData(){
		    $sql = "select * from tbl_user order by id desc";
            $query = $this->db->pdo->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            return $result;			
		}
		
		public function getUserById($id){
			$sql = "select * from tbl_user where id = :id limit 1";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(":id",$id);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		
		public function updateUserData($id,$data){
			$name = $data['name'];
			$username = $data['username'];
			$email = $data['email'];
			
			if(empty($name) || empty($username) || empty($email)){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be empty.</div>";
				return $msg;
			}
			
			if(strlen($username) < 3){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Username is too short.</div>";
				return $msg;
			}else if(preg_match('/[^a-z0-9_-]+/i',$username)){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Username can contain only alpha numeric,dash and underscore character.</div>";
				return $msg;
			}
			
			if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Email address is not valid.</div>";
				return $msg;
			}
			
			/*$chkNameExist = $this->alreadyExist($username,'username');
			
			
			if($chkNameExist == true){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Username already exist.</div>";
				return $msg;
			}*/
			
			$sql = "update tbl_user set fname = :name, username = :username, email = :email where id = :id";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(":name",$name);
			$query->bindValue(":username",$username);
			$query->bindValue(":email",$email);
			$query->bindValue(":id",$id);
			$result = $query->execute();
			
			if($result){
				$msg = "<div class='alert alert-success'><strong>Success ! </strong>Data Updated Successfully.</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Couldn't Update Data.</div>";
				return $msg;
			}
		}
		
		public function updateUserPassword($id,$data){
			$oldPass = $data['oldPassword'];
			$newPass = $data['newPassword'];
			
			if(empty($oldPass) || empty($newPass)){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be empty.</div>";
				return $msg;
			}
			
			if(strlen($newPass)<8){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Password should be 8 characters long.</div>";
				return $msg;
			}
			
			$chkPass = $this->checkPass($id,$oldPass);
			
			if($chkPass == false){
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Old Password is Incorrect.</div>";
				return $msg;
			}
			
			$sql = "update tbl_user set pass = :password where id = :id";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(":password",$newPass);
			$query->bindValue(":id",$id);
			$result = $query->execute();
			
			if($result){
				$msg = "<div class='alert alert-success'><strong>Success ! </strong>Password Updated Successfully.</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Password Not Updated.</div>";
				return $msg;
			}
		}
		
		public function checkPass($id,$oldPass){
			$sql = "select pass from tbl_user where id = :id and pass = :password";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(":id",$id);
			$query->bindValue(":password",$oldPass);
			$query->execute();
			if($query->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}
	}
?> 